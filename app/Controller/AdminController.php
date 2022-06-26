<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');


class AdminController extends AppController {
    public $uses = array('Admin','Settings');
     
    public function index() {
        $description = 'Manage Admin';
        $keywords = 'Manage Admin';
        $this->set(compact('keywords', 'description'));
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','full_name','email', 'status', 'created_date' ,'modified_date');
        $search = array('full_name','email');
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
                    $sOrder .= "Admin.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " Admin.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Admin.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->Admin->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->Admin->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Admin->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $output['aaData'][]['Admin'] = array(
                'id'                =>  $key['Admin']['id'],
                'full_name'         =>  $key['Admin']['full_name'],
                'email'             =>  $key['Admin']['email'],
                'status'            =>  $key['Admin']['status'],
                'created_date'      =>  date('d/m/Y', $key['Admin']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['Admin']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    
    public function login() {
        $this->layout = 'user';
        if($this->request->is('post')) {
            
            $email = $this->request->data['Admin']['email'];
            $pass = $this->request->data['Admin']['password'];

            $check= $this->Admin->find('first', array(
                'conditions' => array(
                    'AND' => array(
                        array('Admin.email' => $email),
                        array('Admin.password' => $pass)
                    )
                )
            ));

            if($check !=null)
            {
                $this->Session->write('admin_id',$check['Admin']['id']);
                $this->Session->write('email',$check['Admin']['email']);
                $this->Session->write('status',$check['Admin']['status']);
                $this->Session->write('full_name',$check['Admin']['full_name']);
                
                if (isset($this->request->query['returnURL'])) {
                    $controller = $this->request->query['returnURL'];
                    $this->redirect(array('controller' => $controller));
                } else {

                    $this->redirect(array('controller' => 'Dashboard', 'action' => 'index'));
                }

//                $this->redirect(array('controller'=>'Dashboard','action'=>'index'));
            } else {
                $this->Session->setFlash(__('Invalid email or Password'), 'swift_failure');
            }
        }
        
        $setting = $this->Settings->find('first');
        $logo = $setting['Settings']['logo'];
        $cname = $setting['Settings']['company_name'];
        $description = $setting['Settings']['description'];
        $this->set(compact('cname', 'logo', 'description'));
    }
    
    
    public function logout() {
      
        $this->Session->delete('type');
        $this->Session->delete('status');
        $this->Session->delete('admin_id');
        $this->Session->delete('email');
        $this->Session->delete('full_name');
       
        $this->redirect(array('controller'=>'Admin','action'=>'login'));
    }
    
    public function ForgetPassword() {
       
        $this->layout = 'user';
        if($this->request->is('post')) {
            $email = $this->request->data['Admin']['email'];

            $check= $this->Admin->find('first', array(
                'conditions' => array(
                    'AND' => array(
                        array('Admin.email' => $email),
                    )
                )
            ));
           
            if($check !=null)
            {
                $id= $check['Admin']['id'];
                $this->redirect(array('controller'=>'Admin','action'=>'ChangePassword', '?' => ['id' => $id]));
            } else {
          
                $this->Session->setFlash(__('Do Not Match Email'), 'swift_failure');
            }
        }
    }
    
    public function ChangePassword($id = NULL) {
        $this->layout = 'user';
       
        if($this->request->is('post')) {
            $id = $this->request->params['pass'][0];
            $this->Admin->id = $id;
            
            if ($this->Admin->exists($this->Admin->id)) {
                if ($this->request->is('post') || $this->request->is('put')) {
                    $this->request->data['Admin']['id'] = $id;

                    if ($this->Admin->save($this->request->data)) {
                        return $this->redirect(array('controller'=>'Admin','action'=>'login'));
                    }   else {
                        $this->Session->setFlash(__("Unable to pasword Admin"), 'swift_failure');
                        return $this->redirect(array('action' => 'ForgetPassword'));
                    }
                }
            }
        }
        $id = $this->request->query['id'];
        $this->set('id', $id);
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->Admin->create();
            $this->request->data['Admin']['status'] = 1;
//            $this->request->data['Admin']['created_date'] = date('Y-m-d H:i:s');
            $this->request->data['Admin']['created_date'] = time();
            $this->request->data['Admin']['modified_date'] = time();
            
            if ($this->Admin->save($this->request->data)) {
                $this->Session->setFlash(__('Admin has been Add successfully'), 'swift_success');
                return $this->redirect(array('controller'=>'Admin','action'=>'index'));
            } else {
                $this->Session->setFlash(__("Unable to pasword Admin"), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
          
          
            if (!$this->Admin->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('Admin.' . $this->Admin->primaryKey => $id));
            $this->request->data = $this->Admin->find('first', $options);
            
           
            $this->set('id', $this->request->data['Admin']['id']);
            $this->set(array(
                '_serialize' => array('Admin')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->Admin->id = $id;

        if ($this->Admin->exists($this->Admin->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['Admin']['modified_date'] = time();
             
           
                if ($this->Admin->save($this->request->data)) {
                    $this->Session->setFlash(__('Admin has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add Admin"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Admin->id = $id;
        
        if ($this->Admin->delete($this->Admin->id)) {
            $this->Session->setFlash(__("Admin has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Admin with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->Admin->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    public function ajax() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
          
            if (!$this->Admin->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('Admin.' . $this->Admin->primaryKey => $id));
           
            $this->set('Admin', $this->Admin->find('first', $options));
            $this->set(array(
                '_serialize' => array('Admin'),
            ));
        }
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Admin']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->Admin->exists($id)) {
            throw new NotFoundException(__('Invalid Admin'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['Admin']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->Admin->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
}
