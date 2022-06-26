<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP IpwiseadsController
 * @author s4
 */
class IpwiseadsController extends AppController {

    public $uses = array('Ipwiseads', 'Applications', 'Accounts', 'Cities');

    function index() {
       
        $description = 'Manage Ipwiseads';
        $keywords = 'Manage Ipwiseads';
        $this->set(compact('keywords', 'description'));
        
        $accs = $this->Accounts->find('list');
       
        $this->set('accs', $accs);
        
        $apps = $this->Applications->find('list');
        $this->set('apps', $apps);
        
        $cities = $this->Cities->find('all');
        $this->set("cities", $cities);
        
        $ip_arr = $this->Cities->find('all');
        
        $ip_list = array();
        foreach ($ip_arr as $app) {
            $cities_id = $app['Cities']['id'];
            $cities_name = $app['Cities']['name'];
            $ip_list[$cities_id] = $cities_name;
        }
       
        $this->set("ip", $ip_list);
        
        // $app_path_link = $this->Ipwiseads->find('first');
        // $this->set("app_path_link", $app_path_link['Ipwiseads']['path']);
        
     
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','', 'app_name', 'ip' ,'status', 'update_status' ,'created_date' ,'modified_date');
        $search = array('app_name');
        
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
                    $sOrder .= "Ipwiseads.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
        
        if (isset($this->request->query['acc_id']) && $this->request->query['acc_id'] != NULL) {
           
            $acc_id = $this->request->query['acc_id'];
            $sWhere .= "AND Ipwiseads.acc_id = '".$acc_id."' ";
        }
        
        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " Ipwiseads.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Ipwiseads.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->Ipwiseads->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->Ipwiseads->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Ipwiseads->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $cities = $this->Cities->find('first', array('conditions' => array('Cities.id' => $key['Ipwiseads']['city_id'])));
            $cities_name = isset($cities['Cities']['name']) ? $cities['Cities']['name']: '';
            
            $output['aaData'][]['Ipwiseads'] = array(
                'id'                =>  $key['Ipwiseads']['id'],
                'account_name'      =>  $key['Accounts']['name'],
                'app_name'          =>  $key['Ipwiseads']['app_name'],
                'ip'                =>  $cities_name,
                'status'            =>  $key['Ipwiseads']['status'],
                'update_status'     =>  $key['Ipwiseads']['update_status'],
                'created_date'      =>  date('d/m/Y', $key['Ipwiseads']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['Ipwiseads']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $city_ids = $this->request->data['Ipwiseads']['city_id'];
           
            $count = 0;
             
            foreach ($city_ids as $city_id) {
                $checkcode = $this->Ipwiseads->find('first', array('conditions' => array('AND'  => array('Ipwiseads.app_code' => $this->request->data['Ipwiseads']['app_code'],'Ipwiseads.city_id' => $city_id))));
            
                if (empty($checkcode)) {
                    
                    $this->request->data['Ipwiseads']['created_date']=time();
                    $this->request->data['Ipwiseads']['modified_date']=time();
                    $this->request->data['Ipwiseads']['fb_id'] = isset($this->request->data['Ipwiseads']['fb_id']) ? $this->request->data['Ipwiseads']['fb_id'] : 0;
                    $this->request->data['Ipwiseads']['update_status'] = 1;
                    $this->request->data['Ipwiseads']['back_ad_set'] = 0;
                    
                    $app = $this->Applications->find('first',array('conditions' => array('Applications.app_code' => $this->request->data['Ipwiseads']['app_code'])));
                    
                    $this->request->data['Ipwiseads']['app_name'] = $app['Applications']['name'];
                    $this->request->data['Ipwiseads']['city_id'] = $city_id;
                    
                    $this->request->data['Ipwiseads']['native_start_time']    = trim($this->request->data['Ipwiseads']['native_start_time']);
                    $this->request->data['Ipwiseads']['native_end_time']      = trim($this->request->data['Ipwiseads']['native_end_time']);
                    $this->request->data['Ipwiseads']['path']                 = trim($this->request->data['Ipwiseads']['path']);
                    $this->request->data['Ipwiseads']['url']                  = trim($this->request->data['Ipwiseads']['url']);
                    $this->request->data['Ipwiseads']['ac_name']              = trim($this->request->data['Ipwiseads']['ac_name']);
                    $this->request->data['Ipwiseads']['email']                = trim($this->request->data['Ipwiseads']['email']);
                    $this->request->data['Ipwiseads']['qureka_url']           = trim($this->request->data['Ipwiseads']['qureka_url']);
                    $this->request->data['Ipwiseads']['google_app_id']        = trim($this->request->data['Ipwiseads']['google_app_id']);
                    $this->request->data['Ipwiseads']['google_appopen']       = trim($this->request->data['Ipwiseads']['google_appopen']);
                    $this->request->data['Ipwiseads']['google_appopen_2']     = trim($this->request->data['Ipwiseads']['google_appopen_2']);
                    $this->request->data['Ipwiseads']['google_appopen_3']     = trim($this->request->data['Ipwiseads']['google_appopen_3']);
                    $this->request->data['Ipwiseads']['google_fullad']        = trim($this->request->data['Ipwiseads']['google_fullad']);
                    $this->request->data['Ipwiseads']['google_fullad_2']      = trim($this->request->data['Ipwiseads']['google_fullad_2']);
                    $this->request->data['Ipwiseads']['google_fullad_3']      = trim($this->request->data['Ipwiseads']['google_fullad_3']);
                    $this->request->data['Ipwiseads']['google_fullad_splash'] = trim($this->request->data['Ipwiseads']['google_fullad_splash']);
                    $this->request->data['Ipwiseads']['google_reward_ad']     = trim($this->request->data['Ipwiseads']['google_reward_ad']);
                    $this->request->data['Ipwiseads']['google_banner']        = trim($this->request->data['Ipwiseads']['google_banner']);
                    $this->request->data['Ipwiseads']['google_native']        = trim($this->request->data['Ipwiseads']['google_native']);
                    $this->request->data['Ipwiseads']['google_native_2']      = trim($this->request->data['Ipwiseads']['google_native_2']);
                    $this->request->data['Ipwiseads']['google_native_3']      = trim($this->request->data['Ipwiseads']['google_native_3']);
                    $this->request->data['Ipwiseads']['google_native_banner'] = trim($this->request->data['Ipwiseads']['google_native_banner']);
                    $this->request->data['Ipwiseads']['fb_full_ad']           = trim($this->request->data['Ipwiseads']['fb_full_ad']);
                    $this->request->data['Ipwiseads']['fb_banner']            = trim($this->request->data['Ipwiseads']['fb_banner']);
                    $this->request->data['Ipwiseads']['fb_full_native']       = trim($this->request->data['Ipwiseads']['fb_full_native']);
                    $this->request->data['Ipwiseads']['fb_native_banner']     = trim($this->request->data['Ipwiseads']['fb_native_banner']);
                    $this->request->data['Ipwiseads']['fb_dialog']            = trim($this->request->data['Ipwiseads']['fb_dialog']);
                
                    if ($this->Ipwiseads->save($this->request->data)) {
                        $count++;
                       
                    } else {
                        $this->Session->setFlash(__('The Ipwiseads could not be saved. Please, try again.'), 'swift_failure');
                    }
                } else {
                   
                    $this->Session->setFlash(__('Already app_code and City same exist'), 'swift_failure');
                    return $this->redirect(array('action' => 'index'));
                }
            }
            $this->Session->setFlash(__('Added '.($count).' Ipwiseads'), 'swift_success');
            return $this->redirect(array('action' => 'index'));
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
          
          
            if (!$this->Ipwiseads->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('Ipwiseads.' . $this->Ipwiseads->primaryKey => $id));
            $this->request->data = $this->Ipwiseads->find('first', $options);
            
            $this->set('id', $this->request->data['Ipwiseads']['id']);
            
            $account = $this->Accounts->find('list');
            $this->set('accounts', $account);
            
            $app_arr = $this->Applications->find('all');
            
            $city_id = $this->request->data['Ipwiseads']['city_id'];
            $this->set('city_id', $city_id);
          
            $app_list = array();
            foreach($app_arr as $app) {
                $app_code = $app['Applications']['app_code'];
                $app_name = $app['Applications']['name'];
                $app_list[$app_code] = $app_name;
            }
          
            $this->set("applications", $app_list);
            
            $ip_arr = $this->Cities->find('all');

            $ip_list = array();
            foreach ($ip_arr as $app) {
                $cities_id = $app['Cities']['id'];
                $cities_name = $app['Cities']['name'];
                $ip_list[$cities_id] = $cities_name;
            }

            $this->set("ip", $ip_list);
            
            $this->set(array(
                '_serialize' => array('Ipwiseads')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->Ipwiseads->id = $id;

        if ($this->Ipwiseads->exists($this->Ipwiseads->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $city_ids = $this->request->data['Ipwiseads']['city_id'];
                $old_city_id = $this->request->data['Ipwiseads']['old_city_id'];
                
                $this->Ipwiseads->create();
                
                $add = 0;
                $update = 0;
                
                foreach ($city_ids as $city_id) {
                    unset($this->request->data['Ipwiseads']['city_id']);
                    $ifexits = $this->Ipwiseads->find('first', array('conditions' => array('Ipwiseads.app_code' => $this->request->data['Ipwiseads']['app_code'], 'Ipwiseads.city_id' => $city_id)));
                    
                    if (count($ifexits) > 0) {
                        unset($this->request->data['Ipwiseads']['old_city_id']);
                        
                        $this->request->data['Ipwiseads']['id'] = $ifexits['Ipwiseads']['id'];
                        $this->request->data['Ipwiseads']['modified_date']=time();
                        $this->request->data['Ipwiseads']['update_status'] = 2;
                        $this->request->data['Ipwiseads']['back_ad_set'] = 0;
                        
                        $app = $this->Applications->find('first',array('conditions' => array('Applications.app_code' => $this->request->data['Ipwiseads']['app_code'])));
        
                        $this->request->data['Ipwiseads']['app_name'] = $app['Applications']['name'];
                        
                        $this->request->data['Ipwiseads']['native_start_time']    = trim($this->request->data['Ipwiseads']['native_start_time']);
                        $this->request->data['Ipwiseads']['native_end_time']      = trim($this->request->data['Ipwiseads']['native_end_time']);
                        $this->request->data['Ipwiseads']['path']                 = trim($this->request->data['Ipwiseads']['path']);
                        $this->request->data['Ipwiseads']['url']                  = trim($this->request->data['Ipwiseads']['url']);
                        $this->request->data['Ipwiseads']['ac_name']              = trim($this->request->data['Ipwiseads']['ac_name']);
                        $this->request->data['Ipwiseads']['email']                = trim($this->request->data['Ipwiseads']['email']);
                        $this->request->data['Ipwiseads']['qureka_url']           = trim($this->request->data['Ipwiseads']['qureka_url']);
                        $this->request->data['Ipwiseads']['google_app_id']        = trim($this->request->data['Ipwiseads']['google_app_id']);
                        $this->request->data['Ipwiseads']['google_appopen']       = trim($this->request->data['Ipwiseads']['google_appopen']);
                        $this->request->data['Ipwiseads']['google_appopen_2']     = trim($this->request->data['Ipwiseads']['google_appopen_2']);
                        $this->request->data['Ipwiseads']['google_appopen_3']     = trim($this->request->data['Ipwiseads']['google_appopen_3']);
                        $this->request->data['Ipwiseads']['google_fullad']        = trim($this->request->data['Ipwiseads']['google_fullad']);
                        $this->request->data['Ipwiseads']['google_fullad_2']      = trim($this->request->data['Ipwiseads']['google_fullad_2']);
                        $this->request->data['Ipwiseads']['google_fullad_3']      = trim($this->request->data['Ipwiseads']['google_fullad_3']);
                        $this->request->data['Ipwiseads']['google_fullad_splash'] = trim($this->request->data['Ipwiseads']['google_fullad_splash']);
                        $this->request->data['Ipwiseads']['google_reward_ad']     = trim($this->request->data['Ipwiseads']['google_reward_ad']);
                        $this->request->data['Ipwiseads']['google_banner']        = trim($this->request->data['Ipwiseads']['google_banner']);
                        $this->request->data['Ipwiseads']['google_native']        = trim($this->request->data['Ipwiseads']['google_native']);
                        $this->request->data['Ipwiseads']['google_native_2']      = trim($this->request->data['Ipwiseads']['google_native_2']);
                        $this->request->data['Ipwiseads']['google_native_3']      = trim($this->request->data['Ipwiseads']['google_native_3']);
                        $this->request->data['Ipwiseads']['google_native_banner'] = trim($this->request->data['Ipwiseads']['google_native_banner']);
                        $this->request->data['Ipwiseads']['fb_full_ad']           = trim($this->request->data['Ipwiseads']['fb_full_ad']);
                        $this->request->data['Ipwiseads']['fb_banner']            = trim($this->request->data['Ipwiseads']['fb_banner']);
                        $this->request->data['Ipwiseads']['fb_full_native']       = trim($this->request->data['Ipwiseads']['fb_full_native']);
                        $this->request->data['Ipwiseads']['fb_native_banner']     = trim($this->request->data['Ipwiseads']['fb_native_banner']);
                        $this->request->data['Ipwiseads']['fb_dialog']            = trim($this->request->data['Ipwiseads']['fb_dialog']);
                        
                        if ($this->Ipwiseads->save($this->request->data)) {
                            $update++;
                            
                        }   else {
                            $this->Session->setFlash(__("Unable to Add Ipwiseads"), 'swift_failure');
                            
                        }
                    } else {
                        unset($this->request->data['Ipwiseads']['old_city_id']);
                    
                        $this->Ipwiseads->create();
                        $this->request->data['Ipwiseads']['created_date'] = time();
                        $this->request->data['Ipwiseads']['modified_date'] = time();
                        $this->request->data['Ipwiseads']['fb_id'] = isset($this->request->data['Ipwiseads']['fb_id']) ? $this->request->data['Ipwiseads']['fb_id'] : 0;
                        $this->request->data['Ipwiseads']['update_status'] = 1;
                        $this->request->data['Ipwiseads']['back_ad_set'] = 0;
    
                        $app = $this->Application->find('first', array('conditions' => array('Application.app_code' => $this->request->data['Ipwiseads']['app_code'])));
    
                        $this->request->data['Ipwiseads']['app_name'] = $app['Application']['name'];
                        $this->request->data['Ipwiseads']['city_id'] = $city_id;
    
                        $this->request->data['Ipwiseads']['native_start_time'] = trim($this->request->data['Ipwiseads']['native_start_time']);
                        $this->request->data['Ipwiseads']['native_end_time'] = trim($this->request->data['Ipwiseads']['native_end_time']);
                        $this->request->data['Ipwiseads']['path'] = trim($this->request->data['Ipwiseads']['path']);
                        $this->request->data['Ipwiseads']['url'] = trim($this->request->data['Ipwiseads']['url']);
                        $this->request->data['Ipwiseads']['ac_name'] = trim($this->request->data['Ipwiseads']['ac_name']);
                        $this->request->data['Ipwiseads']['email'] = trim($this->request->data['Ipwiseads']['email']);
                        $this->request->data['Ipwiseads']['qureka_url'] = trim($this->request->data['Ipwiseads']['qureka_url']);
                        $this->request->data['Ipwiseads']['google_app_id'] = trim($this->request->data['Ipwiseads']['google_app_id']);
                        $this->request->data['Ipwiseads']['google_appopen'] = trim($this->request->data['Ipwiseads']['google_appopen']);
                        $this->request->data['Ipwiseads']['google_appopen_2'] = trim($this->request->data['Ipwiseads']['google_appopen_2']);
                        $this->request->data['Ipwiseads']['google_appopen_3'] = trim($this->request->data['Ipwiseads']['google_appopen_3']);
                        $this->request->data['Ipwiseads']['google_fullad'] = trim($this->request->data['Ipwiseads']['google_fullad']);
                        $this->request->data['Ipwiseads']['google_fullad_2'] = trim($this->request->data['Ipwiseads']['google_fullad_2']);
                        $this->request->data['Ipwiseads']['google_fullad_3'] = trim($this->request->data['Ipwiseads']['google_fullad_3']);
                        $this->request->data['Ipwiseads']['google_fullad_splash'] = trim($this->request->data['Ipwiseads']['google_fullad_splash']);
                        $this->request->data['Ipwiseads']['google_reward_ad'] = trim($this->request->data['Ipwiseads']['google_reward_ad']);
                        $this->request->data['Ipwiseads']['google_banner'] = trim($this->request->data['Ipwiseads']['google_banner']);
                        $this->request->data['Ipwiseads']['google_native'] = trim($this->request->data['Ipwiseads']['google_native']);
                        $this->request->data['Ipwiseads']['google_native_2'] = trim($this->request->data['Ipwiseads']['google_native_2']);
                        $this->request->data['Ipwiseads']['google_native_3'] = trim($this->request->data['Ipwiseads']['google_native_3']);
                        $this->request->data['Ipwiseads']['google_native_banner'] = trim($this->request->data['Ipwiseads']['google_native_banner']);
                        $this->request->data['Ipwiseads']['fb_full_ad'] = trim($this->request->data['Ipwiseads']['fb_full_ad']);
                        $this->request->data['Ipwiseads']['fb_banner'] = trim($this->request->data['Ipwiseads']['fb_banner']);
                        $this->request->data['Ipwiseads']['fb_full_native'] = trim($this->request->data['Ipwiseads']['fb_full_native']);
                        $this->request->data['Ipwiseads']['fb_native_banner'] = trim($this->request->data['Ipwiseads']['fb_native_banner']);
                        $this->request->data['Ipwiseads']['fb_dialog'] = trim($this->request->data['Ipwiseads']['fb_dialog']);
    
                        if ($this->Ipwiseads->save($this->request->data)) {
                            $add++;
                        } else {
                            $this->Session->setFlash(__('The Ipwiseads could not be saved. Please, try again.'), 'swift_failure');
                        }
                    }
                }
                $this->Session->setFlash(__('Added '.($add).' And '.($update).' Updated Ipwiseads'), 'swift_success');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Ipwiseads->id = $id;
        
        if ($this->Ipwiseads->delete($this->Ipwiseads->id)) {
            $this->Session->setFlash(__("Ipwiseads has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Ipwiseads with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->Ipwiseads->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Ipwiseads']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->Ipwiseads->exists($id)) {
            throw new NotFoundException(__('Invalid Ipwiseads'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['Ipwiseads']['id'] = $id;
            if ($this->Ipwiseads->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
    
    public function AccountsSelect() {
       
        if (isset($this->request->query['searchTerm']) && $this->request->query['searchTerm'] != '') {
            $type = $this->request->query['searchTerm'];
            
            $sWhere = " Accounts.name LIKE '%".$type."%' ";
           
            $Accounts = $this->Accounts->find('all', array('conditions' => $sWhere));
         
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Accounts --'
            );
            foreach ($Accounts as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['Accounts']['id'],
                    'text' => $value['Accounts']['name']
                );
            }
        }  else {
            $Accounts = $this->Accounts->find('all');
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Accounts --'
            );
            foreach ($Accounts as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['Accounts']['id'],
                    'text' => $value['Accounts']['name']
                );
            }
        }
        
        echo json_encode($response); exit;
        
    }
    
    public function AppSelect() {
       
        if (isset($this->request->query['searchTerm']) && $this->request->query['searchTerm'] != '') {
            $type = $this->request->query['searchTerm'];
            
            $sWhere = " Applications.name LIKE '%".$type."%' ";
           
            $Applications = $this->Applications->find('all', array('conditions' => $sWhere));
         
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Apps --'
            );
            foreach ($Applications as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['Applications']['id'],
                    'text' => $value['Applications']['name']
                );
            }
        }  else {
            $Applications = $this->Applications->find('all');
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Apps --'
            );
            foreach ($Applications as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['Applications']['id'],
                    'text' => $value['Applications']['name']
                );
            }
        }
        
        echo json_encode($response); exit;
        
    }
    
    function get_application() {
        $ac_id = $_REQUEST['ac_id'];
        
        $data = "";
        $applications = $this->Applications->find('all', array('conditions' => array('Applications.account_id' => $ac_id))); //,array('conditions' => array('Category.id' => $category_id))); 
        $data .= '<option value=""> -- Select App -- </option>';
        foreach ($applications as $application) {
            $data .= '<option value="' . $application['Applications']['app_code'] . '">' . $application['Applications']['name'] . '</option>';
        }
        echo $data;
        exit;
    }
    
    public function CityId() {
     
        $city_arrs = explode(',', $this->request->data['city_arr']);
        $app_code = $this->request->data['app_code'];
        
        $response = [];
        $response['code'] = 0;
        
        
        if(isset($app_code) && $app_code != NULL) { 
            foreach($city_arrs as $city_id) {
                $ifIpwiseads = $this->Ipwiseads->find('first', array('conditions' => array('Ipwiseads.app_code' => $app_code, ' Ipwiseads.city_id =' => $city_id)));
                
                if (isset($ifIpwiseads) && count($ifIpwiseads) > 0) {
                    $cities = $this->Cities->find('first', array('conditions' => array('Cities.id' => $ifIpwiseads['Ipwiseads']['city_id'])));
                    
                    $cities_name = isset($cities['Cities']['name']) ? $cities['Cities']['name']: '';
                    $response['code'] = 201;
                    $response['city'] = $cities_name;
                } else {
                    $response['code'] = 200;
                }
            }
        }
      
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
        
    }
}
