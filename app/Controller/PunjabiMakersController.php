<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP PunjabiMakersController
 * @author s4
 */
class PunjabiMakersController extends AppController {
    public $uses = array('PunjabiTags', 'PunjabiMakers', 'Applications');   
    
    public function index() {
        $description = 'Manage PunjabiMakers';
        $keywords = 'Manage PunjabiMakers';
        $this->set(compact('keywords', 'description'));
        
        $tags = $this->PunjabiTags->find('list');
        $this->set('tags', $tags);
    }
    
    public function records() {
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('','id','title','tags' ,'url','image', 'zip' , 'views' , 'downloads' ,'status', 'created_date' ,'modified_date');
        $search = array('title', 'url', 'tags','image', 'zip' ,'views', 'downloads');
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
                    $sOrder .= "PunjabiMakers.".$aColumns[ intval( $this->request->query['iSortCol_'.$i] ) ]." ".
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
          
            $sWhere .= "AND PunjabiMakers.tags_id IN  ('".$tags_id."') ";
            
        }

        if ( isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
                
                $sWhere .= " PunjabiMakers.".$search[$i]." LIKE '%". $this->request->query['sSearch'] ."%' OR ";
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
                $sWhere = " PunjabiMakers.".$search[$i]." LIKE '%".$this->request->query['sSearch_'.$i]."%' ";
            }
            
        }
       
      
        // echo "<pre>"; print_r($this->request->query); exit;
       
        $keys = $this->PunjabiMakers->find('all', array('conditions' => $sWhere ,'order' => $sOrder, 'offset' => $offset , 'limit' => $sLimit));
       
        $iTotal = $this->PunjabiMakers->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->PunjabiMakers->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            $output['aaData'][]['PunjabiMakers'] = array(
                'id'                =>  $key['PunjabiMakers']['id'],
                'tags'              =>  $key['PunjabiMakers']['tags'],
                'title'             =>  $key['PunjabiMakers']['title'],
                'url'               =>  $key['PunjabiMakers']['url'],
                'image'             =>  $key['PunjabiMakers']['image'],
                'zip'               =>  $key['PunjabiMakers']['zip'],
                'views'             =>  $key['PunjabiMakers']['views'],
                'downloads'         =>  $key['PunjabiMakers']['downloads'],
                'status'            =>  $key['PunjabiMakers']['status'],
                'created_date'      =>  date('d/m/Y', $key['PunjabiMakers']['created_date']),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key['PunjabiMakers']['modified_date']),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    public function add() {
        if ($this->request->is('post')) {
          
            if (!empty($this->request->data['PunjabiMakers']['url'])) {
                $tags_id = $this->request->data['PunjabiMakers']['tags_id'];
                $checktags = $this->PunjabiTags->find('list', array('conditions' => array('PunjabiTags.id' => $tags_id)));
               
                if(!empty($checktags)) {
                  
                    $this->request->data['PunjabiMakers']['tags'] = implode(",", $checktags);
               
                    if(isset($this->request->data['PunjabiMakers']["modified_date"]) && $this->request->data['PunjabiMakers']["modified_date"] != "") {
                        
                        $external = $this->request->data['PunjabiMakers']["modified_date"];
                        $format = "d/m/Y";
                        $dateobj = DateTime::createFromFormat($format, $external);
                     
                        $iso_datetime = $dateobj->format(Datetime::ATOM);
                        $timestamp = strtotime($iso_datetime);
                      
                    } else {
                        $timestamp = time();
                    }
                    
                    if(!isset($this->request->data['PunjabiMakers']["views"]) || $this->request->data['PunjabiMakers']["views"] == "") {
                        $this->request->data['PunjabiMakers']["views"] = rand(700, 5000);
                    }
                    if(!isset($this->request->data['PunjabiMakers']["downloads"]) || $this->request->data['PunjabiMakers']["downloads"] == "") {
                        $this->request->data['PunjabiMakers']["downloads"] = rand(700, $this->request->data['PunjabiMakers']["views"]);
                    }
                    
                
                    //mysql create
                    $this->PunjabiMakers->create();
                    $this->request->data['PunjabiMakers']['created_date'] = (int)$timestamp;
                    $this->request->data['PunjabiMakers']['modified_date'] = (int)$timestamp;
                    $this->request->data['PunjabiMakers']['status'] = (int)1;
                    
                    $title = trim($this->request->data['PunjabiMakers']['title']);
                    
                    $dir_categories = APP . 'webroot' . DS . 'uploads/PunjabiMakers/';
                    $file_temp = $this->request->data['PunjabiMakers']['url'];
                 
                    $path = URL_PATH . "uploads/PunjabiMakers/";
                    $vid_res = $this->PunjabiMakers->VideoUpload2($dir_categories, $file_temp, $title);
                   
                    $zip_name = $dir_categories. 'zip/'.$title.'.zip';
                    exec("find '$zip_name' -type d -exec chmod 0777 {} +");
                    chmod($zip_name, 0777);
                    
                    $this->request->data['PunjabiMakers']['url'] = $path.str_replace('/Library/WebServer/Documents/mvs/app/webroot/uploads/PunjabiMakers/', '', $vid_res['video']);
                    $this->request->data['PunjabiMakers']['image'] = $path.str_replace('/Library/WebServer/Documents/mvs/app/webroot/uploads/PunjabiMakers/', '', $vid_res['thumb']);
                    $this->request->data['PunjabiMakers']['zip'] = $path.$title.'.zip';
                    $url = $this->request->data['PunjabiMakers']['url'];
                    
                    $checkvideo = $this->PunjabiMakers->find('first', array('conditions' => array('OR' => array(array('PunjabiMakers.url' => $url),array('PunjabiMakers.url' => str_replace(" ", "%20", $url))))));
                    
                    if (empty($checkvideo)) {
                       
                        if ($this->PunjabiMakers->save($this->request->data)) {
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
            if (!empty($this->request->data['PunjabiMakers']['yturl'])) {
                
                $tags_id = $this->request->data['PunjabiMakers']['tags_id'];
                $checktags = $this->PunjabiTags->find('list', array('conditions' => array('PunjabiTags.id IN' => $tags_id)));
                if(!empty($checktags)) {
                    $this->request->data['PunjabiMakers']['tags'] = implode(",", $checktags);
                    $this->request->data['PunjabiMakers']['tags_id'] = implode(",", $tags_id);
                    
                    if(isset($this->request->data['PunjabiMakers']["modified_date"]) && $this->request->data['PunjabiMakers']["modified_date"] != "") {
                        $external = $this->request->data['PunjabiMakers']["modified_date"];
                        $format = "d/m/Y";
                        $dateobj = DateTime::createFromFormat($format, $external);
                        $iso_datetime = $dateobj->format(Datetime::ATOM);
                        $timestamp = strtotime($iso_datetime);
                    } else {
                        $timestamp = time();
                    }
                    
                    if(!isset($this->request->data['PunjabiMakers']["views"]) || $this->request->data['PunjabiMakers']["views"] == "") {
                        $this->request->data['PunjabiMakers']["views"] = rand(700, 5000);
                    }
                    if(!isset($this->request->data['PunjabiMakers']["downloads"]) || $this->request->data['PunjabiMakers']["downloads"] == "") {
                        $this->request->data['PunjabiMakers']["downloads"] = rand(700, $this->request->data['PunjabiMakers']["views"]);
                    }
                  
                    $yturl = $this->request->data['PunjabiMakers']['yturl'];
                    $yt_prefix = "https://www.youtube.com/watch?v=";
                    if (strpos($yturl, $yt_prefix) !== false) {
                        
                        $yt_arr = explode("=", $yturl);
                      
                        $video_id = end($yt_arr);
                        
                        $dir_vids = APP . 'webroot' . DS . 'uploads/PunjabiMakers/';
                        
                        $BASEURL = URL_PATH . "uploads/PunjabiMakers/";
                        
                        $result = $this->PunjabiMakers->getYTPunjabiMakers($BASEURL, $dir_vids, $video_id);
                      
                        if($result['status'] == 1 && $result['msg'] == 'success') {
                            $external = $this->request->data['PunjabiMakers']["modified_date"];
                            $format = "d/m/Y";
                            $dateobj = DateTime::createFromFormat($format, $external);
                            $iso_datetime = $dateobj->format(Datetime::ATOM);
                            $time = strtotime($iso_datetime);
                            $this->request->data['PunjabiMakers']['url'] = (string)$result['video'];
                            $this->request->data['PunjabiMakers']['title'] = (string)$result['title'];
                            $this->PunjabiMakers->create();
                            $this->request->data['PunjabiMakers']['created_date'] = (int)$time;
                            $this->request->data['PunjabiMakers']['modified_date'] = (int)$time;
                            $this->request->data['PunjabiMakers']['status'] = (int)1;
                            if ($this->PunjabiMakers->save($this->request->data)) {
                                
                                $this->Session->setFlash(__('The PunjabiMakers has been saved'), 'swift_success');
                                return $this->redirect(array('action' => 'index'));
                                
                            } else {
                                
                                $this->Session->setFlash(__('The PunjabiMakers could not be saved. Please, try again.'), 'swift_failure');
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
            
            $PunjabiMakers = $this->PunjabiMakers->findById($id);
          
            if (!$this->PunjabiMakers->exists($id)) {
                throw new NotFoundException(__('Invalid post'));
            }
            
            $options = array('conditions' => array('PunjabiMakers.' . $this->PunjabiMakers->primaryKey => $id));
            $this->request->data = $this->PunjabiMakers->find('first', $options);
            
            $this->request->data['PunjabiMakers']['modified_date'] = date("d/m/Y", $this->request->data['PunjabiMakers']['modified_date']);
            $this->request->data['PunjabiMakers']['tags_id'] = explode(",", $this->request->data['PunjabiMakers']['tags_id']);
            $tags = $this->PunjabiTags->find('list');
            $this->set('tags', $tags);
            
            $this->set('id', $this->request->data['PunjabiMakers']['id']);
            $this->set(array(
                '_serialize' => array('PunjabiMakers')
            ));
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->PunjabiMakers->id = $id;

        if ($this->request->is('post') || $this->request->is('put')) {
            
            $this->request->data['PunjabiMakers']['id'] = (int)$id;
            $tags_id = $this->request->data['PunjabiMakers']['tags_id'];
            
            $checktags = $this->PunjabiTags->find('list', array('conditions' => array('PunjabiTags.id' => $tags_id)));
            
            if(!empty($checktags)) {
                
                $this->request->data['PunjabiMakers']['tags'] = implode(",", $checktags);
                $external = $this->request->data['PunjabiMakers']["modified_date"];
                
                $format = "d/m/Y";
                $dateobj = DateTime::createFromFormat($format, $external);
                $iso_datetime = $dateobj->format(Datetime::ATOM);
                $timestamp = strtotime($iso_datetime);
                
                $this->request->data['PunjabiMakers']['modified_date'] = (int)$timestamp;
                $this->request->data['PunjabiMakers']['views'] = (int)$this->request->data['PunjabiMakers']['views'];
                $this->request->data['PunjabiMakers']['downloads'] = (int)$this->request->data['PunjabiMakers']['downloads'];

                $cat_name = "";
                $this->PunjabiMakers->create();
                $dir_gallery = APP . 'webroot' . DS . 'uploads/PunjabiMakers/';
                if (isset($this->request->data['PunjabiMakers']['url']) && $this->request->data['PunjabiMakers']['url'] != '') {
                    $path = URL_PATH . "uploads/PunjabiMakers/";
                    $file_temp = $this->request->data['PunjabiMakers']['url'];
                    $title = trim($this->request->data['PunjabiMakers']['title']);
                    
                    $vid_res = $this->PunjabiMakers->VideoUpload2($dir_gallery, $file_temp, $title);
                  
                    $zip_name = $dir_gallery.$title.'.zip';
                    exec("find '$zip_name' -type d -exec chmod 0777 {} +");
                    chmod($zip_name, 0777);
                    
                    $this->request->data['PunjabiMakers']['url'] = $path.str_replace('/Library/WebServer/Documents/mvs/app/webroot/uploads/PunjabiMakers/', '', $vid_res['video']);
                    $this->request->data['PunjabiMakers']['image'] = $path.str_replace('/Library/WebServer/Documents/mvs/app/webroot/uploads/PunjabiMakers/', '', $vid_res['thumb']);
                    $this->request->data['PunjabiMakers']['zip'] = $path.$title.'.zip';
                    
                    $url = $this->request->data['PunjabiMakers']['url'];
                    $checkvideo = $this->PunjabiMakers->find('first', array('conditions' => array('OR' => array(array('PunjabiMakers.url' => $url),array('PunjabiMakers.url' => str_replace(" ", "%20", $url))), 'AND' => array(array('PunjabiMakers.id !=' => $id)))));
                  
                    if (!empty($checkvideo)) {
                        $this->Session->setFlash(__('This Video already exist.'), 'swift_failure');
                        return $this->redirect(array('action' => 'index'));
                    }
                }
                if ($this->PunjabiMakers->save($this->request->data)) {
                    $this->Session->setFlash(__('The PunjabiMakers has been saved'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The PunjabiMakers could not be saved. Please, try again.'), 'swift_failure');
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
        
        $this->PunjabiMakers->id = $id;
        
        $PunjabiMakers = $this->PunjabiMakers->find('first',array('conditions' => array('PunjabiMakers.id' => $id)));
                    
        $mp4 = str_replace(URL_PATH.'uploads/PunjabiMakers/', '', $PunjabiMakers['PunjabiMakers']['url']);
        $thumbs = str_replace(URL_PATH.'uploads/PunjabiMakers/', '', $PunjabiMakers['PunjabiMakers']['image']);
        $zip    = str_replace(URL_PATH.'uploads/PunjabiMakers/', '', $PunjabiMakers['PunjabiMakers']['zip']);
        
        $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiMakers/';
                    
        $video = $dir_cvr.$mp4;
        $videoimg = $dir_cvr.$mp4.'.jpg';
        $images = $dir_cvr.$thumbs;
        $videozip = $dir_cvr.$zip;
        
        if ($this->PunjabiMakers->delete($this->PunjabiMakers->id)) {
            
            unlink($video);
            unlink($videoimg);
            unlink($images);
            unlink($videozip);
            
            $this->Session->setFlash(__("PunjabiMakers has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The PunjabiMakers with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $PunjabiMakers = $this->PunjabiMakers->find('first',array('conditions' => array('PunjabiMakers.id' => $value)));
                   
                    $mp4    = str_replace(URL_PATH.'uploads/PunjabiMakers/', '', $PunjabiMakers['PunjabiMakers']['url']);
                    $thumbs = str_replace(URL_PATH.'uploads/PunjabiMakers/', '', $PunjabiMakers['PunjabiMakers']['image']);
                    $zip    = str_replace(URL_PATH.'uploads/PunjabiMakers/', '', $PunjabiMakers['PunjabiMakers']['zip']);
                    
                    $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiMakers/';
                    
                    $video = $dir_cvr.$mp4;
                    $videoimg = $dir_cvr.$mp4.'.jpg';
                    $images = $dir_cvr.$thumbs;
                    $videozip = $dir_cvr.$zip;
                  
                    unlink($video);
                    unlink($videoimg);
                    unlink($images);
                    unlink($videozip);
                    
                    $this->PunjabiMakers->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    function delete_image() {
        $id = $this->request->data['id'];
        $PunjabiMakers = $this->PunjabiMakers->find('first',array('conditions' => array('PunjabiMakers.id' => $id)));
        $mp4 = str_replace(URL_PATH.'uploads/PunjabiMakers/', '', $PunjabiMakers['PunjabiMakers']['url']);
        $zip = str_replace(URL_PATH.'uploads/PunjabiMakers/', '', $PunjabiMakers['PunjabiMakers']['zip']);
        $dir_cvr = APP . 'webroot' . DS . 'uploads/PunjabiMakers/';
        $video = $dir_cvr.$mp4;
        $videoimg = $dir_cvr.$mp4.'.jpg';
        $videozip = $dir_cvr.$zip;
       
        $this->request->data['PunjabiMakers']['id']=$id;
        $this->request->data['PunjabiMakers']['url'] = '';
        if($this->PunjabiMakers->save($this->request->data)) {
            unlink($video);
            unlink($videoimg);
            unlink($videozip);
        }
        exit; 
   }
    
    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['PunjabiMakers']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);
        
        if (!$this->PunjabiMakers->exists($id)) {
            throw new NotFoundException(__('Invalid PunjabiMakers'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {   
            
            $this->request->data['PunjabiMakers']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->PunjabiMakers->save($this->request->data)) {                
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
