<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP SchedulesController
 * @author s4
 */
class SchedulesController extends AppController {
    public $uses = array('Schedules', 'Applications', 'Templates', 'Users');   
    
    public function index() {
        $description = 'Manage Schedules';
        $keywords = 'Manage Schedules';
        $this->set(compact('keywords', 'description'));
        
        $templates_options = array('conditions' => array('Templates.status' => 1, 'Templates.template_type' => 1), 'order' => 'Templates.id DESC');
        
        $templates = $this->Templates->find('list', $templates_options);
        
        $this->set("templates", $templates);
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id', 'template' ,'date' ,'success', 'failure', 'modified_date', 'status');
        $search = array('template','date', 'success', 'failure');
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
                    $sOrder .= "Schedules.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " Schedules.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Schedules.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->Schedules->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->Schedules->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Schedules->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $url = URL_PATH."Templates/edit/".$key['Schedules']['template'];
            $title = $key['Templates']['title'];
            
            $output['aaData'][]['Schedules'] = array(
                'id'                =>  $key['Schedules']['id'],
                'template'          =>  "<a href='$url'>".$title."</a>",
                'date'              =>  $key['Schedules']['date'],
                'success'           =>  $key['Schedules']['success'],
                'failure'           =>  $key['Schedules']['failure'],
                'created_date'      =>  date('d/m/Y h:i:s A', $key['Schedules']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['Schedules']['modified_date']),
                'status'            =>  $key['Schedules']['status'],
                
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if ($this->request->is('post')) {
           
            $checkdate = $this->Schedules->find('first', array('conditions' => array('Schedules.date' => $this->request->data['Schedules']['date'])));
            if (empty($checkdate)) {
                $this->request->data['Schedules']['created_date']=time();
                $this->request->data['Schedules']['modified_date']=time();
                
                $this->request->data['Schedules']['success']=0;
                $this->request->data['Schedules']['failure']=0;
                
                if ($this->Schedules->save($this->request->data)) {
                    $this->Session->setFlash(__('The Schedules has been saved'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Schedules could not be saved. Please, try again.'), 'swift_failure');
                }
            } else {
                
                $this->Session->setFlash(__('Schedules already Exists for entered date'), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
                
            }
            
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
            
            if (!$this->Schedules->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            
            $options = array('conditions' => array('Schedules.' . $this->Schedules->primaryKey => $id));
            
            $this->request->data = $this->Schedules->find('first', $options);
            $templates_options = array('conditions' => array('Templates.status' => 1, 'Templates.template_type' => 1), 'order' => 'Templates.id DESC');
            
            $templates = $this->Templates->find('list',$templates_options);
            $this->set("templates", $templates);
           
            $this->set('id', $this->request->data['Schedules']['id']);
            
            $this->set(array(
                '_serialize' => array('Schedules')
            ));
        }
        
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->Schedules->id = $id;

        if ($this->Schedules->exists($this->Schedules->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $checkdate = $this->Schedules->find('first', array('conditions' => array('Schedules.date' => $this->request->data['Schedules']['date'], 'Schedules.id !=' => $id)));
                if (empty($checkdate)) {
                    $this->request->data['Schedules']['id'] = $id;
                    $this->request->data['Schedules']['modified_date'] = time();
                    $this->Schedules->create();

                    if ($this->Schedules->save($this->request->data)) {
                        $this->Session->setFlash(__('The Schedules has been saved'), 'swift_success');
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('The Schedules could not be saved. Please, try again.'), 'swift_failure');
                    }
                } else {
                    $this->Session->setFlash(__("Failed! Schedules already Exists for entered date"), 'swift_failure');
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
    }
    
    function get_template() {
        $type = $_REQUEST['type'];
        $data = "";
        $templates = $this->Templates->find('all', array('conditions' => array('Templates.type' => $type, 'Templates.device_token !=' => null, 'Templates.device_token !=' => 1234))); 
        $data .= '<option value=""> -- Select Template -- </option>';
        foreach ($templates as $template) {
            $data .= '<option value="' . $template['Templates']['id'] . '">' . $template['Templates']['title'] . '</option>';
        }
        echo $data;
        exit;
    }

    function send_notifs() {
        $android_id = $_REQUEST['android_id'];
        $template_id = $_REQUEST['template_id'];
        //0 = failed, 1 = success, 2 = device not found
        $response = "";
        $user = $this->Users->find('first', array('conditions' => array('Users.android_id' => $android_id),'order' => array('Users.created_date' => "DESC")));
        if(!empty($user)) {
            $app_code = $user['Users']['app_code'];
            $device_token = $user['Users']['device_token'];
            $app = $this->Applications->find('first', array('conditions' => array('Applications.app_code' => $app_code, 'Applications.firebase_id != ' => "undefined", 'Applications.firebase_id != ' => null)));
            if(!empty($app)) {
                //firebase
                $firebase = $app['Applications']['firebase_id'];
                //template
                $template = $this->Templates->find('first', array('conditions' => array('Templates.id' => $template_id)));
                $pay_load = array();
                foreach ($template['Templates'] as $key => $value) {
                    $pay_load[$key] = $value;
                }
                $tokens = array($device_token);
                //notification part
                $result = "";
                $url = 'https://fcm.googleapis.com/fcm/send';
                $fields = array(
                    'registration_ids' => $tokens,
                    'data' => $pay_load,
                );
  
                $headers = array(
                    'Authorization: key=' . $firebase,
                    'Content-Type: application/json'
                );

                $ch = curl_init();
                if (!$ch)
                    die("Android Failed to connect $err $errstr\n");

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields, true));
                $result = curl_exec($ch);
                $resp = explode("\n", $result);
                $respBody = json_decode($resp[count($resp) - 1], true);
                if(!array_key_exists("error",$respBody['results'][0])) {
                    $response = "notification sent";
                } else {
                    $response = "notification failed";
                }
                
            } else {
                $response = "firebase error";
            }
        } else {
            $response = "user N/A";
        }
        echo $response;
        exit;
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Schedules->id = $id;
        
        if ($this->Schedules->delete($this->Schedules->id)) {
            $this->Session->setFlash(__("Schedules has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Schedules with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->Schedules->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Schedules']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->Schedules->exists($id)) {
            throw new NotFoundException(__('Invalid Schedules'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['Schedules']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->Schedules->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
}
