<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::import('Vendor', 'Nelexa_gplay', array('file' => 'Nelexa_gplay/autoload.php'));
App::import('Vendor', 'googleplayscraper', array('file' => 'googleplayscraper/autoload.php'));

use Raulr\GooglePlayScraper\Scraper;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\AppInfo;

/**
 * CakePHP ApplicationsController
 * @author s4
 */
class ApplicationsController extends AppController {
    public $uses = array('Applications', 'Accounts');
    
    public function index() {
        $description = 'Manage Applications';
        $keywords = 'Manage Applications';
        $this->set(compact('keywords', 'description'));
        
        $accs = $this->Accounts->find('list');
        $this->set('accs', $accs);
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','name', '' ,'app_code', 'package_name', 'app_version' ,'status', 'created_date' ,'modified_date');
        $search = array('name','app_code', 'app_version');
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
                    $sOrder .= "Applications.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
        
        if (isset($this->request->query['account_id']) && $this->request->query['account_id'] != NULL) {
           
            $account_id = $this->request->query['account_id'];
            $sWhere .= "AND Applications.account_id = '".$account_id."' ";
        }
        
        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " Applications.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Applications.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->Applications->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->Applications->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Applications->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            $output['aaData'][]['Applications'] = array(
                'id'                =>  $key['Applications']['id'],
                'name'              =>  $key['Applications']['name'],
                'account_name'      =>  isset($key['Accounts']['name']) ? $key['Accounts']['name'] : '',
                'app_code'          =>  $key['Applications']['app_code'],
                'package_name'      =>  $key['Applications']['package_name'],
                'app_version'       =>  $key['Applications']['app_version'],
                'status'            =>  $key['Applications']['status'],
                'created_date'      =>  date('d/m/Y', $key['Applications']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['Applications']['modified_date']),
            );  
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
       
        if($this->request->is('post')) {
         
            $this->Applications->create();
        
            $app_code = $this->randomPrefix(6);
           
            $checkcode = $this->Applications->find('first', array('conditions' => array('Applications.app_code' => $app_code)));
            
            if (empty($checkcode)) {
                $this->request->data['Applications']['status'] = 1;
                $this->request->data['Applications']['app_code'] = $app_code;
                $this->request->data['Applications']['created_date'] = time();
                $this->request->data['Applications']['modified_date'] = time();
               
                if ($this->Applications->save($this->request->data)) {
                    $this->Session->setFlash(__('The Applications has been saved!'), 'swift_success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Applications save Error!'), 'swift_failure');
                    $this->redirect(array('action' => 'index'));
                }
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
            $Applications = $this->Applications->findById($id);
            
            $Accounts = $this->Accounts->find('all');
          
            $Account_arr = array('' => '-- SELECT ACCOUNTS --');
            foreach ($Accounts as &$Publisher) {
                $Account_arr[$Publisher['Accounts']['id']] = $Publisher['Accounts']['name'];
            }
          
            unset($Publisher);
           
            $this->set('Accounts', $Account_arr);
            
            if (!$this->Applications->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            
            $options = array('conditions' => array('Applications.' . $this->Applications->primaryKey => $id));
            $this->request->data = $this->Applications->find('first', $options);
            
           
            $this->set('id', $this->request->data['Applications']['id']);
            $this->set(array(
                '_serialize' => array('Applications')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->Applications->id = $id;

        if ($this->Applications->exists($this->Applications->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['Applications']['modified_date'] = time();
             
           
                if ($this->Applications->save($this->request->data)) {
                    $this->Session->setFlash(__('Applications has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add Applications"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Applications->id = $id;
        
        if ($this->Applications->delete($this->Applications->id)) {
            $this->Session->setFlash(__("Applications has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Applications with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->Applications->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    public function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Applications']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);

        if (!$this->Applications->exists($id)) {
            throw new NotFoundException(__('Invalid Applications'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Applications']['id'] = $id;
            if ($this->Applications->save($this->request->data)) {
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
    
    function randomPrefix($length) {
      
        $random = "";

        srand((double) microtime() * 1000000);

        $data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $data .= "abcdefghijklmnopqrstuvxyz";
        $data .= "0123456789";

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }
    
    public function package_name() {
        $gplay = new \Nelexa\GPlay\GPlayApps();
        $scraper = new Scraper();
        
        $response = [];
        $response['code'] = 0;
        
        $package_name = $this->request->data['package_name'];
//        $package_name = str_replace('https://play.google.com/store/apps/details?id=', '', $url);
        
        if (isset($this->request->data['id']) && $this->request->data['package_name'] != NULL) {
            $id = $this->request->data['id'];
            $ifpackage_name = $this->Applications->find('count', array('conditions' => array('Applications.package_name' => $package_name, ' Applications.id !=' => $id)));
        } else { 
            $ifpackage_name = $this->Applications->find('count', array('conditions' => array('Applications.package_name' => $package_name)));
        }
     
        if ($ifpackage_name > 0) {
            
            $response['code'] = 201;
            
        } else {
            
            $app = $scraper->getApp($package_name);
        
            if (isset($app['success']) && $app['success'] == 200) {
                $response['code'] = 401;
            } else {
                $response['code'] = 200;
            }
        }
        
      
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

