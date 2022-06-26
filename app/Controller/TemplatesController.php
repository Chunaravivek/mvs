<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP TemplatesController
 * @author s4
 */
class TemplatesController extends AppController {
    public $uses = array('Templates','Accounts', 'Uidesign', 'TemplateTypes', 'Applications');   
    
    public function index() {
        $description = 'Manage Templates';
        $keywords = 'Manage Templates';
        $this->set(compact('keywords', 'description'));
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','title', 'type', 'msg', 'template_type', 'account_id', 'app_code', 'bgcolor', 'title_bgcolor', 'title_text_color', 'msgcolor', 'user_field', 'option1', 'option2', 'image', 'img_top', 'full_image', 'singlebtn', 'close_button_exist', 'close_button_color', 'close_button_icon', 'btn_seprator', 'btnmargin', 'button1_text', 'button1_color', 'button1_text_color', 'button2_text', 'button2_color', 'button2_text_color', 'link1', 'link2', 'param1', 'param2' ,'status', 'created_date' ,'modified_date');
        $search = array('title', 'msg');
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
                    $sOrder .= "Templates.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " Templates.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Templates.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
      
        // echo "<pre>"; print_r($this->request->query); exit;
        $keys = $this->Templates->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->Templates->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Templates->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $account_name = "-";
            $app_name = "-";
            $temp_type_id = $key['TemplateTypes']['id'];
            
            if ($temp_type_id == 1) {
                
                $app = $this->Applications->find('first', array('conditions' => array('Applications.app_code' => $key['Templates']['app_code'])));
                $app_name = $app['Applications']['name'];
                $account_name = $app['Accounts']['name'];
            }
            
            $output['aaData'][]['Templates'] = array(
                'id'                =>  $key['Templates']['id'],
                'title'             =>  $key['Templates']['title'],
                'type'              =>  $key['TemplateTypes']['type'],
                'ui_design'         =>  $key['Uidesign']['title'],
                'account'           =>  $account_name,
                'application'       =>  $app_name,
                'status'            =>  $key['Templates']['status'],
                'created_date'      =>  date('d/m/Y', $key['Templates']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['Templates']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        $description = 'Manage Templates Add';
        $keywords = 'Manage Templates Add';
        $this->set(compact('keywords', 'description'));
        
        
        if ($this->request->is('post')) {
            
            if (isset($this->request->data['Templates']['close_button_exist'])) {
                $this->request->data['Templates']['close_button_exist'] = 1;
            } else {
                $this->request->data['Templates']['close_button_exist'] = 0;
            }
            if (!isset($this->request->data['Templates']['close_button_color']) || empty($this->request->data['Templates']['close_button_color'])) {
                $this->request->data['Templates']['close_button_color'] = '#000000';
            }
            if (!isset($this->request->data['Templates']['button1_text_color']) || empty($this->request->data['Templates']['button1_text_color'])) {
                $this->request->data['Templates']['button1_text_color'] = '#000000';
            }
            if (!isset($this->request->data['Templates']['button1_color']) || empty($this->request->data['Templates']['button1_color'])) {
                $this->request->data['Templates']['button1_color'] = '#FFFFFF';
            }
            if (!isset($this->request->data['Templates']['button2_text_color']) || empty($this->request->data['Templates']['button2_text_color'])) {
                $this->request->data['Templates']['button2_text_color'] = '#000000';
            }
            if (!isset($this->request->data['Templates']['button2_color']) || empty($this->request->data['Templates']['button2_color'])) {
                $this->request->data['Templates']['button2_color'] = '#FFFFFF';
            }
            if (!isset($this->request->data['Templates']['btnmargin']) || empty($this->request->data['Templates']['btnmargin'])) {
                $this->request->data['Templates']['btnmargin'] = '0';
            }
            if (isset($this->request->data['Templates']['btn_seprator'])) {
                $this->request->data['Templates']['btn_seprator'] = 1;
            } else {
                $this->request->data['Templates']['btn_seprator'] = 0;
            }
            if (isset($this->request->data['Templates']['singlebtn'])) {
                $this->request->data['Templates']['singlebtn'] = 1;
            } else {
                $this->request->data['Templates']['singlebtn'] = 0;
            }
            if (isset($this->request->data['Templates']['close_button_icon'])) {
                $this->request->data['Templates']['close_button_icon'] = 1;
            } else {
                $this->request->data['Templates']['close_button_icon'] = 0;
            }
            if (isset($this->request->data['Templates']['img_top'])) {
                $this->request->data['Templates']['img_top'] = 1;
            } else {
                $this->request->data['Templates']['img_top'] = 0;
            }
            if (isset($this->request->data['Templates']['full_image'])) {
                $this->request->data['Templates']['full_image'] = 1;
            } else {
                $this->request->data['Templates']['full_image'] = 0;
            }
            if (isset($this->request->data['Templates']['param1'])) {
                $this->request->data['Templates']['param1'] = 1;
            } else {
                $this->request->data['Templates']['param1'] = 0;
            }
            if (isset($this->request->data['Templates']['param2'])) {
                $this->request->data['Templates']['param2'] = 1;
            } else {
                $this->request->data['Templates']['param2'] = 0;
            }

            // optional
            if (isset($this->request->data['Templates']['imageorlink'])) {
                $dir_img = APP . 'webroot' . DS . 'uploads/Templates/';
                $file_img = $this->request->data['Templates']['img_file'];
                $imgurl = URL_PATH . "uploads/Templates/";
                $image = $this->Templates->ImageUpload($dir_img, $file_img);
                $this->request->data['Templates']['image'] = $imgurl . $image;
            } else {
                $this->request->data['Templates']['image'];
            }

            $this->request->data['Templates']['created_date'] = time();
            $this->request->data['Templates']['modified_date'] = time();
            $this->request->data['Templates']['status'] = 1;
            
            if ($this->Templates->save($this->request->data)) {
                $this->Session->setFlash(__('The Templates has been saved!'), 'swift_success');
            } else {
                $this->Session->setFlash(__('The Templates save Error!'), 'swift_failure');
            }
            $this->redirect(array('action' => 'index'));
        }

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
        
        $temp_types = $this->TemplateTypes->find('list');
        $this->set("temp_types", $temp_types);

        $ui = $this->Uidesign->find('list');
        $this->set("uidesigns", $ui);
        
    }
    
    public function edit($id = null) {
        if (!$this->Templates->exists($id)) {
            throw new NotFoundException(__('Invalid Uidesigns id'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            
            $this->request->data['Templates']['id'] = $id;
            $this->request->data['Templates']['modified_date']=time();
            
            if (isset($this->request->data['Templates']['img_top'])) {
                $this->request->data['Templates']['img_top'] = 1;
            } else {
                $this->request->data['Templates']['img_top'] = 0;
            }
            if (isset($this->request->data['Templates']['close_button_exist'])) {
                $this->request->data['Templates']['close_button_exist'] = 1;
            } else {
                $this->request->data['Templates']['close_button_exist'] = 0;
            }
            if (!isset($this->request->data['Templates']['close_button_color'])) {
                $this->request->data['Templates']['close_button_color'] = '#000000';
            }

            if (isset($this->request->data['Templates']['close_button_icon'])) {
                $this->request->data['Templates']['close_button_icon'] = 1;
            } else {
                $this->request->data['Templates']['close_button_icon'] = 0;
            }
            if (isset($this->request->data['Templates']['full_image'])) {
                $this->request->data['Templates']['full_image'] = 1;
            } else {
                $this->request->data['Templates']['full_image'] = 0;
            }
            if (isset($this->request->data['Templates']['btn_seprator'])) {
                $this->request->data['Templates']['btn_seprator'] = 1;
            } else {
                $this->request->data['Templates']['btn_seprator'] = 0;
            }
            if (isset($this->request->data['Templates']['param1'])) {
                $this->request->data['Templates']['param1'] = 1;
            } else {
                $this->request->data['Templates']['param1'] = 0;
            }
            if (isset($this->request->data['Templates']['singlebtn'])) {
                $this->request->data['Templates']['singlebtn'] = 1;
            } else {
                $this->request->data['Templates']['singlebtn'] = 0;
            }
            if (isset($this->request->data['Templates']['imageorlink'])) {
                $this->request->data['Templates']['imageorlink'] = 1;
                $dir_img = APP . 'webroot' . DS . 'uploads/Templates/';
                $file_img = $this->request->data['Templates']['img_file'];
                
                $imgurl = URL_PATH . "uploads/Templates/";
                $image = $this->Templates->ImageUpload($dir_img, $file_img);
                $this->request->data['Templates']['image'] = $imgurl . $image;
            } else {
                $this->request->data['Templates']['imageorlink'] = 0;
            }
            
            if($this->Templates->save($this->request->data)) {
                $this->Session->setFlash(__('The Templates has been saved'), 'swift_success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Templates could not be saved. Please, try again.'), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
            
        } else {
            $templates = array('conditions' => array('Templates.' . $this->Templates->primaryKey => $id));
            $this->request->data = $this->Templates->find('first', $templates);
        }
        
        $description = 'Manage Templates Edit';
        $keywords = 'Manage Templates Edit';
        $this->set(compact('keywords', 'description'));
        
        $ui = $this->Uidesign->find('list');
        $this->set("uidesigns", $ui);
        
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
        
        $temp_types = $this->TemplateTypes->find('list');
        $this->set("temp_types", $temp_types);
    }
    
    function get_application() {
        $ac_id = $_REQUEST['ac_id'];
        $data = "";
        if ($ac_id != '') {
            $applications = $this->Applications->find('all', array('conditions' => array('Applications.account_id' => $ac_id))); 
        } else {
            $applications = $this->Applications->find('all');
        }
        $data .= '<option value=""> -- Select App -- </option>';
        foreach ($applications as $application) {
            $data .= '<option value="' . $application['Applications']['app_code'] . '">' . $application['Applications']['name'] . '</option>';
        }
        echo $data;
        exit;
    }
    
    public function get_users() {
        $default_cols = array("id", "created_date", "modified_date", "status");
        $tbl_info = $this->Templates->query("DESCRIBE users");
        $data = "<option value=''>-- SELECT Field --</option>";
        foreach ($tbl_info as $tbl) {
            $col_nm = $tbl['COLUMNS']['Field'];
            if (!in_array($col_nm, $default_cols)) {
                $data .= '<option value="' . $col_nm . '">' . $col_nm . '</option>';
            }
        }
        echo $data;
        exit;
    }
    
    public function get_overview() {
        $ui_id = $_REQUEST['type'];
        $dir = $this->BASEURL . 'uploads/Uidesigns/';
        $uidesign = $this->Uidesign->find('first', array('conditions' => array('Uidesign.id' => $ui_id)));
        $img_nm = $uidesign['Uidesign']['images'];
        $image = $img_nm;
        
        $htmldata = '<img style="height:400px;width:235px" class="col-xs-4 noty-overview" src="' . $image . '"/>';
        echo $htmldata;
        exit;
    }
    
    public function rendertemplate() {
        //return data in json
        $id = $_REQUEST['id'];
        
        $template = $this->Templates->find('first',array(
                    'conditions' => array(
                        'Templates.id' => $id,
                     )));
        
        echo json_encode($template);
        exit();
    }

}
