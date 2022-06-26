<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UsersController
 * @author s4
 */
class UsersController extends AppController {
    public $uses = array('Users', 'Applications');
     
    public function index() {
        $description = 'Manage Users';
        $keywords = 'Manage Users';
        $this->set(compact('keywords', 'description'));
        
//        $apps = $this->Applications->find('list', array('field' => array('Applications.app_code', 'Applications.name')));
        $users = $this->Applications->find('all',array('fields' => array('name','app_code')));
        $apps = Set::combine($users, '{n}.Applications.app_code', '{n}.Applications.name');
      
        $this->set('apps', $apps);
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','name', 'city_ip', 'city_name', 'country', 'state' ,'email','subscribe', 'install_status' ,'notifs_status', 'tag', 'token_updated', 'last_sent','time','last_lat', 'last_long','pin_code'
                        ,'timezone','device_model','device_name','device_memory','device_os','device_id','app_code','app_version','api_key','device_token','device_type',
                        'android_id','fb_id','mobile','gender','last_access','device_api','created_date','modified_date','status');
        
        $search = array('name', 'city_ip', 'city_name', 'country', 'state','email','subscribe', 'install_status' ,'notifs_status', 'tag', 'token_updated', 'last_sent','time','last_lat', 'last_long','pin_code'
                        ,'timezone','device_model','device_name','device_memory','device_os','device_id','app_code','app_version','api_key','device_token','device_type',
                        'android_id','fb_id','mobile','gender','last_access','device_api');
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
                    $sOrder .= "Users.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
        
        if (isset($this->request->query['app_code']) && $this->request->query['app_code'] != NULL) {
           
            $app_code = $this->request->query['app_code'];
            $sWhere .= "AND Users.app_code = '".$app_code."' ";
        }

        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " Users.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Users.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->Users->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->Users->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Users->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $output['aaData'][]['Users'] = array(
                'id'              =>  $key['Users']['id'],
                'name'            =>  $key['Users']['name'],
                'city_ip'         =>  $key['Users']['city_ip'],
                'city_name'       =>  $key['Users']['city_name'],
                'country'         =>  $key['Users']['country'],
                'state'           =>  $key['Users']['state'],
                'email'           =>  $key['Users']['email'],
                'subscribe'       =>  $key['Users']['subscribe'],
                'install_status'  =>  $key['Users']['install_status'],
                'notifs_status'   =>  $key['Users']['notifs_status'],
                'tag'             =>  $key['Users']['tag'],
                'token_updated'   =>  $key['Users']['token_updated'],
                'last_sent'       =>  $key['Users']['last_sent'],
                'time'            =>  $key['Users']['time'],
                'last_lat'        =>  $key['Users']['last_lat'],
                'last_long'       =>  $key['Users']['last_long'],
                'pin_code'        =>  $key['Users']['pin_code'],
                'timezone'        =>  $key['Users']['timezone'],
                'device_model'    =>  $key['Users']['device_model'],
                'device_name'     =>  $key['Users']['device_name'],
                'device_memory'   =>  $key['Users']['device_memory'],
                'device_os'       =>  $key['Users']['device_os'],
                'device_id'       =>  $key['Users']['device_id'],
                'app_code'        =>  $key['Users']['app_code'],
                'app_version'     =>  $key['Users']['app_version'],
                'api_key'         =>  $key['Users']['api_key'],
                'device_token'    =>  $key['Users']['device_token'],
                'device_type'     =>  $key['Users']['device_type'],
                'android_id'      =>  $key['Users']['android_id'],
                'fb_id'           =>  $key['Users']['fb_id'],
                'gender'          =>  $key['Users']['gender'],
                'last_access'     =>  $key['Users']['last_access'],
                'device_api'      =>  $key['Users']['device_api'],
                'created_date'    =>  date('d/m/Y', $key['Users']['created_date']),
                'modified_date'   =>  date('d/m/Y h:i:s A', $key['Users']['modified_date']),
                'status'          =>  $key['Users']['status'],
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Users']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->Users->exists($id)) {
            throw new NotFoundException(__('Invalid Users'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['Users']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->Users->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
}
