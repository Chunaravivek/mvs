<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP AdsController
 * @author s4
 */
class AdsController extends AppController {
    public $uses = array('Accounts', 'Applications', 'Ads'); 
    
    public function index() {
        $description = 'Manage Ads';
        $keywords = 'Manage Ads';
        $this->set(compact('keywords', 'description'));
        
        $accs = $this->Accounts->find('list');
        $this->set('accs', $accs);
        
        $apps = $this->Applications->find('list');
        $this->set('apps', $apps);
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','', 'app_name' , 'json_path' ,'status', 'update_status' ,'created_date' ,'modified_date');
        $search = array('app_name', 'json_path');
        
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
                    $sOrder .= "Ads.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
            $sWhere .= "AND Ads.acc_id = '".$acc_id."' ";
        }
        
        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " Ads.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Ads.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->Ads->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->Ads->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Ads->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $output['aaData'][]['Ads'] = array(
                'id'                =>  $key['Ads']['id'],
                'account_name'      =>  $key['Accounts']['name'],
                'app_name'          =>  $key['Ads']['app_name'],
                'json_path'         =>  $key['Ads']['json_path'],
                'status'            =>  $key['Ads']['status'],
                'update_status'     =>  $key['Ads']['update_status'],
                'created_date'      =>  date('d/m/Y', $key['Ads']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['Ads']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if ($this->request->is('post')) {
            
            $checkcode = $this->Ads->find('first', array('conditions' => array('Ads.app_code' => $this->request->data['Ads']['app_code'])));
            
            if (empty($checkcode)) {
                
                $this->request->data['Ads']['created_date']=time();
                $this->request->data['Ads']['modified_date']=time();
                $this->request->data['Ads']['fb_id'] = isset($this->request->data['Ads']['fb_id']) ? $this->request->data['Ads']['fb_id'] : 0;
                $this->request->data['Ads']['update_status'] = 1;
                $this->request->data['Ads']['back_ad_set'] = 0;
                
                $app = $this->Applications->find('first',array('conditions' => array('Applications.app_code' => $this->request->data['Ads']['app_code'])));
                
                $this->request->data['Ads']['app_name'] = $app['Applications']['name'];
                
                $this->request->data['Ads']['native_start_time']    = trim($this->request->data['Ads']['native_start_time']);
                $this->request->data['Ads']['native_end_time']      = trim($this->request->data['Ads']['native_end_time']);
                $this->request->data['Ads']['path']                 = trim($this->request->data['Ads']['path']);
                $this->request->data['Ads']['url']                  = trim($this->request->data['Ads']['url']);
                $this->request->data['Ads']['ac_name']              = trim($this->request->data['Ads']['ac_name']);
                $this->request->data['Ads']['email']                = trim($this->request->data['Ads']['email']);
                $this->request->data['Ads']['qureka_url']           = trim($this->request->data['Ads']['qureka_url']);
                $this->request->data['Ads']['google_app_id']        = trim($this->request->data['Ads']['google_app_id']);
                $this->request->data['Ads']['google_appopen']       = trim($this->request->data['Ads']['google_appopen']);
                $this->request->data['Ads']['google_appopen_2']     = trim($this->request->data['Ads']['google_appopen_2']);
                $this->request->data['Ads']['google_appopen_3']     = trim($this->request->data['Ads']['google_appopen_3']);
                $this->request->data['Ads']['google_fullad']        = trim($this->request->data['Ads']['google_fullad']);
                $this->request->data['Ads']['google_fullad_2']      = trim($this->request->data['Ads']['google_fullad_2']);
                $this->request->data['Ads']['google_fullad_3']      = trim($this->request->data['Ads']['google_fullad_3']);
                $this->request->data['Ads']['google_fullad_splash'] = trim($this->request->data['Ads']['google_fullad_splash']);
                $this->request->data['Ads']['google_reward_ad']     = trim($this->request->data['Ads']['google_reward_ad']);
                $this->request->data['Ads']['google_banner']        = trim($this->request->data['Ads']['google_banner']);
                $this->request->data['Ads']['google_native']        = trim($this->request->data['Ads']['google_native']);
                $this->request->data['Ads']['google_native_2']      = trim($this->request->data['Ads']['google_native_2']);
                $this->request->data['Ads']['google_native_3']      = trim($this->request->data['Ads']['google_native_3']);
                $this->request->data['Ads']['google_native_banner'] = trim($this->request->data['Ads']['google_native_banner']);
                $this->request->data['Ads']['fb_full_ad']           = trim($this->request->data['Ads']['fb_full_ad']);
                $this->request->data['Ads']['fb_banner']            = trim($this->request->data['Ads']['fb_banner']);
                $this->request->data['Ads']['fb_full_native']       = trim($this->request->data['Ads']['fb_full_native']);
                $this->request->data['Ads']['fb_native_banner']     = trim($this->request->data['Ads']['fb_native_banner']);
                $this->request->data['Ads']['fb_dialog']            = trim($this->request->data['Ads']['fb_dialog']);
            
                if ($this->Ads->save($this->request->data)) {
                    $this->Session->setFlash(__('The Ads has been saved'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Ads could not be saved. Please, try again.'), 'swift_failure');
                }
            } else {
                $this->Session->setFlash(__('Already exist'), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
            
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
          
          
            if (!$this->Ads->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('Ads.' . $this->Ads->primaryKey => $id));
            $this->request->data = $this->Ads->find('first', $options);
            
            $this->set('id', $this->request->data['Ads']['id']);
            
            $account = $this->Accounts->find('list');
            $this->set('accounts', $account);
            
            $app_arr = $this->Applications->find('all');
          
            $app_list = array();
            foreach($app_arr as $app) {
                $app_code = $app['Applications']['app_code'];
                $app_name = $app['Applications']['name'];
                $app_list[$app_code] = $app_name;
            }
          
            $this->set("applications", $app_list);
            
            $this->set(array(
                '_serialize' => array('Ads')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->Ads->id = $id;

        if ($this->Ads->exists($this->Ads->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Ads->create();
                
                $this->request->data['Ads']['id']=$id;
                $this->request->data['Ads']['modified_date']=time();
                $this->request->data['Ads']['update_status'] = 2;
                $this->request->data['Ads']['back_ad_set'] = 0;
                
                $app = $this->Applications->find('first',array('conditions' => array('Applications.app_code' => $this->request->data['Ads']['app_code'])));

                $this->request->data['Ads']['app_name'] = $app['Applications']['name'];
                
                $this->request->data['Ads']['native_start_time']    = trim($this->request->data['Ads']['native_start_time']);
                $this->request->data['Ads']['native_end_time']      = trim($this->request->data['Ads']['native_end_time']);
                $this->request->data['Ads']['path']                 = trim($this->request->data['Ads']['path']);
                $this->request->data['Ads']['url']                  = trim($this->request->data['Ads']['url']);
                $this->request->data['Ads']['ac_name']              = trim($this->request->data['Ads']['ac_name']);
                $this->request->data['Ads']['email']                = trim($this->request->data['Ads']['email']);
                $this->request->data['Ads']['qureka_url']           = trim($this->request->data['Ads']['qureka_url']);
                $this->request->data['Ads']['google_app_id']        = trim($this->request->data['Ads']['google_app_id']);
                $this->request->data['Ads']['google_appopen']       = trim($this->request->data['Ads']['google_appopen']);
                $this->request->data['Ads']['google_appopen_2']     = trim($this->request->data['Ads']['google_appopen_2']);
                $this->request->data['Ads']['google_appopen_3']     = trim($this->request->data['Ads']['google_appopen_3']);
                $this->request->data['Ads']['google_fullad']        = trim($this->request->data['Ads']['google_fullad']);
                $this->request->data['Ads']['google_fullad_2']      = trim($this->request->data['Ads']['google_fullad_2']);
                $this->request->data['Ads']['google_fullad_3']      = trim($this->request->data['Ads']['google_fullad_3']);
                $this->request->data['Ads']['google_fullad_splash'] = trim($this->request->data['Ads']['google_fullad_splash']);
                $this->request->data['Ads']['google_reward_ad']     = trim($this->request->data['Ads']['google_reward_ad']);
                $this->request->data['Ads']['google_banner']        = trim($this->request->data['Ads']['google_banner']);
                $this->request->data['Ads']['google_native']        = trim($this->request->data['Ads']['google_native']);
                $this->request->data['Ads']['google_native_2']      = trim($this->request->data['Ads']['google_native_2']);
                $this->request->data['Ads']['google_native_3']      = trim($this->request->data['Ads']['google_native_3']);
                $this->request->data['Ads']['google_native_banner'] = trim($this->request->data['Ads']['google_native_banner']);
                $this->request->data['Ads']['fb_full_ad']           = trim($this->request->data['Ads']['fb_full_ad']);
                $this->request->data['Ads']['fb_banner']            = trim($this->request->data['Ads']['fb_banner']);
                $this->request->data['Ads']['fb_full_native']       = trim($this->request->data['Ads']['fb_full_native']);
                $this->request->data['Ads']['fb_native_banner']     = trim($this->request->data['Ads']['fb_native_banner']);
                $this->request->data['Ads']['fb_dialog']            = trim($this->request->data['Ads']['fb_dialog']);
                
                if ($this->Ads->save($this->request->data)) {
                    $this->Session->setFlash(__('Ads has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add Ads"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Ads->id = $id;
        
        if ($this->Ads->delete($this->Ads->id)) {
            $this->Session->setFlash(__("Ads has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Ads with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->Ads->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Ads']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->Ads->exists($id)) {
            throw new NotFoundException(__('Invalid Ads'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['Ads']['id'] = $id;
            if ($this->Ads->save($this->request->data)) {                
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
}
