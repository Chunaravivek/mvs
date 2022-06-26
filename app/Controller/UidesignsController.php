<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UidesignsController
 * @author s4
 */
class UidesignsController extends AppController {
    public $uses = array('Uidesigns');   
    
    public function index() {
        $description = 'Manage Uidesigns';
        $keywords = 'Manage Uidesigns';
        $this->set(compact('keywords', 'description'));
        
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id', 'title', 'description' ,'images' ,'status', 'created_date' ,'modified_date');
        $search = array('title', 'description' ,'images');
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
                    $sOrder .= "Uidesigns.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " Uidesigns.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " Uidesigns.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->Uidesigns->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->Uidesigns->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Uidesigns->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            $output['aaData'][]['Uidesigns'] = array(
                'id'                =>  $key['Uidesigns']['id'],
                'title'             =>  $key['Uidesigns']['title'],
                'description'       =>  $key['Uidesigns']['description'],
//                'tag_type'          =>  $key['PunjabiTagTypes']['name'],
//                'tag_type_text'     =>  $key['Uidesigns']['tag_type_text'],
                'images'            =>  $key['Uidesigns']['images'],
                'status'            =>  $key['Uidesigns']['status'],
                'created_date'      =>  date('d/m/Y', $key['Uidesigns']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['Uidesigns']['modified_date']),
            );
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->Uidesigns->create();
            
//            $type = $this->request->data['Uidesigns']['tag_type'];
//            $options = array('conditions' => array('PunjabiTagTypes.' . $this->PunjabiTagTypes->primaryKey => $type));
//            $type_arr = $this->PunjabiTagTypes->find('first', $options);
//            
//            if(!empty($type_arr)) {
                $this->request->data['Uidesigns']['status'] = 1;
                $this->request->data['Uidesigns']['created_date'] = time();
                $this->request->data['Uidesigns']['modified_date'] = time();
//                $this->request->data['Uidesigns']['tag_type_text'] = $type_arr["PunjabiTagTypes"]["type_text"];
                
                $dir_temp = APP . 'webroot' . DS . 'uploads/Uidesigns/';

                if(!empty($this->request->data['Uidesigns']['images'])) {
                    $file_temp = $this->request->data['Uidesigns']['images'];
                    $this->request->data['Uidesigns']['images'] = URL_PATH . "uploads/Uidesigns/" . $this->Uidesigns->ImageUpload($dir_temp,$file_temp);

                }

                if ($this->Uidesigns->save($this->request->data)) {
                    $this->Session->setFlash(__('Uidesigns has been Add successfully'), 'swift_success');
                    return $this->redirect(array('controller'=>'Uidesigns','action'=>'index'));
                } else {
                    $this->Session->setFlash(__("Unable to Add Uidesigns"), 'swift_failure');
                    return $this->redirect(array('action' => 'index'));
                }
//            } else {
//                $this->Session->setFlash(__('Invalid Tag Type'), 'swift_failure');
//                return $this->redirect(array('action' => 'index'));
//            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
            $tags = $this->Uidesigns->findById($id);
          
            if (!$this->Uidesigns->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            
//            $tagTypes = $this->PunjabiTagTypes->find('all');
//           
//            $tag_type_arr = array($tags['PunjabiTagTypes']['id'] => '-- SELECT Tag Types --');
//            foreach ($tagTypes as &$value) {
//                $tag_type_arr[$value['PunjabiTagTypes']['id']] = $value['PunjabiTagTypes']['name'];
//            }
//          
//            unset($value);
//           
//            $this->set('tag_type', $tag_type_arr);
            
            $options = array('conditions' => array('Uidesigns.' . $this->Uidesigns->primaryKey => $id));
            $this->request->data = $this->Uidesigns->find('first', $options);
            
           
            $this->set('id', $this->request->data['Uidesigns']['id']);
            $this->set(array(
                '_serialize' => array('Uidesigns')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->Uidesigns->id = $id;

        if ($this->Uidesigns->exists($this->Uidesigns->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
//                $type = $this->request->data['Uidesigns']['tag_type'];
//                $options = array('conditions' => array('PunjabiTagTypes.' . $this->PunjabiTagTypes->primaryKey => $type));
//                $type_arr = $this->PunjabiTagTypes->find('first', $options);
//
//                if(!empty($type_arr)) {
                    $this->request->data['Uidesigns']['modified_date'] = time();

                    $dir_temp = APP . 'webroot' . DS . 'uploads/Uidesigns/';

                    if(!empty($this->request->data['Uidesigns']['images'])) {
                        $file_temp = $this->request->data['Uidesigns']['images'];
                        $this->request->data['Uidesigns']['images'] = URL_PATH . "uploads/Uidesigns/" . $this->Uidesigns->ImageUpload($dir_temp,$file_temp);

                    }

                    if ($this->Uidesigns->save($this->request->data)) {
                        $this->Session->setFlash(__('Uidesigns has been Updated successfully'), 'swift_success');
                        return $this->redirect(array('action' => 'index'));
                    }   else {
                        $this->Session->setFlash(__("Unable to Updated Uidesigns"), 'swift_failure');
                        return $this->redirect(array('action' => 'add'));
                    }
//                } else {
//                    $this->Session->setFlash(__('Invalid Tag Type'), 'swift_failure');
//                    return $this->redirect(array('action' => 'index'));
//                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Uidesigns->id = $id;
        
        $Uidesigns = $this->Uidesigns->find('first',array('conditions' => array('Uidesigns.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/Uidesigns/', '', $Uidesigns['Uidesigns']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/Uidesigns/';
        $image = $dir_cvr.$img;
        
        if ($this->Uidesigns->delete($this->Uidesigns->id)) {
            unlink($image);
            $this->Session->setFlash(__("Uidesigns has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Uidesigns with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    
                    $Uidesigns = $this->Uidesigns->find('first',array('conditions' => array('Uidesigns.id' => $value)));
                    $img = str_replace(URL_PATH.'uploads/Uidesigns/', '', $Uidesigns['Uidesigns']['images']);;
                    $dir_cvr = APP . 'webroot' . DS . 'uploads/Uidesigns/';
                    $image = $dir_cvr.$img;
                    
                    unlink($image);
                    $this->Uidesigns->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
      
        $id = $this->request->data['id'];
        $Uidesigns = $this->Uidesigns->find('first',array('conditions' => array('Uidesigns.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/Uidesigns/', '', $Uidesigns['Uidesigns']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/Uidesigns/';
        $image = $dir_cvr.$img;
      
        $this->request->data['Uidesigns']['id'] = $id;
        $this->request->data['Uidesigns']['images'] = '';
        
        if($this->Uidesigns->save($this->request->data)) {
            unlink($image);
        }
        
        exit; 
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Uidesigns']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->Uidesigns->exists($id)) {
            throw new NotFoundException(__('Invalid Uidesigns'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['Uidesigns']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->Uidesigns->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
    
    public function ifTag() {
        $tag = $this->request->data['tag'];
        
        if (isset($this->request->data['id']) && $this->request->data['tag'] != NULL) {
            $id = $this->request->data['id'];
            $ifUidesigns = $this->Uidesigns->find('count', array('conditions' => array('Uidesigns.title' => $tag, ' Uidesigns.id !=' => $id)));
          
        } else { 
            $ifUidesigns = $this->Uidesigns->find('count',array('conditions' => array('Uidesigns.title' => $tag)));
        }
        
        $response = [];
        $response['code'] = 0;
        
        if (isset($ifUidesigns) && $ifUidesigns > 0) {
            $response['code'] = 201;
        } else {
            $response['code'] = 200;
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

}
