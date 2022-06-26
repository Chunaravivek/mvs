<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP PunjabiTagsController
 * @author s4
 */
class PunjabiTagsController extends AppController {
    public $uses = array('PunjabiTags', 'PunjabiTagTypes');   
    
    public function index() {
        $description = 'Manage PunjabiTags';
        $keywords = 'Manage PunjabiTags';
        $this->set(compact('keywords', 'description'));
        
        $tag_types = $this->PunjabiTagTypes->find('list');
        $this->set('tag_types', $tag_types);
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id', 'name', 'images' , 'order' ,'status', 'created_date' ,'modified_date');
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
                    $sOrder .= "PunjabiTags.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
            $sWhere .= "AND PunjabiTags.tag_type = '".$tag_type."' ";
        }
        
        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " PunjabiTags.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " PunjabiTags.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->PunjabiTags->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->PunjabiTags->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->PunjabiTags->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            $output['aaData'][]['PunjabiTags'] = array(
                'id'                =>  $key['PunjabiTags']['id'],
                'name'              =>  $key['PunjabiTags']['name'],
//                'tag_type'          =>  $key['PunjabiTagTypes']['name'],
//                'tag_type_text'     =>  $key['PunjabiTags']['tag_type_text'],
                'images'            =>  $key['PunjabiTags']['images'],
                'order'             =>  $key['PunjabiTags']['order'],
                'status'            =>  $key['PunjabiTags']['status'],
                'created_date'      =>  date('d/m/Y', $key['PunjabiTags']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['PunjabiTags']['modified_date']),
            );
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->PunjabiTags->create();
            
//            $type = $this->request->data['PunjabiTags']['tag_type'];
//            $options = array('conditions' => array('PunjabiTagTypes.' . $this->PunjabiTagTypes->primaryKey => $type));
//            $type_arr = $this->PunjabiTagTypes->find('first', $options);
//            
//            if(!empty($type_arr)) {
                $this->request->data['PunjabiTags']['status'] = 1;
                $this->request->data['PunjabiTags']['created_date'] = time();
                $this->request->data['PunjabiTags']['modified_date'] = time();
//                $this->request->data['PunjabiTags']['tag_type_text'] = $type_arr["PunjabiTagTypes"]["type_text"];
                
                $dir_temp = APP . 'webroot' . DS . 'uploads/PunjabiTags/';

                if(!empty($this->request->data['PunjabiTags']['images'])) {
                    $file_temp = $this->request->data['PunjabiTags']['images'];
                    $this->request->data['PunjabiTags']['images'] = URL_PATH . "uploads/PunjabiTags/" . $this->PunjabiTags->ImageUpload($dir_temp,$file_temp);

                }

