<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP PunjabiImagesController
 * @author s4
 */
class PunjabiImagesController extends AppController {
    public $uses = array('PunjabiTags', 'PunjabiImages', 'Applications');   
    
    public function index() {
        $description = 'Manage PunjabiImages';
        $keywords = 'Manage PunjabiImages';
        $this->set(compact('keywords', 'description'));
        
        $tags = $this->PunjabiTags->find('list');
        $this->set('tags', $tags);
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','title','image', 'tags' , 'views' , 'downloads' ,'status', 'created_date' ,'modified_date');
        $search = array('title', 'image', 'tags', 'views', 'downloads');
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
                    $sOrder .= "PunjabiImages.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
        
        if (isset($this->request->query['tags_id']) && $this->request->query['tags_id'] != NULL) {
           
            $tags_id = $this->request->query['tags_id'];
          
            $sWhere .= "AND PunjabiImages.tags_id IN  ('".$tags_id."') ";
            
        }

        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " PunjabiImages.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " PunjabiImages.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->PunjabiImages->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->PunjabiImages->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->PunjabiImages->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            $output['aaData'][]['PunjabiImages'] = array(
                'id'                =>  $key['PunjabiImages']['id'],
                'title'             =>  $key['PunjabiImages']['title'],
                'image'             =>  $key['PunjabiImages']['image'],
                'tags'              =>  $key['PunjabiImages']['tags'],
                'views'             =>  $key['PunjabiImages']['views'],
                'downloads'         =>  $key['PunjabiImages']['downloads'],
                'status'            =>  $key['PunjabiImages']['status'],
                'created_date'      =>  date('d/m/Y', $key['PunjabiImages']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['PunjabiImages']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if ($this->request->is('post')) {
            
            if (!empty($this->request->data['PunjabiImages']['image'])) {
                
                $tag_ids = $this->request->data['PunjabiImages']['tags_id'];
                $checktags = $this->PunjabiTags->find('list', array('conditions' => array('PunjabiTags.id IN' => $tag_ids)));
                
                if(!empty($checktags)) {
                    
                    $this->request->data['PunjabiImages']['tags'] = implode(",", $checktags);
                    $this->request->data['PunjabiImages']['tags_id'] = implode(",", $tag_ids);
                    
                    $dir_frame = APP . 'webroot' . DS . 'uploads/PunjabiImages/';
                    $BASE_URL = URL_PATH . "uploads/PunjabiImages/";
                    $THMB_URL = $BASE_URL . "thumbs/";
                    $PunjabiImages = $this->request->data['PunjabiImages']['image'];
                    $title = $this->request->data['PunjabiImages']['title'];
                    $count = 0;
                    
                    if (!empty($PunjabiImages)) {
                        foreach ($PunjabiImages as $image) {
                            
                            $image_res = $this->PunjabiImages->ImageUpload2($dir_frame, $image);
                            
                            if($image_res) {
                                
                                $code = $this->randomCode(5);
                                $this->request->data['PunjabiImages']['title'] = $title." ".$code;
                                $this->request->data['PunjabiImages']['image'] = $BASE_URL.$image_res;
                                $this->request->data['PunjabiImages']['thumb'] = $THMB_URL.$image_res;
                                $this->request->data['PunjabiImages']["views"] = rand(700, 5000);
                                $this->request->data['PunjabiImages']["downloads"] = rand(700, $this->request->data['PunjabiImages']["views"]);
                                $timestamp = time();
                                $this->request->data['PunjabiImages']['created_date'] = (int)$timestamp;
                                $this->request->data['PunjabiImages']['modified_date'] = (int)$timestamp;
                                $this->PunjabiImages->create();
                                
                                if ($this->PunjabiImages->save($this->request->data)) {
                                    $count++;
                                }
                            }
                        }
                    }
                    $this->Session->setFlash(__('Added '.($count).' PunjabiImages'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Invalid tags.'), 'swift_failure');
                    return $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('Image could not be empty.'), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->PunjabiImages->id = $id;
        
        $PunjabiImages = $this->PunjabiImages->find('first',array('conditions' => array('PunjabiImages.id' => $id)));
                    
        $img = str_replace(URL_PATH.'uploads/PunjabiImages/', '', $PunjabiImages['PunjabiImages']['image']);
        $thumb_img = str_replace(URL_PATH.'uploads/PunjabiImages/thumbs/', '', $PunjabiImages['PunjabiImages']['thumb']);

        $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiImages/';
        $dir_thumb_cvr = APP . 'webroot' . DS . 'uploads/PunjabiImages/thumbs/';

        $image = $dir_cvr.$img;
        $dir_thumb_cvr = $dir_thumb_cvr.$thumb_img;
        
        if ($this->PunjabiImages->delete($this->PunjabiImages->id)) {
            unlink($image);
            unlink($dir_thumb_cvr);
            $this->Session->setFlash(__("PunjabiImages has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The PunjabiImages with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $PunjabiImages = $this->PunjabiImages->find('first',array('conditions' => array('PunjabiImages.id' => $value)));
                   
                    $img = str_replace(URL_PATH.'uploads/PunjabiImages/', '', $PunjabiImages['PunjabiImages']['image']);
                    $thumb_img = str_replace(URL_PATH.'uploads/PunjabiImages/thumbs/', '', $PunjabiImages['PunjabiImages']['thumb']);
                   
                    $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiImages/';
                    $dir_thumb_cvr = APP . 'webroot' . DS . 'uploads/PunjabiImages/thumbs/';

                    $image = $dir_cvr.$img;
                    $dir_thumb_cvr = $dir_thumb_cvr.$thumb_img;
                 
                    unlink($image);
                    unlink($dir_thumb_cvr);
                    
                    $this->PunjabiImages->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
        $id = $this->request->data['id'];
        $PunjabiImages = $this->PunjabiImages->find('first',array('conditions' => array('PunjabiImages.id' => $id)));
        $img = str_replace(URL_PATH.'uploads/PunjabiImages/', '', $PunjabiImages['PunjabiImages']['image']);
        $thumb_img = str_replace(URL_PATH.'uploads/PunjabiImages/thumbs/', '', $PunjabiImages['PunjabiImages']['thumb']);
        
        $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiImages/';
        $dir_thumb_cvr = APP . 'webroot' . DS . 'uploads/PunjabiImages/thumbs/';
        
        $image = $dir_cvr.$mp4;
        $dir_thumb_cvr = $dir_thumb_cvr.$thumb_img;
       
        $this->request->data['PunjabiImages']['id']=$id;
        $this->request->data['PunjabiImages']['image'] = '';
        $this->request->data['PunjabiImages']['thumb'] = '';
        if($this->PunjabiImages->save($this->request->data)) {
            unlink($image);
            unlink($dir_thumb_cvr);
        }
        exit; 
   }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['PunjabiImages']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->PunjabiImages->exists($id)) {
            throw new NotFoundException(__('Invalid PunjabiImages'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['PunjabiImages']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->PunjabiImages->save($this->request->data)) {                
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }
    
    public function AppSelect() {
       
        if (isset($this->request->query['searchTerm']) && $this->request->query['searchTerm'] != '') {
            $type = $this->request->query['searchTerm'];
            
            $sWhere = " Applications.name LIKE '%".$type."%' ";
           
            $Applications = $this->Applications->find('all', array('conditions' => $sWhere));
         
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT APP --'
            );
            foreach ($Applications as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['Applications']['id'],
                    'text' => $value['Applications']['name']
                );
            }
        }  else {
            $Applications = $this->Applications->find('all');
            $response = [];
            $response[] = array(
                'id'   => '',
                'text' => '-- SELECT APP --'
            );
            foreach ($Applications as $key => $value) {
                
                $response[] = array(
                    'id'   => $value['Applications']['id'],
                    'text' => $value['Applications']['name']
                );
            }
        }
        
        echo json_encode($response); exit;
        
    }
    
    function randomCode($length) {
        $random = "";

        srand((double) microtime() * 1000000);

        $data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $data .= "abcdefghijklmnopqrstuvxyz";
        $data .= "0123456789";

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }

}
