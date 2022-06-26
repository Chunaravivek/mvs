<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP HindiTagsController
 * @author s4
 */
class HindiTagsController extends AppController {
    public $uses = array('HindiTags');   
    
    public function index() {
        $description = 'Manage HindiTags';
        $keywords = 'Manage HindiTags';
        $this->set(compact('keywords', 'description'));
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','name', 'images' , 'order' ,'status', 'created_date' ,'modified_date');
        $search = array('name', 'images', 'order');
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
                    $sOrder .= "HindiTags.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
        
        if (isset($this->request->query['tag_type']) && $this->request->query['tag_type'] != NULL) {
           
            $tag_type = $this->request->query['tag_type'];
            $sWhere .= "AND HindiTags.tag_type = '".$tag_type."' ";
        }
        
        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " HindiTags.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " HindiTags.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->HindiTags->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->HindiTags->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->HindiTags->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            $output['aaData'][]['HindiTags'] = array(
                'id'                =>  $key['HindiTags']['id'],
                'name'              =>  $key['HindiTags']['name'],
//                'tag_type'          =>  $key['HindiTagTypes']['name'],
//                'tag_type_text'     =>  $key['HindiTags']['tag_type_text'],
                'images'            =>  $key['HindiTags']['images'],
                'order'             =>  $key['HindiTags']['order'],
                'status'            =>  $key['HindiTags']['status'],
                'created_date'      =>  date('d/m/Y', $key['HindiTags']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['HindiTags']['modified_date']),
            );
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->HindiTags->create();
            
//            $type = $this->request->data['HindiTags']['tag_type'];
//            $options = array('conditions' => array('HindiTagTypes.' . $this->HindiTagTypes->primaryKey => $type));
//            $type_arr = $this->HindiTagTypes->find('first', $options);
//            
//            if(!empty($type_arr)) {
                $this->request->data['HindiTags']['status'] = 1;
                $this->request->data['HindiTags']['created_date'] = time();
                $this->request->data['HindiTags']['modified_date'] = time();
//                $this->request->data['HindiTags']['tag_type_text'] = $type_arr["HindiTagTypes"]["type_text"];
                
                $dir_temp = APP . 'webroot' . DS . 'uploads/HindiTags/';

                if(!empty($this->request->data['HindiTags']['images'])) {
                    $file_temp = $this->request->data['HindiTags']['images'];
                    $this->request->data['HindiTags']['images'] = URL_PATH . "uploads/HindiTags/" . $this->HindiTags->ImageUpload($dir_temp,$file_temp);

                }

                if ($this->HindiTags->save($this->request->data)) {
                    $this->Session->setFlash(__('HindiTags has been Add successfully'), 'swift_success');
                    return $this->redirect(array('controller'=>'HindiTags','action'=>'index'));
                } else {
                    $this->Session->setFlash(__("Unable to Add HindiTags"), 'swift_failure');
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
            $tags = $this->HindiTags->findById($id);
          
            if (!$this->HindiTags->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            
//            $tagTypes = $this->HindiTagTypes->find('all');
//           
//            $tag_type_arr = array($tags['HindiTagTypes']['id'] => '-- SELECT Tag Types --');
//            foreach ($tagTypes as &$value) {
//                $tag_type_arr[$value['HindiTagTypes']['id']] = $value['HindiTagTypes']['name'];
//            }
//          
//            unset($value);
           
//            $this->set('tag_type', $tag_type_arr);
            
            $options = array('conditions' => array('HindiTags.' . $this->HindiTags->primaryKey => $id));
            $this->request->data = $this->HindiTags->find('first', $options);
            
           
            $this->set('id', $this->request->data['HindiTags']['id']);
            $this->set(array(
                '_serialize' => array('HindiTags')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->HindiTags->id = $id;

        if ($this->HindiTags->exists($this->HindiTags->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
//                $type = $this->request->data['HindiTags']['tag_type'];
//                $options = array('conditions' => array('HindiTagTypes.' . $this->HindiTagTypes->primaryKey => $type));
//                $type_arr = $this->HindiTagTypes->find('first', $options);
//
//                if(!empty($type_arr)) {
                    $this->request->data['HindiTags']['modified_date'] = time();

                    $dir_temp = APP . 'webroot' . DS . 'uploads/HindiTags/';

                    if(!empty($this->request->data['HindiTags']['images'])) {
                        $file_temp = $this->request->data['HindiTags']['images'];
                        $this->request->data['HindiTags']['images'] = URL_PATH . "uploads/HindiTags/" . $this->HindiTags->ImageUpload($dir_temp,$file_temp);

                    }

                    if ($this->HindiTags->save($this->request->data)) {
                        $this->Session->setFlash(__('HindiTags has been Updated successfully'), 'swift_success');
                        return $this->redirect(array('action' => 'index'));
                    }   else {
                        $this->Session->setFlash(__("Unable to Updated HindiTags"), 'swift_failure');
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
        
        $this->HindiTags->id = $id;
        
        $HindiTags = $this->HindiTags->find('first',array('conditions' => array('HindiTags.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/HindiTags/', '', $HindiTags['HindiTags']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/HindiTags/';
        $image = $dir_cvr.$img;
        
        if ($this->HindiTags->delete($this->HindiTags->id)) {
            unlink($image);
            $this->Session->setFlash(__("HindiTags has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The HindiTags with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    
                    $HindiTags = $this->HindiTags->find('first',array('conditions' => array('HindiTags.id' => $value)));
                    $img = str_replace(URL_PATH.'uploads/HindiTags/', '', $HindiTags['HindiTags']['images']);;
                    $dir_cvr = APP . 'webroot' . DS . 'uploads/HindiTags/';
                    $image = $dir_cvr.$img;
                    
                    unlink($image);
                    $this->HindiTags->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
      
        $id = $this->request->data['id'];
        $HindiTags = $this->HindiTags->find('first',array('conditions' => array('HindiTags.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/HindiTags/', '', $HindiTags['HindiTags']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/HindiTags/';
        $image = $dir_cvr.$img;
      
        $this->request->data['HindiTags']['id']=$id;
        $this->request->data['HindiTags']['images'] = '';
        if($this->HindiTags->save($this->request->data)) {
            unlink($image);
        }
        exit; 
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['HindiTags']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->HindiTags->exists($id)) {
            throw new NotFoundException(__('Invalid HindiTags'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['HindiTags']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->HindiTags->save($this->request->data)) {                
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
            $ifHindiTags = $this->HindiTags->find('count', array('conditions' => array('HindiTags.name' => $tag, ' HindiTags.id !=' => $id)));
          
        } else { 
            $ifHindiTags = $this->HindiTags->find('count',array('conditions' => array('HindiTags.name' => $tag)));
        }
        
        $response = [];
        $response['code'] = 0;
       
        if (isset($ifHindiTags) && $ifHindiTags > 0) {
            $response['code'] = 201;
        } else {
            $response['code'] = 200;
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