                if ($this->PunjabiTags->save($this->request->data)) {
                    $this->Session->setFlash(__('PunjabiTags has been Add successfully'), 'swift_success');
                    return $this->redirect(array('controller'=>'PunjabiTags','action'=>'index'));
                } else {
                    $this->Session->setFlash(__("Unable to Add PunjabiTags"), 'swift_failure');
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
            $tags = $this->PunjabiTags->findById($id);
          
            if (!$this->PunjabiTags->exists($id)) {
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
            
            $options = array('conditions' => array('PunjabiTags.' . $this->PunjabiTags->primaryKey => $id));
            $this->request->data = $this->PunjabiTags->find('first', $options);
            
           
            $this->set('id', $this->request->data['PunjabiTags']['id']);
            $this->set(array(
                '_serialize' => array('PunjabiTags')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->PunjabiTags->id = $id;

        if ($this->PunjabiTags->exists($this->PunjabiTags->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
//                $type = $this->request->data['PunjabiTags']['tag_type'];
//                $options = array('conditions' => array('PunjabiTagTypes.' . $this->PunjabiTagTypes->primaryKey => $type));
//                $type_arr = $this->PunjabiTagTypes->find('first', $options);
//
//                if(!empty($type_arr)) {
                    $this->request->data['PunjabiTags']['modified_date'] = time();

                    $dir_temp = APP . 'webroot' . DS . 'uploads/PunjabiTags/';

                    if(!empty($this->request->data['PunjabiTags']['images'])) {
                        $file_temp = $this->request->data['PunjabiTags']['images'];
                        $this->request->data['PunjabiTags']['images'] = URL_PATH . "uploads/PunjabiTags/" . $this->PunjabiTags->ImageUpload($dir_temp,$file_temp);

                    }

                    if ($this->PunjabiTags->save($this->request->data)) {
                        $this->Session->setFlash(__('PunjabiTags has been Updated successfully'), 'swift_success');
                        return $this->redirect(array('action' => 'index'));
                    }   else {
                        $this->Session->setFlash(__("Unable to Updated PunjabiTags"), 'swift_failure');
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
        
        $this->PunjabiTags->id = $id;
        
        $PunjabiTags = $this->PunjabiTags->find('first',array('conditions' => array('PunjabiTags.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/PunjabiTags/', '', $PunjabiTags['PunjabiTags']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiTags/';
        $image = $dir_cvr.$img;
        
        if ($this->PunjabiTags->delete($this->PunjabiTags->id)) {
            unlink($image);
            $this->Session->setFlash(__("PunjabiTags has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The PunjabiTags with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    
                    $PunjabiTags = $this->PunjabiTags->find('first',array('conditions' => array('PunjabiTags.id' => $value)));
                    $img = str_replace(URL_PATH.'uploads/PunjabiTags/', '', $PunjabiTags['PunjabiTags']['images']);;
                    $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiTags/';
                    $image = $dir_cvr.$img;
                    
                    unlink($image);
                    $this->PunjabiTags->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
      
        $id = $this->request->data['id'];
        $PunjabiTags = $this->PunjabiTags->find('first',array('conditions' => array('PunjabiTags.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/PunjabiTags/', '', $PunjabiTags['PunjabiTags']['images']);;
        $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiTags/';
        $image = $dir_cvr.$img;
      
        $this->request->data['PunjabiTags']['id'] = $id;
        $this->request->data['PunjabiTags']['images'] = '';
        
        if($this->PunjabiTags->save($this->request->data)) {
            unlink($image);
        }
        
        exit; 
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['PunjabiTags']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->PunjabiTags->exists($id)) {
            throw new NotFoundException(__('Invalid PunjabiTags'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['PunjabiTags']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->PunjabiTags->save($this->request->data)) {                
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
            
            $sWhere = " PunjabiTagTypes.name LIKE '%".$type."%' ";
           
            $PunjabiTagTypes = $this->PunjabiTagTypes->find('all', array('conditions' => $sWhere));
         
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Tag Types --'
            );
            foreach ($PunjabiTagTypes as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['PunjabiTagTypes']['id'],
                    'text' => $value['PunjabiTagTypes']['name']
                );
            }
        }  else {
            $PunjabiTagTypes = $this->PunjabiTagTypes->find('all');
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Tag Types --'
            );
            foreach ($PunjabiTagTypes as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['PunjabiTagTypes']['id'],
                    'text' => $value['PunjabiTagTypes']['name']
                );
            }
        }
        
        echo json_encode($response); exit;
        
    }
    
    public function ifTag() {
        $tag = $this->request->data['tag'];
        
        if (isset($this->request->data['id']) && $this->request->data['tag'] != NULL) {
            $id = $this->request->data['id'];
            $ifPunjabiTags = $this->PunjabiTags->find('count', array('conditions' => array('PunjabiTags.name' => $tag, ' PunjabiTags.id !=' => $id)));
          
        } else { 
            $ifPunjabiTags = $this->PunjabiTags->find('count',array('conditions' => array('PunjabiTags.name' => $tag)));
        }
        
        $response = [];
        $response['code'] = 0;
        
        if (isset($ifPunjabiTags) && $ifPunjabiTags > 0) {
            $response['code'] = 201;
        } else {
            $response['code'] = 200;
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
