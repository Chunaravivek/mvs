<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP TemplateTypesController
 * @author s4
 */
class TemplateTypesController extends AppController {
    public $uses = array('TemplateTypes');   
    
    public function index() {
        $description = 'Manage TemplateTypes';
        $keywords = 'Manage TemplateTypes';
        $this->set(compact('keywords', 'description'));
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','type', 'status', 'created_date' ,'modified_date');
        $search = array('type');
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
                    $sOrder .= "TemplateTypes.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
        

        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " TemplateTypes.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " TemplateTypes.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->TemplateTypes->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->TemplateTypes->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->TemplateTypes->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $output['aaData'][]['TemplateTypes'] = array(
                'id'                =>  $key['TemplateTypes']['id'],
                'type'              =>  $key['TemplateTypes']['type'],
                'status'            =>  $key['TemplateTypes']['status'],
                'created_date'      =>  date('d/m/Y', $key['TemplateTypes']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['TemplateTypes']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->TemplateTypes->create();
            $this->request->data['TemplateTypes']['type'] = trim($this->request->data['TemplateTypes']['type']);
            $this->request->data['TemplateTypes']['status'] = 1;
            $this->request->data['TemplateTypes']['created_date'] = time();
            $this->request->data['TemplateTypes']['modified_date'] = time();
            
            if ($this->TemplateTypes->save($this->request->data)) {
                $this->Session->setFlash(__('TemplateTypes has been Add successfully'), 'swift_success');
                return $this->redirect(array('controller'=>'TemplateTypes','action'=>'index'));
            } else {
                $this->Session->setFlash(__("Unable to pasword TemplateTypes"), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
          
            if (!$this->TemplateTypes->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('TemplateTypes.' . $this->TemplateTypes->primaryKey => $id));
            $this->request->data = $this->TemplateTypes->find('first', $options);
            
           
            $this->set('id', $this->request->data['TemplateTypes']['id']);
            $this->set(array(
                '_serialize' => array('TemplateTypes')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->TemplateTypes->id = $id;

        if ($this->TemplateTypes->exists($this->TemplateTypes->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['TemplateTypes']['modified_date'] = time();
             
                $this->request->data['TemplateTypes']['type'] = trim($this->request->data['TemplateTypes']['type']);
                if ($this->TemplateTypes->save($this->request->data)) {
                    $this->Session->setFlash(__('TemplateTypes has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add TemplateTypes"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->TemplateTypes->id = $id;
        
        if ($this->TemplateTypes->delete($this->TemplateTypes->id)) {
            $this->Session->setFlash(__("TemplateTypes has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The TemplateTypes with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->TemplateTypes->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['TemplateTypes']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->TemplateTypes->exists($id)) {
            throw new NotFoundException(__('Invalid TemplateTypes'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['TemplateTypes']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->TemplateTypes->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
    
    public function ifTag() {
        $tag = trim($this->request->data['tag']);
        
        if (isset($this->request->data['id']) && $this->request->data['tag'] != NULL) {
            $id = $this->request->data['id'];
            $ifTemplateTypes = $this->TemplateTypes->find('count', array('conditions' => array('TemplateTypes.type' => $tag, ' TemplateTypes.id !=' => $id)));
          
        } else { 
            $ifTemplateTypes = $this->TemplateTypes->find('count',array('conditions' => array('TemplateTypes.type' => $tag)));
        }
        
        $response = [];
        $response['code'] = 0;
        
        if (isset($ifTemplateTypes) && $ifTemplateTypes > 0) {
            $response['code'] = 201;
        } else {
            $response['code'] = 200;
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

}
