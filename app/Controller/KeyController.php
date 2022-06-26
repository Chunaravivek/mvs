<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP KeyController
 * @author s4
 */
class KeyController extends AppController {
    public $uses = array('Key', 'Applications');   
    
    public function index() {
        $description = 'Manage Key';
        $keywords = 'Manage Key';
        $this->set(compact('keywords', 'description'));
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','', 'api_key','client_key1' ,'client_key2' ,'client_key3' ,'client_key4' ,'client_key5' ,'client_key6' ,'status', 'created_date' ,'modified_date');
        $search = array('api_key','status','client_key1' ,'client_key2' ,'client_key3' ,'client_key4' ,'client_key5' ,'client_key6');
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
                    $sOrder .= "Key.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " Key.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Key.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->Key->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
        
        $iTotal = $this->Key->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Key->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $app= $this->Applications->find('first',array('conditions' => array('Applications.app_code' => $key['Key']['app_code'])));
            $app_name = $app['Applications']['name'];
            $output['aaData'][]['Key'] = array(
                'id'                =>  $key['Key']['id'],
                'app_name'          =>  $app_name,
                'api_key'           =>  $key['Key']['api_key'],
                'client_key1'       =>  $key['Key']['client_key1'],
                'client_key2'       =>  $key['Key']['client_key2'],
                'client_key3'       =>  $key['Key']['client_key3'],
                'client_key4'       =>  $key['Key']['client_key4'],
                'client_key5'       =>  $key['Key']['client_key5'],
                'client_key6'       =>  $key['Key']['client_key6'],
                'status'            =>  $key['Key']['status'],
                'created_date'      =>  date('d/m/Y', $key['Key']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['Key']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            
            $this->Key->create();
            $checkcode = $this->Key->find('first', array('conditions' => array('Key.app_code' => $this->request->data['Key']['app_code'])));
            if (empty($checkcode)) {
                
                $this->request->data['Key']['api_key'] = md5(uniqid(rand(), true));
                $this->request->data['Key']['status'] = 1;
                $this->request->data['Key']['created_date']=time();
                $this->request->data['Key']['modified_date']=time();
                
                if ($this->Key->save($this->request->data)) {
                    $this->Session->setFlash(__('The Key has been saved'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Key could not be saved. Please, try again.'), 'swift_failure');
                }
            } else {
                $this->Session->setFlash(__('Already exist'), 'flash_custom_success');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
            
            $Key = $this->Key->findById($id);
            
            $Applications = $this->Applications->find('all');
          
            $Application_arr = array('' => '-- SELECT App --');
            foreach ($Applications as &$Publisher) {
                $Application_arr[$Publisher['Applications']['app_code']] = $Publisher['Applications']['name'];
            }
          
            unset($Publisher);
           
            $this->set('Application', $Application_arr);
          
            if (!$this->Key->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('Key.' . $this->Key->primaryKey => $id));
            $this->request->data = $this->Key->find('first', $options);
            
           
            $this->set('id', $this->request->data['Key']['id']);
            $this->set(array(
                '_serialize' => array('Key')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->Key->id = $id;

        if ($this->Key->exists($this->Key->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['Key']['modified_date'] = time();
             
           
                if ($this->Key->save($this->request->data)) {
                    $this->Session->setFlash(__('Key has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add Key"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Key->id = $id;
        
        if ($this->Key->delete($this->Key->id)) {
            $this->Session->setFlash(__("Key has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Key with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->Key->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Key']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->Key->exists($id)) {
            throw new NotFoundException(__('Invalid Key'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['Key']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->Key->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
    
    public function ApplicationsSelect() {
       
        if (isset($this->request->query['searchTerm']) && $this->request->query['searchTerm'] != '') {
            $type = $this->request->query['searchTerm'];
            
            $sWhere = " Applications.name LIKE '%".$type."%' ";
           
            $Applications = $this->Applications->find('all', array('conditions' => $sWhere));
         
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Applications --'
            );
            foreach ($Applications as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['Applications']['app_code'],
                    'text' => $value['Applications']['name']
                );
            }
        }  else {
            $Applications = $this->Applications->find('all');
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Applications --'
            );
            foreach ($Applications as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['Applications']['app_code'],
                    'text' => $value['Applications']['name']
                );
            }
        }
        
        echo json_encode($response); exit;
        
    }

}
