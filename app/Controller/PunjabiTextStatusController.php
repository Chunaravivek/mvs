<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP PunjabiTextStatusController
 * @author s4
 */
class PunjabiTextStatusController extends AppController {
    public $uses = array('PunjabiTextStatus', 'PunjabiTextCategories', 'PunjabiTags');   
    
    public function index() {
        $description = 'Manage PunjabiTextStatus';
        $keywords = 'Manage PunjabiTextStatus';
        $this->set(compact('keywords', 'description'));
        
        $tagss = $this->PunjabiTags->find('list');
        
        $arr = ['' => 'Choose Tags...'];
        foreach ($tagss as $key => $value) {
            $arr[$key] = $value;
            
        }
        $this->set('tags', $arr);
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
                    $sOrder .= "PunjabiTextStatus.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
                
                $sWhere .= " PunjabiTextStatus.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " PunjabiTextStatus.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->PunjabiTextStatus->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
        
        $iTotal = $this->PunjabiTextStatus->find('count', array('conditions' => $sWhere, 'order' => $sOrder));
        
        $idisplayrecords = $this->PunjabiTextStatus->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            $output['aaData'][]['PunjabiTextStatus'] = array(
                'id'                =>  $key['PunjabiTextStatus']['id'],
                'tag_name'          =>  $key['PunjabiTags']['name'],
                'text'              =>  $key['PunjabiTextStatus']['text'],
                'status'            =>  $key['PunjabiTextStatus']['status'],
                'created_date'      =>  date('d/m/Y', $key['PunjabiTextStatus']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['PunjabiTextStatus']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->PunjabiTextStatus->create();
            
            //firestore create
//            $firestore = $this->PunjabiTextStatus->initialize();
//            $addedDocRef = $firestore->collection('text_status')->newDocument();
//            $doc_id = $addedDocRef->id();
//            $this->request->data['PunjabiTextStatus']['doc_id'] = $doc_id;
            $tag_id = $this->request->data['PunjabiTextStatus']['tag_id'];
            $tag_arr = $this->PunjabiTags->find('first', array('conditions' => array('PunjabiTags.id' => $tag_id)));
            $tag_name = $tag_arr['PunjabiTags']['name'];

            $this->request->data['PunjabiTextStatus']['tag_name'] = (string)$tag_name;
            $this->request->data['PunjabiTextStatus']['text'] = trim($this->request->data['PunjabiTextStatus']['text']);
            $this->request->data['PunjabiTextStatus']["views"] = rand(700, 5000);
            $this->request->data['PunjabiTextStatus']["downloads"] = rand(700, $this->request->data['PunjabiTextStatus']["views"]);
            $this->request->data['PunjabiTextStatus']['status'] = 1;
            $this->request->data['PunjabiTextStatus']['created_date'] = time();
            $this->request->data['PunjabiTextStatus']['modified_date'] = time();
            
            if ($this->PunjabiTextStatus->save($this->request->data)) {
                
//                $this->request->data['PunjabiTextStatus']['id'] = (int)$this->PunjabiTextStatus->getLastInsertId();
//                $cat_data = $this->request->data['PunjabiTextStatus'];
//                $addedDocRef->set($cat_data);
//                $conn = $this->PunjabiTextStatus->db();
//                $this->updateStatusCounts($firestore, $conn, $cat_id);
                
                $this->Session->setFlash(__('PunjabiTextStatus has been Add successfully'), 'swift_success');
                return $this->redirect(array('controller'=>'PunjabiTextStatus','action'=>'index'));
            } else {
                $this->Session->setFlash(__("Unable to pasword PunjabiTextStatus"), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
            
            $PunjabiTags = $this->PunjabiTags->find('all');
          
            $TextCategorie_arr = array('' => '-- SELECT Tags --');
            foreach ($PunjabiTags as &$Publisher) {
                $TextCategorie_arr[$Publisher['PunjabiTags']['id']] = $Publisher['PunjabiTags']['name'];
            }
          
            unset($Publisher);
            $this->set('PunjabiTags', $TextCategorie_arr);
          
            if (!$this->PunjabiTextStatus->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('PunjabiTextStatus.' . $this->PunjabiTextStatus->primaryKey => $id));
            $this->request->data = $this->PunjabiTextStatus->find('first', $options);
            
           
            $this->set('id', $this->request->data['PunjabiTextStatus']['id']);
            $this->set(array(
                '_serialize' => array('PunjabiTextStatus')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->PunjabiTextStatus->id = $id;

        if ($this->PunjabiTextStatus->exists($this->PunjabiTextStatus->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                
                $tag_id = $this->request->data['PunjabiTextStatus']['tag_id'];
                $tag_arr = $this->PunjabiTags->find('first', array('conditions' => array('PunjabiTags.id' => $tag_id)));
                $tag_name = $tag_arr['PunjabiTags']['name'];

                $this->request->data['PunjabiTextStatus']['tag_name'] = (string)$tag_name;
                $this->request->data['PunjabiTextStatus']['text'] = trim($this->request->data['PunjabiTextStatus']['text']);
                $this->request->data['PunjabiTextStatus']["views"] = rand(700, 5000);
                $this->request->data['PunjabiTextStatus']["downloads"] = rand(700, $this->request->data['PunjabiTextStatus']["views"]);
            
                $this->request->data['PunjabiTextStatus']['modified_date'] = time();
             
           
                if ($this->PunjabiTextStatus->save($this->request->data)) {
                    
//                    $doc_id = $this->request->data['PunjabiTextStatus']['doc_id'];
//                    $firestore = $this->PunjabiTextStatus->initialize();
//                    $docRef = $firestore->collection('text_status')->document($doc_id);
//                    $cat_data = $this->request->data['PunjabiTextStatus'];
//                    $docRef->set($cat_data, ['merge' => true]);
                
                    $this->Session->setFlash(__('PunjabiTextStatus has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add PunjabiTextStatus"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->PunjabiTextStatus->id = $id;
        
        if ($this->PunjabiTextStatus->delete($this->PunjabiTextStatus->id)) {
            $this->Session->setFlash(__("PunjabiTextStatus has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The PunjabiTextStatus with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->PunjabiTextStatus->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['PunjabiTextStatus']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->PunjabiTextStatus->exists($id)) {
            throw new NotFoundException(__('Invalid PunjabiTextStatus'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['PunjabiTextStatus']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->PunjabiTextStatus->save($this->request->data)) {                
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
            
            $sWhere = " PunjabiTags.name LIKE '%".$type."%' ";
           
            $PunjabiTags = $this->PunjabiTags->find('all', array('conditions' => $sWhere));
         
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Tags --'
            );
            foreach ($PunjabiTags as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['PunjabiTags']['id'],
                    'text' => $value['PunjabiTags']['name']
                );
            }
        }  else {
            $PunjabiTags = $this->PunjabiTags->find('all');
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT Tags --'
            );
            foreach ($PunjabiTags as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['PunjabiTags']['id'],
                    'text' => $value['PunjabiTags']['name']
                );
            }
        }
        
        echo json_encode($response); exit;
        
    }
}
