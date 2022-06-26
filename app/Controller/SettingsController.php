<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP SettingsController
 * @author s4
 */
class SettingsController extends AppController {
    public $uses = array('Settings');   
    
    public function index() {
        $description = 'Manage Settings';
        $keywords = 'Manage Settings';
        $this->set(compact('keywords', 'description'));
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','company_name', 'description' , 'logo' ,'status', 'created_date' ,'modified_date');
        $search = array('name', 'company_name', 'description', 'logo');
        
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
                    $sOrder .= "Settings.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " Settings.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Settings.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->Settings->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->Settings->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Settings->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $output['aaData'][]['Settings'] = array(
                'id'                =>  $key['Settings']['id'],
                'company_name'      =>  $key['Settings']['company_name'],
                'description'       =>  $key['Settings']['description'],
                'logo'              =>  $key['Settings']['logo'],
                'status'            =>  $key['Settings']['status'],
                'created_date'      =>  date('d/m/Y', $key['Settings']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['Settings']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->Settings->create();
            $this->request->data['Settings']['status'] = 1;
            $this->request->data['Settings']['created_date'] = time();
            $this->request->data['Settings']['modified_date'] = time();
            
            $dir_temp = APP . 'webroot' . DS . 'app-assets/images/logo/';
           
            if(!empty($this->request->data['Settings']['logo'])) {
                $file_temp = $this->request->data['Settings']['logo'];
                $this->request->data['Settings']['logo'] = URL_PATH . "app-assets/images/logo/" . $this->Settings->ImageUpload($dir_temp,$file_temp);
              
            }
            
            if ($this->Settings->save($this->request->data)) {
                $this->Session->setFlash(__('Settings has been Add successfully'), 'swift_success');
                return $this->redirect(array('controller'=>'Settings','action'=>'index'));
            } else {
                $this->Session->setFlash(__("Unable to pasword Settings"), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
          
          
            if (!$this->Settings->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('Settings.' . $this->Settings->primaryKey => $id));
            $this->request->data = $this->Settings->find('first', $options);
            
           
            $this->set('id', $this->request->data['Settings']['id']);
            $this->set(array(
                '_serialize' => array('Settings')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->Settings->id = $id;

        if ($this->Settings->exists($this->Settings->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['Settings']['modified_date'] = time();
             
                $dir_temp = APP . 'webroot' . DS . 'app-assets/images/logo/';
           
                if(!empty($this->request->data['Settings']['logo'])) {
                    $file_temp = $this->request->data['Settings']['logo'];
                    $this->request->data['Settings']['logo'] = URL_PATH . "app-assets/images/logo/" . $this->Settings->ImageUpload($dir_temp,$file_temp);

                }

                if ($this->Settings->save($this->request->data)) {
                    $this->Session->setFlash(__('Settings has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add Settings"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Settings->id = $id;
        
        if ($this->Settings->delete($this->Settings->id)) {
            $this->Session->setFlash(__("Settings has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Settings with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Settings']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->Settings->exists($id)) {
            throw new NotFoundException(__('Invalid Settings'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['Settings']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->Settings->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
    
    function delete_image() {
        $id = $this->request->data['id'];
        $Settings = $this->Settings->find('first',array('conditions' => array('Settings.id' => $id)));
       
        $img = str_replace('http://localhost/mvs/app-assets/images/logo/', '', $Settings['Settings']['logo']);
        
        $dir_cvr = APP . 'webroot' . DS . 'app-assets/images/logo/';
        $logo = $dir_cvr.$img;
       
        $this->request->data['Settings']['id']=$id;
        $this->request->data['Settings']['logo'] = '';
        if($this->Settings->save($this->request->data)) {
            unlink($logo);
        }
        exit; 
    }

}
