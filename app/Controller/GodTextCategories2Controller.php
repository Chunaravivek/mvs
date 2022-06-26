<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP GodTextCategories2Controller
 * @author s4
 */
class GodTextCategories2Controller extends AppController {
    public $uses = array('GodTextCategories2');   
    
    public function index() {
        $description = 'Manage GodTextCategories2';
        $keywords = 'Manage GodTextCategories2';
        $this->set(compact('keywords', 'description'));
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','cat_name', 'tagline', 'color' ,'image', 'order', 'totalstatus' ,'status', 'created_date' ,'modified_date');
        $search = array('cat_name', 'tagline' , 'color','image','order', 'totalstatus');
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
                    $sOrder .= "GodTextCategories2.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " GodTextCategories2.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " GodTextCategories2.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->GodTextCategories2->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->GodTextCategories2->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->GodTextCategories2->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $output['aaData'][]['GodTextCategories2'] = array(
                'id'                =>  $key['GodTextCategories2']['id'],
                'cat_name'          =>  $key['GodTextCategories2']['cat_name'],
                'tagline'           =>  $key['GodTextCategories2']['tagline'],
                'color'             =>  $key['GodTextCategories2']['color'],
                'image'             =>  $key['GodTextCategories2']['image'],
                'order'             =>  $key['GodTextCategories2']['order'],
                'totalstatus'       =>  $key['GodTextCategories2']['totalstatus'],
                'status'            =>  $key['GodTextCategories2']['status'],
                'created_date'      =>  date('d/m/Y', $key['GodTextCategories2']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['GodTextCategories2']['modified_date']),
            );
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            
            $this->GodTextCategories2->create();
            
            //firestore create
//            $firestore = $this->GodTextCategories2->initialize();
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
//            $this->request->data['GodTextCategories2']['doc_id'] = $doc_id;
            $this->request->data['GodTextCategories2']['order'] = (int)$this->request->data['GodTextCategories2']['order'];
            $this->request->data['GodTextCategories2']['created_date'] = time();
            $this->request->data['GodTextCategories2']['modified_date'] = time();
            $this->request->data['GodTextCategories2']['status'] = 1;
            
            $dir_temp = APP . 'webroot' . DS . 'uploads/GodTextCategories2/';
           
            if(!empty($this->request->data['GodTextCategories2']['image'])) {
                $file_temp = $this->request->data['GodTextCategories2']['image'];
                $this->request->data['GodTextCategories2']['image'] = URL_PATH . "uploads/GodTextCategories2/" . $this->GodTextCategories2->ImageUpload($dir_temp,$file_temp);
              
            }
            
            if ($this->GodTextCategories2->save($this->request->data)) {
                
//                $this->request->data['GodTextCategories2']['id'] = (int)$this->GodTextCategories2->getLastInsertId();
//                $cat_data = $this->request->data['GodTextCategories2'];
//                $addedDocRef->set($cat_data);
                
                $this->Session->setFlash(__('GodTextCategories2 has been Add successfully'), 'swift_success');
                return $this->redirect(array('controller'=>'GodTextCategories2','action'=>'index'));
            } else {
                $this->Session->setFlash(__("Unable to Add GodTextCategories2"), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
          
          
            if (!$this->GodTextCategories2->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('GodTextCategories2.' . $this->GodTextCategories2->primaryKey => $id));
            $this->request->data = $this->GodTextCategories2->find('first', $options);
            
           
            $this->set('id', $this->request->data['GodTextCategories2']['id']);
            $this->set(array(
                '_serialize' => array('GodTextCategories2')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->GodTextCategories2->id = $id;

        if ($this->GodTextCategories2->exists($this->GodTextCategories2->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['GodTextCategories2']['modified_date'] = time();
                
                $dir_temp = APP . 'webroot' . DS . 'uploads/GodTextCategories2/';
           
                if(!empty($this->request->data['GodTextCategories2']['image'])) {
                    $file_temp = $this->request->data['GodTextCategories2']['image'];
                    $this->request->data['GodTextCategories2']['image'] = URL_PATH . "uploads/GodTextCategories2/" . $this->GodTextCategories2->ImageUpload($dir_temp,$file_temp);

                }
           
                if ($this->GodTextCategories2->save($this->request->data)) {
                    
//                    $doc_id = $this->request->data['GodTextCategories2']['doc_id'];
//                    $firestore = $this->GodTextCategories2->initialize();
//                    $docRef = $firestore->collection('text_categories')->document($doc_id);
//                    $cat_data = $this->request->data['GodTextCategories2'];
//                    $docRef->set($cat_data, ['merge' => true]);
                
                    $this->Session->setFlash(__('GodTextCategories2 has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Update GodTextCategories2"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->GodTextCategories2->id = $id;
        
        $GodTextCategories2 = $this->GodTextCategories2->find('first',array('conditions' => array('GodTextCategories2.id' => $id)));
       
        $img = str_replace(URL_PATH.'uploads/GodTextCategories2/', '', $GodTextCategories2['GodTextCategories2']['image']);

        $dir_cvr = APP . 'webroot' . DS . 'uploads/GodTextCategories2/';
        $image = $dir_cvr.$img;
        
        if ($this->GodTextCategories2->delete($this->GodTextCategories2->id)) {
                    
            unlink($image);
            $this->Session->setFlash(__("GodTextCategories2 has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The GodTextCategories2 with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $GodTextCategories2 = $this->GodTextCategories2->find('first',array('conditions' => array('GodTextCategories2.id' => $value)));
       
                    $img = str_replace(URL_PATH.'uploads/GodTextCategories2/', '', $GodTextCategories2['GodTextCategories2']['image']);

                    $dir_cvr = APP . 'webroot' . DS . 'uploads/GodTextCategories2/';
                    $image = $dir_cvr.$img;
                    
                    unlink($image);
                    $this->GodTextCategories2->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
        $id = $this->request->data['id'];
        $GodTextCategories2 = $this->GodTextCategories2->find('first',array('conditions' => array('GodTextCategories2.id' => $id)));
       
        $img = str_replace(URL_PATH.'uploads/GodTextCategories2/', '', $GodTextCategories2['GodTextCategories2']['image']);
        
        $dir_cvr = APP . 'webroot' . DS . 'uploads/GodTextCategories2/';
        $image = $dir_cvr.$img;
       
        $this->request->data['GodTextCategories2']['id']=$id;
        $this->request->data['GodTextCategories2']['image'] = '';
        if($this->GodTextCategories2->save($this->request->data)) {
            unlink($image);
        }
        exit; 
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['GodTextCategories2']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->GodTextCategories2->exists($id)) {
            throw new NotFoundException(__('Invalid GodTextCategories2'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['GodTextCategories2']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->GodTextCategories2->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
}
