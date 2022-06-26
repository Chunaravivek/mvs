<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP GujaratiVideosController
 * @author s4
 */
class GujaratiVideosController extends AppController {
    public $uses = array('GujaratiTags', 'GujaratiVideos', 'Applications');   
    
    public function index() {
        $description = 'Manage GujaratiVideos';
        $keywords = 'Manage GujaratiVideos';
        $this->set(compact('keywords', 'description'));
        
        $tags = $this->GujaratiTags->find('list');
        $this->set('tags', $tags);
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','title','url', 'tags' , 'views' , 'downloads' ,'status', 'created_date' ,'modified_date');
        $search = array('title', 'url', 'tags', 'views', 'downloads');
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
                    $sOrder .= "GujaratiVideos.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
          
            $sWhere .= "AND GujaratiVideos.tags_id IN  ('".$tags_id."') ";
            
        }

        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " GujaratiVideos.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " GujaratiVideos.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->GujaratiVideos->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->GujaratiVideos->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->GujaratiVideos->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            $output['aaData'][]['GujaratiVideos'] = array(
                'id'                =>  $key['GujaratiVideos']['id'],
                'title'             =>  $key['GujaratiVideos']['title'],
                'url'               =>  $key['GujaratiVideos']['url'],
                'tags'              =>  $key['GujaratiVideos']['tags'],
                'views'             =>  $key['GujaratiVideos']['views'],
                'downloads'         =>  $key['GujaratiVideos']['downloads'],
                'status'            =>  $key['GujaratiVideos']['status'],
                'created_date'      =>  date('d/m/Y', $key['GujaratiVideos']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['GujaratiVideos']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if ($this->request->is('post')) {
          
            if (!empty($this->request->data['GujaratiVideos']['url'])) {
                $tags_id = $this->request->data['GujaratiVideos']['tags_id'];
                $checktags = $this->GujaratiTags->find('list', array('conditions' => array('GujaratiTags.id IN' => $tags_id)));
               
                if(!empty($checktags)) {
                  
                    $this->request->data['GujaratiVideos']['tags'] = implode(",", $checktags);
                    $this->request->data['GujaratiVideos']['tags_id'] = implode(",", $tags_id);
               
                    if(isset($this->request->data['GujaratiVideos']["modified_date"]) && $this->request->data['GujaratiVideos']["modified_date"] != "") {
                        
                        $external = $this->request->data['GujaratiVideos']["modified_date"];
                        $format = "d/m/Y";
                        $dateobj = DateTime::createFromFormat($format, $external);
                     
                        $iso_datetime = $dateobj->format(Datetime::ATOM);
                        $timestamp = strtotime($iso_datetime);
                      
                    } else {
                        $timestamp = time();
                    }
                    
                    if(!isset($this->request->data['GujaratiVideos']["views"]) || $this->request->data['GujaratiVideos']["views"] == "") {
                        $this->request->data['GujaratiVideos']["views"] = rand(700, 5000);
                    }
                    if(!isset($this->request->data['GujaratiVideos']["downloads"]) || $this->request->data['GujaratiVideos']["downloads"] == "") {
                        $this->request->data['GujaratiVideos']["downloads"] = rand(700, $this->request->data['GujaratiVideos']["views"]);
                    }
                    
                
                    //mysql create
                    $this->GujaratiVideos->create();
                    $this->request->data['GujaratiVideos']['created_date'] = (int)$timestamp;
                    $this->request->data['GujaratiVideos']['modified_date'] = (int)$timestamp;
                    $this->request->data['GujaratiVideos']['status'] = (int)1;
                    
                    $dir_categories = APP . 'webroot' . DS . 'uploads/GujaratiVideos/';
                    $file_temp = $this->request->data['GujaratiVideos']['url'];
                 
                    $path = URL_PATH . "uploads/GujaratiVideos/";
                    $vid_res = $this->GujaratiVideos->VideoUpload($dir_categories, $file_temp);
                    
                    $this->request->data['GujaratiVideos']['url'] = $path.$this->GujaratiVideos->VideoUpload($dir_categories, $file_temp);
                    $url = $this->request->data['GujaratiVideos']['url'];
                    
                    $checkvideo = $this->GujaratiVideos->find('first', array('conditions' => array('OR' => array(array('GujaratiVideos.url' => $url),array('GujaratiVideos.url' => str_replace(" ", "%20", $url))))));
                    
                    if (empty($checkvideo)) {
                       
                        if ($this->GujaratiVideos->save($this->request->data)) {
                            $this->Session->setFlash(__('The Video has been saved'), 'swift_success');
                            return $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Session->setFlash(__('The Video could not be saved. Please, try again.'), 'swift_failure');
                            return $this->redirect(array('action' => 'index'));
                        }
                    } else {
                        $this->Session->setFlash(__('This Video Name/URL already exist.'), 'swift_failure');
                        return $this->redirect(array('action' => 'index'));
                    }
                } else {
                    $this->Session->setFlash(__('Invalid tags.'), 'swift_failure');
                    return $this->redirect(array('action' => 'index'));
                }

            } else {
                $this->Session->setFlash(__('Video could not be empty.'), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function ytadd() {
        if ($this->request->is('post')) {
            if (!empty($this->request->data['GujaratiVideos']['yturl'])) {
                
                $tags_id = $this->request->data['GujaratiVideos']['tags_id'];
                $checktags = $this->GujaratiTags->find('list', array('conditions' => array('GujaratiTags.id IN' => $tags_id)));
                if(!empty($checktags)) {
                    $this->request->data['GujaratiVideos']['tags'] = implode(",", $checktags);
                    $this->request->data['GujaratiVideos']['tags_id'] = implode(",", $tags_id);
                    
                    if(isset($this->request->data['GujaratiVideos']["modified_date"]) && $this->request->data['GujaratiVideos']["modified_date"] != "") {
                        $external = $this->request->data['GujaratiVideos']["modified_date"];
                        $format = "d/m/Y";
                        $dateobj = DateTime::createFromFormat($format, $external);
                        $iso_datetime = $dateobj->format(Datetime::ATOM);
                        $timestamp = strtotime($iso_datetime);
                    } else {
                        $timestamp = time();
                    }
                    
                    if(!isset($this->request->data['GujaratiVideos']["views"]) || $this->request->data['GujaratiVideos']["views"] == "") {
                        $this->request->data['GujaratiVideos']["views"] = rand(700, 5000);
                    }
                    if(!isset($this->request->data['GujaratiVideos']["downloads"]) || $this->request->data['GujaratiVideos']["downloads"] == "") {
                        $this->request->data['GujaratiVideos']["downloads"] = rand(700, $this->request->data['GujaratiVideos']["views"]);
                    }
                  
                    $yturl = $this->request->data['GujaratiVideos']['yturl'];
                    $yt_prefix = "https://www.youtube.com/watch?v=";
                    if (strpos($yturl, $yt_prefix) !== false) {
                        
                        $yt_arr = explode("=", $yturl);
                      
                        $video_id = end($yt_arr);
                        
                        $dir_vids = APP . 'webroot' . DS . 'uploads/GujaratiVideos/';
                        
                        $BASEURL = URL_PATH . "uploads/GujaratiVideos/";
                        
                        $result = $this->GujaratiVideos->getYTGujaratiVideos($BASEURL, $dir_vids, $video_id);
                      
                        if($result['status'] == 1 && $result['msg'] == 'success') {
                            $external = $this->request->data['GujaratiVideos']["modified_date"];
                            $format = "d/m/Y";
                            $dateobj = DateTime::createFromFormat($format, $external);
                            $iso_datetime = $dateobj->format(Datetime::ATOM);
                            $time = strtotime($iso_datetime);
                            $this->request->data['GujaratiVideos']['url'] = (string)$result['video'];
                            $this->request->data['GujaratiVideos']['title'] = (string)$result['title'];
                            $this->GujaratiVideos->create();
                            $this->request->data['GujaratiVideos']['created_date'] = (int)$time;
                            $this->request->data['GujaratiVideos']['modified_date'] = (int)$time;
                            $this->request->data['GujaratiVideos']['status'] = (int)1;
                            if ($this->GujaratiVideos->save($this->request->data)) {
                                
                                $this->Session->setFlash(__('The GujaratiVideos has been saved'), 'swift_success');
                                return $this->redirect(array('action' => 'index'));
                                
                            } else {
                                
                                $this->Session->setFlash(__('The GujaratiVideos could not be saved. Please, try again.'), 'swift_failure');
                                return $this->redirect(array('action' => 'index'));
                            }
                        } else {
                            $this->Session->setFlash(__($result['msg']), 'swift_failure');
                            return $this->redirect(array('action' => 'index'));
                        }

                    } else {
                        $this->Session->setFlash(__('Invalid Youtube url.'), 'swift_failure');
                        return $this->redirect(array('action' => 'index'));
                    }
                } else {
                    $this->Session->setFlash(__('Invalid tags.'), 'swift_failure');
                    return $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('Video could not be empty.'), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit() {
        
        if( $this->request->is('ajax') ) {
            $id = $this->request->data('id');
            
            $GujaratiVideos = $this->GujaratiVideos->findById($id);
          
            if (!$this->GujaratiVideos->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            $options = array('conditions' => array('GujaratiVideos.' . $this->GujaratiVideos->primaryKey => $id));
            $this->request->data = $this->GujaratiVideos->find('first', $options);
            
            $this->request->data['GujaratiVideos']['modified_date'] = date("d/m/Y", $this->request->data['GujaratiVideos']['modified_date']);
            $this->request->data['GujaratiVideos']['tags_id'] = explode(",", $this->request->data['GujaratiVideos']['tags_id']);
            $tags = $this->GujaratiTags->find('list');
            $this->set('tags', $tags);
            
            $this->set('id', $this->request->data['GujaratiVideos']['id']);
            $this->set(array(
                '_serialize' => array('GujaratiVideos')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->GujaratiVideos->id = $id;

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['GujaratiVideos']['id'] = (int)$id;
            $tags_id = $this->request->data['GujaratiVideos']['tags_id'];
            $checktags = $this->GujaratiTags->find('list', array('conditions' => array('GujaratiTags.id IN' => $tags_id)));
            if(!empty($checktags)) {
                $this->request->data['GujaratiVideos']['tags'] = implode(",", $checktags);
                $this->request->data['GujaratiVideos']['tags_id'] = implode(",", $tags_id);
                $external = $this->request->data['GujaratiVideos']["modified_date"];
                $format = "d/m/Y";
                $dateobj = DateTime::createFromFormat($format, $external);
                $iso_datetime = $dateobj->format(Datetime::ATOM);
                $timestamp = strtotime($iso_datetime);
                
                $this->request->data['GujaratiVideos']['modified_date'] = (int)$timestamp;
                $this->request->data['GujaratiVideos']['views'] = (int)$this->request->data['GujaratiVideos']['views'];
                $this->request->data['GujaratiVideos']['downloads'] = (int)$this->request->data['GujaratiVideos']['downloads'];

                $cat_name = "";
                $this->GujaratiVideos->create();
                $dir_gallery = APP . 'webroot' . DS . 'uploads/GujaratiVideos/';
                if (isset($this->request->data['GujaratiVideos']['url']) && $this->request->data['GujaratiVideos']['url'] != '') {
                    $path = URL_PATH . "uploads/GujaratiVideos/";
                    $file_temp = $this->request->data['GujaratiVideos']['url'];
                   
                    $this->request->data['GujaratiVideos']['url'] = $path.$this->GujaratiVideos->VideoUpload($dir_gallery, $file_temp);
                    $url = $this->request->data['GujaratiVideos']['url'];
                    $checkvideo = $this->GujaratiVideos->find('first', array('conditions' => array('OR' => array(array('GujaratiVideos.url' => $url),array('GujaratiVideos.url' => str_replace(" ", "%20", $url))), 'AND' => array(array('GujaratiVideos.id !=' => $id)))));
                  
                    if (!empty($checkvideo)) {
                        $this->Session->setFlash(__('This Video already exist.'), 'swift_failure');
                        return $this->redirect(array('action' => 'index'));
                    }
                }
                if ($this->GujaratiVideos->save($this->request->data)) {
                    $this->Session->setFlash(__('The GujaratiVideos has been saved'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The GujaratiVideos could not be saved. Please, try again.'), 'swift_failure');
                    return $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('Invalid tags'), 'swift_failure');
                return $this->redirect(array('action' => 'index'));
            }
        } 
    }
    
    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->GujaratiVideos->id = $id;
        
        $GujaratiVideos = $this->GujaratiVideos->find('first',array('conditions' => array('GujaratiVideos.id' => $id)));
                    
        $mp4 = str_replace(URL_PATH.'uploads/GujaratiVideos/', '', $GujaratiVideos['GujaratiVideos']['url']);
        $dir_cvr = APP . 'webroot' . DS . 'uploads/GujaratiVideos/';
        $video = $dir_cvr.$mp4;
        $videoimg = $dir_cvr.$mp4.'.jpg';
        
        if ($this->GujaratiVideos->delete($this->GujaratiVideos->id)) {
            unlink($video);
            unlink($videoimg);
            $this->Session->setFlash(__("GujaratiVideos has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The GujaratiVideos with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $GujaratiVideos = $this->GujaratiVideos->find('first',array('conditions' => array('GujaratiVideos.id' => $value)));
                   
                    $mp4 = str_replace(URL_PATH.'uploads/GujaratiVideos/', '', $GujaratiVideos['GujaratiVideos']['url']);
                    $dir_cvr = APP . 'webroot' . DS . 'uploads/GujaratiVideos/';
                    $video = $dir_cvr.$mp4;
                    $videoimg = $dir_cvr.$mp4.'.jpg';
                  
                    unlink($video);
                    unlink($videoimg);
                    
                    $this->GujaratiVideos->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
        $id = $this->request->data['id'];
        $GujaratiVideos = $this->GujaratiVideos->find('first',array('conditions' => array('GujaratiVideos.id' => $id)));
        $mp4 = str_replace(URL_PATH.'uploads/GujaratiVideos/', '', $GujaratiVideos['GujaratiVideos']['url']);
        $dir_cvr = APP . 'webroot' . DS . 'uploads/GujaratiVideos/';
        $video = $dir_cvr.$mp4;
        $videoimg = $dir_cvr.$mp4.'.jpg';
       
        $this->request->data['GujaratiVideos']['id']=$id;
        $this->request->data['GujaratiVideos']['url'] = '';
        if($this->GujaratiVideos->save($this->request->data)) {
            unlink($video);
            unlink($videoimg);
        }
        exit; 
   }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['GujaratiVideos']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->GujaratiVideos->exists($id)) {
            throw new NotFoundException(__('Invalid GujaratiVideos'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['GujaratiVideos']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->GujaratiVideos->save($this->request->data)) {                
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

}
