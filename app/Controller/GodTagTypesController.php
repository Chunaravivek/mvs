<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP GodTagTypesController
 * @author s4
 */
class GodTagTypesController extends AppController {
    public $uses = array('GodTagTypes', 'DesignTypes', 'Applications');   
    
    public function index() {
        $description = 'Manage GodTagTypes';
        $keywords = 'Manage GodTagTypes';
        $this->set(compact('keywords', 'description'));
        
        $dsgn_types = $this->DesignTypes->find('list');
        $this->set('dsgn_types', $dsgn_types);
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','name', '' ,'type_text' , 'order' ,'status', 'created_date' ,'modified_date');
        $search = array('name', 'type_text' , 'order' );
        /*
        * Paging
        */
        $sLimit = "";
        $offset = "";
        if ( isset( $this->request->query['iDisplayStart'] ) && $this->request->query['iDisplayLength'] != '-1' )
        {
            $sLimit = " ".intval( $this->request->query['iDisplayStart'] ).", ".
                    intval( $this->request->query['iDisplayLength'] );

            $paggin = explode(',', $sLimit);
            $offset = $paggin[0];
            $sLimit = $paggin[1];
        }

        
        /*
         * Ordering
        */
        $sOrder = "";
        if ( isset( $this->request->query['iSortCol_0'] ) )
        {
           
            $sOrder = " ";
            for ( $i=0 ; $i<intval( $this->request->query['iSortingCols'] ) ; $i++ )
            {
                if ( $this->request->query[ 'bSortable_'.intval($this->request->query['iSortCol_'.$i]) ] == "true" )
                {
                    $sOrder .= "GodTagTypes.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
                        ($this->request->query['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                }
            }
            
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }
        // echo "<pre>"; print_r($sOrder); exit;
     	/*
            * Filtering
            * NOTE this does not match the built-in DataTables filtering which does it
            * word by word on any field. It's possible to do here, but concerned about efficiency
            * on very large tables, and MySQL's regex functionality is very limited
        */
        $sWhere = "";
        
//        
        $sWhere = " 1=1 ";
        
        if (isset($this->request->query['design_type']) && $this->request->query['design_type'] != NULL) {
           
            $design_type = $this->request->query['design_type'];
            $sWhere .= "AND GodTagTypes.design_type = '".$design_type."' ";
        }
        

        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " GodTagTypes.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
           
        }
         
        /* Individual column filtering */
        for ( $i=0 ; $i<count($search) ; $i++ )
        {
            if ( isset($this->request->query['bSearchable_'.$i]) && $this->request->query['bSearchable_'.$i] == "true" && $this->request->query['sSearch_'.$i] != '' )
            {
                
                if ( $sWhere == "" )
                {
                    $sWhere = " 1=1 ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                $sWhere = " GodTagTypes.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->GodTagTypes->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->GodTagTypes->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->GodTagTypes->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
        /*
         * Output
        */
        $output = array(
            "sEcho" => isset($this->request->query['sEcho']) ? intval($this->request->query['sEcho']) : 1,
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $idisplayrecords,
            "aaData" => array(),
        );
        
        foreach ($keys as $key) {
            $output['aaData'][]['GodTagTypes'] = array(
                'id'                =>  $key['GodTagTypes']['id'],
                'name'              =>  $key['GodTagTypes']['name'],
                'design_type'       =>  $key['DesignTypes']['name'],
                'type_text'         =>  $key['GodTagTypes']['type_text'],
                'order'             =>  $key['GodTagTypes']['order'],
                'status'            =>  $key['GodTagTypes']['status'],
                'created_date'      =>  date('d/m/Y', $key['GodTagTypes']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['GodTagTypes']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->GodTagTypes->create();
            $this->request->data['GodTagTypes']['status'] = 1;
            $this->request->data['GodTagTypes']['created_date'] = time();
            $this->request->data['GodTagTypes']['modified_date'] = time();
            
            if ($this->GodTagTypes->save($this->request->data)) {
                $this->Session->setFlash(__('GodTagTypes has been Add successfully'), 'swift_success');
                return $this->redirect(array('controller'=>'GodTagTypes','action'=>'index'));
            } else {
                $this->Session->setFlash(__("Unable to pasword GodTagTypes"), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
            $tagtypes = $this->GodTagTypes->findById($id);
            
            $DesignTypes = $this->DesignTypes->find('all');
           
            $design_type_arr = array('' => '-- SELECT Design Types --');
            foreach ($DesignTypes as &$value) {
                $design_type_arr[$value['DesignTypes']['id']] = $value['DesignTypes']['name'];
            }
          
            unset($value);
           
            $this->set('design_type', $design_type_arr);
          
            if (!$this->GodTagTypes->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('GodTagTypes.' . $this->GodTagTypes->primaryKey => $id));
            $this->request->data = $this->GodTagTypes->find('first', $options);
            
           
            $this->set('id', $this->request->data['GodTagTypes']['id']);
            $this->set('design_type_id', $this->request->data['GodTagTypes']['design_type']);
            $this->set(array(
                '_serialize' => array('GodTagTypes')
            ));
        }
        
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->GodTagTypes->id = $id;

        if ($this->GodTagTypes->exists($this->GodTagTypes->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                
                $this->request->data['GodTagTypes']['modified_date'] = time();
             
           
                if ($this->GodTagTypes->save($this->request->data)) {
                    $this->Session->setFlash(__('GodTagTypes has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add GodTagTypes"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->GodTagTypes->id = $id;
        
        if ($this->GodTagTypes->delete($this->GodTagTypes->id)) {
            $this->Session->setFlash(__("GodTagTypes has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The GodTagTypes with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->GodTagTypes->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['GodTagTypes']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->GodTagTypes->exists($id)) {
            throw new NotFoundException(__('Invalid GodTagTypes'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['GodTagTypes']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->GodTagTypes->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
    
    public function DesignTypeSelect() {
       
        if (isset($this->request->query['searchTerm']) && $this->request->query['searchTerm'] != '') {
            $type = $this->request->query['searchTerm'];
            
            $sWhere = " DesignTypes.name LIKE '%".$type."%' ";
           
            $DesignTypes = $this->DesignTypes->find('all', array('conditions' => $sWhere));
         
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Design Types --'
            );
            foreach ($DesignTypes as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['DesignTypes']['id'],
                    'text' => $value['DesignTypes']['name']
                );
            }
        }  else {
            $DesignTypes = $this->DesignTypes->find('all');
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Design Types --'
            );
            foreach ($DesignTypes as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['DesignTypes']['id'],
                    'text' => $value['DesignTypes']['name']
                );
            }
        }
        
        echo json_encode($response); exit;
        
    }
}
