<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP WishesTagsController
 * @author s4
 */
class WishesTagsController extends AppController {
    public $uses = array('WishesTags');   
    
    public function index() {
        $description = 'Manage WishesTags';
        $keywords = 'Manage WishesTags';
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
                    $sOrder .= "WishesTags.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
            $sWhere .= "AND WishesTags.tag_type = '".$tag_type."' ";
        }
        
        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " WishesTags.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " WishesTags.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->WishesTags->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->WishesTags->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->WishesTags->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            $output['aaData'][]['WishesTags'] = array(
                'id'                =>  $key['WishesTags']['id'],
                'name'              =>  $key['WishesTags']['name'],
//                'tag_type'          =>  $key['HindiTagTypes']['name'],
//                'tag_type_text'     =>  $key['WishesTags']['tag_type_text'],
                'images'            =>  $key['WishesTags']['images'],
                'order'             =>  $key['WishesTags']['order'],
                'status'            =>  $key['WishesTags']['status'],
                'created_date'      =>  date('d/m/Y', $key['WishesTags']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['WishesTags']['modified_date']),
            );
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->WishesTags->create();
            
//            $type = $this->request->data['WishesTags']['tag_type'];
//            $options = array('conditions' => array('HindiTagTypes.' . $this->HindiTagTypes->primaryKey => $type));
//            $type_arr = $this->HindiTagTypes->find('first', $options);
//            
//            if(!empty($type_arr)) {
                $this->request->data['WishesTags']['status'] = 1;
                $this->request->data['WishesTags']['created_date'] = time();
                $this->request->data['WishesTags']['modified_date'] = time();
//                $this->request->data['WishesTags']['tag_type_text'] = $type_arr["HindiTagTypes"]["type_text"];
                
                $dir_temp = APP . 'webroot' . DS . 'uploads/WishesTags/';

                if(!empty($this->request->data['WishesTags']['images'])) {
                    $file_temp = $this->request->data['WishesTags']['images'];
                    $this->request->data['WishesTags']['images'] = URL_PATH . "uploads/WishesTags/" . $this->WishesTags->ImageUpload($dir_temp,$file_temp);

                }

                if ($this->WishesTags->save($this->request->data)) {
                    $this->Session->setFlash(__('WishesTags has been Add successfully'), 'swift_success');
                    return $this->redirect(array('controller'=>'WishesTags','action'=>'index'));
                } else {
                    $this->Session->setFlash(__("Unable to Add WishesTags"), 'swift_failure');
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
            $tags = $this->WishesTags->findById($id);
          
            if (!$this->WishesTags->exists($id)) {
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
            
            $options = array('conditions' => array('WishesTags.' . $this->WishesTags->primaryKey => $id));
            $this->request->data = $this->WishesTags->find('first', $options);
            
           
            $this->set('id', $this->request->data['WishesTags']['id']);
            $this->set(array(
                '_serialize' => array('WishesTags')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->WishesTags->id = $id;

        if ($this->WishesTags->exists($this->WishesTags->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
//                $type = $this->request->data['WishesTags']['tag_type'];
//                $options = array('conditions' => array('HindiTagTypes.' . $this->HindiTagTypes->primaryKey => $type));
//                $type_arr = $this->HindiTagTypes->find('first', $options);
//
//                if(!empty($type_arr)) {
                    $this->request->data['WishesTags']['modified_date'] = time();

                    $dir_temp = APP . 'webroot' . DS . 'uploads/WishesTags/';

                    if(!empty($this->request->data['WishesTags']['images'])) {
                        $file_temp = $this->request->data['WishesTags']['images'];
                        $this->request->data['WishesTags']['images'] = URL_PATH . "uploads/WishesTags/" . $this->WishesTags->ImageUpload($dir_temp,$file_temp);

                    }

                    if ($this->WishesTags->save($this->request->data)) {
                        $this->Session->setFlash(__('WishesTags has been Updated successfully'), 'swift_success');
                        return $this->redirect(array('action' => 'index'));
                    }   else {
                        $this->Session->setFlash(__("Unable to Updated WishesTags"), 'swift_failure');
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
        
        $this->WishesTags->id = $id;
        
        $WishesTags = $this->WishesTags->find('first',array('conditions' => array('WishesTags.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/WishesTags/', '', $WishesTags['WishesTags']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/WishesTags/';
        $image = $dir_cvr.$img;
        
        if ($this->WishesTags->delete($this->WishesTags->id)) {
            unlink($image);
            $this->Session->setFlash(__("WishesTags has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The WishesTags with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    
                    $WishesTags = $this->WishesTags->find('first',array('conditions' => array('WishesTags.id' => $value)));
                    $img = str_replace(URL_PATH.'uploads/WishesTags/', '', $WishesTags['WishesTags']['images']);;
                    $dir_cvr = APP . 'webroot' . DS . 'uploads/WishesTags/';
                    $image = $dir_cvr.$img;
                    
                    unlink($image);
                    $this->WishesTags->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
      
        $id = $this->request->data['id'];
        $WishesTags = $this->WishesTags->find('first',array('conditions' => array('WishesTags.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/WishesTags/', '', $WishesTags['WishesTags']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/WishesTags/';
        $image = $dir_cvr.$img;
      
        $this->request->data['WishesTags']['id']=$id;
        $this->request->data['WishesTags']['images'] = '';
        if($this->WishesTags->save($this->request->data)) {
            unlink($image);
        }
        exit; 
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['WishesTags']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->WishesTags->exists($id)) {
            throw new NotFoundException(__('Invalid WishesTags'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['WishesTags']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->WishesTags->save($this->request->data)) {                
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
            $ifWishesTags = $this->WishesTags->find('count', array('conditions' => array('WishesTags.name' => $tag, ' WishesTags.id !=' => $id)));
          
        } else { 
            $ifWishesTags = $this->WishesTags->find('count',array('conditions' => array('WishesTags.name' => $tag)));
        }
        
        $response = [];
        $response['code'] = 0;
       
        if (isset($ifWishesTags) && $ifWishesTags > 0) {
            $response['code'] = 201;
        } else {
            $response['code'] = 200;
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
