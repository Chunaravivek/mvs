<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP GodTagsController
 * @author s4
 */
class GodTagsController extends AppController {
    public $uses = array('GodTags', 'GodTagTypes');   
    
    public function index() {
        $description = 'Manage GodTags';
        $keywords = 'Manage GodTags';
        $this->set(compact('keywords', 'description'));
        
        $tag_types = $this->GodTagTypes->find('list');
        $this->set('tag_types', $tag_types);
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
                    $sOrder .= "GodTags.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
            $sWhere .= "AND GodTags.tag_type = '".$tag_type."' ";
        }
        
        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " GodTags.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " GodTags.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->GodTags->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->GodTags->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->GodTags->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            $output['aaData'][]['GodTags'] = array(
                'id'                =>  $key['GodTags']['id'],
                'name'              =>  $key['GodTags']['name'],
//                'tag_type'          =>  $key['GodTagTypes']['name'],
//                'tag_type_text'     =>  $key['GodTags']['tag_type_text'],
                'images'            =>  $key['GodTags']['images'],
                'order'             =>  $key['GodTags']['order'],
                'status'            =>  $key['GodTags']['status'],
                'created_date'      =>  date('d/m/Y', $key['GodTags']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['GodTags']['modified_date']),
            );
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->GodTags->create();
            
//            $type = $this->request->data['GodTags']['tag_type'];
//            $options = array('conditions' => array('GodTagTypes.' . $this->GodTagTypes->primaryKey => $type));
//            $type_arr = $this->GodTagTypes->find('first', $options);
//            
//            if(!empty($type_arr)) {
                $this->request->data['GodTags']['status'] = 1;
                $this->request->data['GodTags']['created_date'] = time();
                $this->request->data['GodTags']['modified_date'] = time();
//                $this->request->data['GodTags']['tag_type_text'] = $type_arr["GodTagTypes"]["type_text"];
                
                $dir_temp = APP . 'webroot' . DS . 'uploads/GodTags/';

                if(!empty($this->request->data['GodTags']['images'])) {
                    $file_temp = $this->request->data['GodTags']['images'];
                    $this->request->data['GodTags']['images'] = URL_PATH . "uploads/GodTags/" . $this->GodTags->ImageUpload($dir_temp,$file_temp);

                }

                if ($this->GodTags->save($this->request->data)) {
                    $this->Session->setFlash(__('GodTags has been Add successfully'), 'swift_success');
                    return $this->redirect(array('controller'=>'GodTags','action'=>'index'));
                } else {
                    $this->Session->setFlash(__("Unable to Add GodTags"), 'swift_failure');
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
            $tags = $this->GodTags->findById($id);
          
            if (!$this->GodTags->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            
//            $tagTypes = $this->GodTagTypes->find('all');
//           
//            $tag_type_arr = array($tags['GodTagTypes']['id'] => '-- SELECT Tag Types --');
//            foreach ($tagTypes as &$value) {
//                $tag_type_arr[$value['GodTagTypes']['id']] = $value['GodTagTypes']['name'];
//            }
//          
//            unset($value);
           
//            $this->set('tag_type', $tag_type_arr);
            
            $options = array('conditions' => array('GodTags.' . $this->GodTags->primaryKey => $id));
            $this->request->data = $this->GodTags->find('first', $options);
            
           
            $this->set('id', $this->request->data['GodTags']['id']);
            $this->set(array(
                '_serialize' => array('GodTags')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->GodTags->id = $id;

        if ($this->GodTags->exists($this->GodTags->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
//                $type = $this->request->data['GodTags']['tag_type'];
//                $options = array('conditions' => array('GodTagTypes.' . $this->GodTagTypes->primaryKey => $type));
//                $type_arr = $this->GodTagTypes->find('first', $options);
//
//                if(!empty($type_arr)) {
                    $this->request->data['GodTags']['modified_date'] = time();

                    $dir_temp = APP . 'webroot' . DS . 'uploads/GodTags/';

                    if(!empty($this->request->data['GodTags']['images'])) {
                        $file_temp = $this->request->data['GodTags']['images'];
                        $this->request->data['GodTags']['images'] = URL_PATH . "uploads/GodTags/" . $this->GodTags->ImageUpload($dir_temp,$file_temp);

                    }

                    if ($this->GodTags->save($this->request->data)) {
                        $this->Session->setFlash(__('GodTags has been Updated successfully'), 'swift_success');
                        return $this->redirect(array('action' => 'index'));
                    }   else {
                        $this->Session->setFlash(__("Unable to Updated GodTags"), 'swift_failure');
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
        
        $this->GodTags->id = $id;
        
        $GodTags = $this->GodTags->find('first',array('conditions' => array('GodTags.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/GodTags/', '', $GodTags['GodTags']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/GodTags/';
        $image = $dir_cvr.$img;
        
        if ($this->GodTags->delete($this->GodTags->id)) {
            unlink($image);
            $this->Session->setFlash(__("GodTags has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The GodTags with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    
                    $GodTags = $this->GodTags->find('first',array('conditions' => array('GodTags.id' => $value)));
                    $img = str_replace(URL_PATH.'uploads/GodTags/', '', $GodTags['GodTags']['images']);;
                    $dir_cvr = APP . 'webroot' . DS . 'uploads/GodTags/';
                    $image = $dir_cvr.$img;
                    
                    unlink($image);
                    $this->GodTags->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
      
        $id = $this->request->data['id'];
        $GodTags = $this->GodTags->find('first',array('conditions' => array('GodTags.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/GodTags/', '', $GodTags['GodTags']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/GodTags/';
        $image = $dir_cvr.$img;
      
        $this->request->data['GodTags']['id']=$id;
        $this->request->data['GodTags']['images'] = '';
        if($this->GodTags->save($this->request->data)) {
            unlink($image);
        }
        exit; 
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['GodTags']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->GodTags->exists($id)) {
            throw new NotFoundException(__('Invalid GodTags'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['GodTags']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->GodTags->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
    
    public function TagTypeSelect() {
       
        if (isset($this->request->query['searchTerm']) && $this->request->query['searchTerm'] != '') {
            $type = $this->request->query['searchTerm'];
            
            $sWhere = " GodTagTypes.name LIKE '%".$type."%' ";
           
            $GodTagTypes = $this->GodTagTypes->find('all', array('conditions' => $sWhere));
         
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Tag Types --'
            );
            foreach ($GodTagTypes as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['GodTagTypes']['id'],
                    'text' => $value['GodTagTypes']['name']
                );
            }
        }  else {
            $GodTagTypes = $this->GodTagTypes->find('all');
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Tag Types --'
            );
            foreach ($GodTagTypes as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['GodTagTypes']['id'],
                    'text' => $value['GodTagTypes']['name']
                );
            }
        }
        
        echo json_encode($response); exit;
        
    }
    
    public function ifTag() {
       
        $tag = $this->request->data['tag'];
        
        if (isset($this->request->data['id']) && $this->request->data['tag'] != NULL) {
            $id = $this->request->data['id'];
            $ifGodTags = $this->GodTags->find('count', array('conditions' => array('GodTags.name' => $tag, ' GodTags.id !=' => $id)));
          
        } else { 
            $ifGodTags = $this->GodTags->find('count',array('conditions' => array('GodTags.name' => $tag)));
        }
        
        $response = [];
        $response['code'] = 0;
       
        if (isset($ifGodTags) && $ifGodTags > 0) {
            $response['code'] = 201;
        } else {
            $response['code'] = 200;
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
