<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP GodTextStatusController
 * @author s4
 */
class GodTextStatusController extends AppController {
    public $uses = array('GodTextStatus', 'GodTextCategories', 'GodTags');   
    
    public function index() {
        $description = 'Manage GodTextStatus';
        $keywords = 'Manage GodTextStatus';
        $this->set(compact('keywords', 'description'));
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id', '' ,'text' ,'status', 'created_date' ,'modified_date');
        $search = array('text');
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
                    $sOrder .= "GodTextStatus.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " GodTextStatus.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " GodTextStatus.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->GodTextStatus->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->GodTextStatus->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->GodTextStatus->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $output['aaData'][]['GodTextStatus'] = array(
                'id'                =>  $key['GodTextStatus']['id'],
                'tag_name'          =>  $key['GodTags']['name'],
                'text'              =>  $key['GodTextStatus']['text'],
                'status'            =>  $key['GodTextStatus']['status'],
                'created_date'      =>  date('d/m/Y', $key['GodTextStatus']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['GodTextStatus']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->GodTextStatus->create();
            
            //firestore create
//            $firestore = $this->GodTextStatus->initialize();
//            $addedDocRef = $firestore->collection('text_status')->newDocument();
//            $doc_id = $addedDocRef->id();
//            $this->request->data['GodTextStatus']['doc_id'] = $doc_id;
            $tag_id = $this->request->data['GodTextStatus']['tag_id'];
            $tag_arr = $this->GodTags->find('first', array('conditions' => array('GodTags.id' => $tag_id)));
            $tag_name = $tag_arr['GodTags']['name'];
            
            $this->request->data['GodTextStatus']['tag_name'] = (string)$tag_name;
            $this->request->data['GodTextStatus']['text'] = trim($this->request->data['GodTextStatus']['text']);
            $this->request->data['GodTextStatus']["views"] = rand(700, 5000);
            $this->request->data['GodTextStatus']["downloads"] = rand(700, $this->request->data['GodTextStatus']["views"]);
            $this->request->data['GodTextStatus']['status'] = 1;
            $this->request->data['GodTextStatus']['created_date'] = time();
            $this->request->data['GodTextStatus']['modified_date'] = time();
            
            if ($this->GodTextStatus->save($this->request->data)) {
                
//                $this->request->data['GodTextStatus']['id'] = (int)$this->GodTextStatus->getLastInsertId();
//                $cat_data = $this->request->data['GodTextStatus'];
//                $addedDocRef->set($cat_data);
//                $conn = $this->GodTextStatus->db();
//                $this->updateStatusCounts($firestore, $conn, $tag_id);
                
                $this->Session->setFlash(__('GodTextStatus has been Add successfully'), 'swift_success');
                return $this->redirect(array('controller'=>'GodTextStatus','action'=>'index'));
            } else {
                $this->Session->setFlash(__("Unable to pasword GodTextStatus"), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
            
            $GodTags = $this->GodTags->find('all');
          
            $TextCategorie_arr = array('' => '-- SELECT Tags --');
            foreach ($GodTags as &$Publisher) {
                $TextCategorie_arr[$Publisher['GodTags']['id']] = $Publisher['GodTags']['name'];
            }
          
            unset($Publisher);
           
            $this->set('GodTags', $TextCategorie_arr);
          
            if (!$this->GodTextStatus->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('GodTextStatus.' . $this->GodTextStatus->primaryKey => $id));
            $this->request->data = $this->GodTextStatus->find('first', $options);
            
           
            $this->set('id', $this->request->data['GodTextStatus']['id']);
            $this->set(array(
                '_serialize' => array('GodTextStatus')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->GodTextStatus->id = $id;

        if ($this->GodTextStatus->exists($this->GodTextStatus->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                
                $tag_id = $this->request->data['GodTextStatus']['tag_id'];
                $tag_arr = $this->GodTags->find('first', array('conditions' => array('GodTags.id' => $tag_id)));
                $tag_name = $tag_arr['GodTags']['name'];

                $this->request->data['GodTextStatus']['tag_name'] = (string)$tag_name;
                $this->request->data['GodTextStatus']["views"] = rand(700, 5000);
                $this->request->data['GodTextStatus']["downloads"] = rand(700, $this->request->data['GodTextStatus']["views"]);
                $this->request->data['GodTextStatus']['text'] = trim($this->request->data['GodTextStatus']['text']);
                $this->request->data['GodTextStatus']['modified_date'] = time();
             
           
                if ($this->GodTextStatus->save($this->request->data)) {
                    
//                    $doc_id = $this->request->data['GodTextStatus']['doc_id'];
//                    $firestore = $this->GodTextStatus->initialize();
//                    $docRef = $firestore->collection('text_status')->document($doc_id);
//                    $cat_data = $this->request->data['GodTextStatus'];
//                    $docRef->set($cat_data, ['merge' => true]);
                
                    $this->Session->setFlash(__('GodTextStatus has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add GodTextStatus"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->GodTextStatus->id = $id;
        
        if ($this->GodTextStatus->delete($this->GodTextStatus->id)) {
            $this->Session->setFlash(__("GodTextStatus has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The GodTextStatus with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->GodTextStatus->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['GodTextStatus']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->GodTextStatus->exists($id)) {
            throw new NotFoundException(__('Invalid GodTextStatus'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['GodTextStatus']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->GodTextStatus->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
    
    public function TagSelect() {
       
        if (isset($this->request->query['searchTerm']) && $this->request->query['searchTerm'] != '') {
            $type = $this->request->query['searchTerm'];
            
            $sWhere = " GodTags.name LIKE '%".$type."%' ";
           
            $GodTags = $this->GodTags->find('all', array('conditions' => $sWhere));
         
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Tags --'
            );
            foreach ($GodTags as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['GodTags']['id'],
                    'text' => $value['GodTags']['name']
                );
            }
        }  else {
            $GodTags = $this->GodTags->find('all');
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Tags --'
            );
            foreach ($GodTags as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['GodTags']['id'],
                    'text' => $value['GodTags']['name']
                );
            }
        }
        
        echo json_encode($response); exit;
        
    }
}
