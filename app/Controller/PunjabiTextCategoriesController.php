<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP PunjabiTextCategoriesController
 * @author s4
 */
class PunjabiTextCategoriesController extends AppController {
    public $uses = array('PunjabiTextCategories');   
    
    public function index() {
        $description = 'Manage PunjabiTextCategories';
        $keywords = 'Manage PunjabiTextCategories';
        $this->set(compact('keywords', 'description'));
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','cat_name', 'image', 'order' ,'status', 'created_date' ,'modified_date');
        $search = array('cat_name', 'image','order');
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
                    $sOrder .= "PunjabiTextCategories.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " PunjabiTextCategories.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " PunjabiTextCategories.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->PunjabiTextCategories->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->PunjabiTextCategories->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->PunjabiTextCategories->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $output['aaData'][]['PunjabiTextCategories'] = array(
                'id'                =>  $key['PunjabiTextCategories']['id'],
                'cat_name'          =>  $key['PunjabiTextCategories']['cat_name'],
                'image'             =>  $key['PunjabiTextCategories']['image'],
                'order'             =>  $key['PunjabiTextCategories']['order'],
                'status'            =>  $key['PunjabiTextCategories']['status'],
                'created_date'      =>  date('d/m/Y', $key['PunjabiTextCategories']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['PunjabiTextCategories']['modified_date']),
            );
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            
            $this->PunjabiTextCategories->create();
            
            //firestore create
//            $firestore = $this->PunjabiTextCategories->initialize();
//            
//            $addedDocRef = $firestore->collection('text_categories')->newDocument();
//            $doc_id = $addedDocRef->id();
//            $catsRef = $firestore->collection('text_categories')->orderBy('id', 'DESC')->limit(1);
//            $documents = $catsRef->documents();
//            foreach ($documents as $document) {
//                $category = $document->data();
//                $last_id = $category['id'];
//            }
//            
//            $this->request->data['PunjabiTextCategories']['doc_id'] = $doc_id;
            $this->request->data['PunjabiTextCategories']['order'] = (int)$this->request->data['PunjabiTextCategories']['order'];
            $this->request->data['PunjabiTextCategories']['created_date'] = time();
            $this->request->data['PunjabiTextCategories']['modified_date'] = time();
            $this->request->data['PunjabiTextCategories']['status'] = 1;
            
            $dir_temp = APP . 'webroot' . DS . 'uploads/PunjabiTextCategories/';
           
            if(!empty($this->request->data['PunjabiTextCategories']['image'])) {
                $file_temp = $this->request->data['PunjabiTextCategories']['image'];
                $this->request->data['PunjabiTextCategories']['image'] = URL_PATH . "uploads/PunjabiTextCategories/" . $this->PunjabiTextCategories->ImageUpload($dir_temp,$file_temp);
              
            }
            
            if ($this->PunjabiTextCategories->save($this->request->data)) {
                
//                $this->request->data['PunjabiTextCategories']['id'] = (int)$this->PunjabiTextCategories->getLastInsertId();
//                $cat_data = $this->request->data['PunjabiTextCategories'];
//                $addedDocRef->set($cat_data);
                
                $this->Session->setFlash(__('PunjabiTextCategories has been Add successfully'), 'swift_success');
                return $this->redirect(array('controller'=>'PunjabiTextCategories','action'=>'index'));
            } else {
                $this->Session->setFlash(__("Unable to Add PunjabiTextCategories"), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
          
          
            if (!$this->PunjabiTextCategories->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('PunjabiTextCategories.' . $this->PunjabiTextCategories->primaryKey => $id));
            $this->request->data = $this->PunjabiTextCategories->find('first', $options);
            
           
            $this->set('id', $this->request->data['PunjabiTextCategories']['id']);
            $this->set(array(
                '_serialize' => array('PunjabiTextCategories')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->PunjabiTextCategories->id = $id;

        if ($this->PunjabiTextCategories->exists($this->PunjabiTextCategories->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['PunjabiTextCategories']['modified_date'] = time();
                
                $dir_temp = APP . 'webroot' . DS . 'uploads/PunjabiTextCategories/';
           
                if(!empty($this->request->data['PunjabiTextCategories']['image'])) {
                    $file_temp = $this->request->data['PunjabiTextCategories']['image'];
                    $this->request->data['PunjabiTextCategories']['image'] = URL_PATH . "uploads/PunjabiTextCategories/" . $this->PunjabiTextCategories->ImageUpload($dir_temp,$file_temp);

                }
           
                if ($this->PunjabiTextCategories->save($this->request->data)) {
                    
//                    $doc_id = $this->request->data['PunjabiTextCategories']['doc_id'];
//                    $firestore = $this->PunjabiTextCategories->initialize();
//                    $docRef = $firestore->collection('text_categories')->document($doc_id);
//                    $cat_data = $this->request->data['PunjabiTextCategories'];
//                    $docRef->set($cat_data, ['merge' => true]);
                
                    $this->Session->setFlash(__('PunjabiTextCategories has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Update PunjabiTextCategories"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->PunjabiTextCategories->id = $id;
        
        $PunjabiTextCategories = $this->PunjabiTextCategories->find('first',array('conditions' => array('PunjabiTextCategories.id' => $id)));
       
        $img = str_replace(URL_PATH.'uploads/PunjabiTextCategories/', '', $PunjabiTextCategories['PunjabiTextCategories']['image']);

        $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiTextCategories/';
        $image = $dir_cvr.$img;
        
        if ($this->PunjabiTextCategories->delete($this->PunjabiTextCategories->id)) {
                    
            unlink($image);
            $this->Session->setFlash(__("PunjabiTextCategories has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The PunjabiTextCategories with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $PunjabiTextCategories = $this->PunjabiTextCategories->find('first',array('conditions' => array('PunjabiTextCategories.id' => $value)));
       
                    $img = str_replace(URL_PATH.'uploads/PunjabiTextCategories/', '', $PunjabiTextCategories['PunjabiTextCategories']['image']);

                    $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiTextCategories/';
                    $image = $dir_cvr.$img;
                    
                    unlink($image);
                    $this->PunjabiTextCategories->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
        $id = $this->request->data['id'];
        $PunjabiTextCategories = $this->PunjabiTextCategories->find('first',array('conditions' => array('PunjabiTextCategories.id' => $id)));
       
        $img = str_replace(URL_PATH.'uploads/PunjabiTextCategories/', '', $PunjabiTextCategories['PunjabiTextCategories']['image']);
        
        $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiTextCategories/';
        $image = $dir_cvr.$img;
       
        $this->request->data['PunjabiTextCategories']['id']=$id;
        $this->request->data['PunjabiTextCategories']['image'] = '';
        if($this->PunjabiTextCategories->save($this->request->data)) {
            unlink($image);
        }
        exit; 
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['PunjabiTextCategories']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->PunjabiTextCategories->exists($id)) {
            throw new NotFoundException(__('Invalid PunjabiTextCategories'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['PunjabiTextCategories']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->PunjabiTextCategories->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
}
