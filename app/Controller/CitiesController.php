<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP CitiesController
 * @author s4
 */
class CitiesController extends AppController {

    public $uses = array('Cities');

    public function index() {
        $description = 'Manage Cities';
        $keywords = 'Manage Cities';
        $this->set(compact('keywords', 'description'));
    }

    function records() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */

        $aColumns = array('', 'id', 'name', 'type_id','status', 'created_date', 'modified_date');
        $search = array('name', 'type_id');
        /*
         * Paging
         */
        $sLimit = "";
        $offset = "";
        if (isset($this->request->query['iDisplayStart']) && $this->request->query['iDisplayLength'] != '-1') {
            $sLimit = " " . intval($this->request->query['iDisplayStart']) . ", " .
                    intval($this->request->query['iDisplayLength']);

            $paggin = explode(',', $sLimit);
            $offset = $paggin[0];
            $sLimit = $paggin[1];
        }


        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($this->request->query['iSortCol_0'])) {

            $sOrder = " ";
            for ($i = 0; $i < intval($this->request->query['iSortingCols']); $i++) {
                if ($this->request->query['bSortable_' . intval($this->request->query['iSortCol_' . $i])] == "true") {
                    $sOrder .= "Cities." . $aColumns[intval($this->request->query['iSortCol_' . $i])] . " " .
                            ($this->request->query['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
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

        if (isset($this->request->query['cities']) && $this->request->query['cities'] != NULL) {

            $cities = $this->request->query['cities'];
            $sWhere .= "AND Cities.type_id = '" . $cities . "' ";
        }

        if (isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "") {

            $sWhere .= " AND ";
            for ($i = 0; $i < count($search); $i++) {

                $sWhere .= " Cities." . $search[$i] . " LIKE '%" . $this->request->query['sSearch'] . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($search); $i++) {
            if (isset($this->request->query['bSearchable_' . $i]) && $this->request->query['bSearchable_' . $i] == "true" && $this->request->query['sSearch_' . $i] != '') {

                if ($sWhere == "") {
                    $sWhere = " 1=1 ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere = " Cities." . $search[$i] . " LIKE '%" . $this->request->query['sSearch_' . $i] . "%' ";
            }
        }


        // echo "<pre>"; print_r($this->request->query); exit;

        $keys = $this->Cities->find('all', array('conditions' => $sWhere, 'order' => $sOrder, 'offset' => $offset, 'limit' => $sLimit));

        $iTotal = $this->Cities->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Cities->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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
            
            
            $output['aaData'][]['Cities'] = array(
                'id' => $key['Cities']['id'],
                'name' => $key['Cities']['name'],
                'type_id' => $key['Cities']['type_id'],
                'status' => $key['Cities']['status'],
                'created_date' => date('d/m/Y', $key['Cities']['created_date']),
                'modified_date' => date('d/m/Y h:i:s A', $key['Cities']['modified_date']),
            );
        }

        echo json_encode($output);
        exit;
    }

    public function edit($id = null) {

        $id = $this->request->data('id');
        $Cities = $this->Cities->findById($id);

        if (!$this->Cities->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }

        $options = array('conditions' => array('Cities.' . $this->Cities->primaryKey => $id));
        $this->request->data = $this->Cities->find('first', $options);


        $this->set('id', $this->request->data['Cities']['id']);
        $this->set(array(
            '_serialize' => array('Cities')
        ));
    }

    public function add() {

        if ($this->request->is('post')) {

            $this->request->data['Cities']['created_date'] = time();
            $this->request->data['Cities']['modified_date'] = time();
            $this->request->data['Cities']['status'] = 1;
            $this->request->data['Cities']['name'] = trim($this->request->data['Cities']['name']);

            if ($this->Cities->save($this->request->data)) {
                $this->Session->setFlash(__('The Cities has been saved'), 'swift_success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Cities could not be saved. Please, try again.'), 'swift_failure');
            }
        }
    }
    
    public function save($id = NULL) {
        
        $id = $this->request->params['pass'][0];
        $this->Cities->id = $id;

        if ($this->Cities->exists($this->Cities->id)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['Cities']['modified_date'] = time();
             
           
                if ($this->Cities->save($this->request->data)) {
                    $this->Session->setFlash(__('Cities has been Updated successfully'), 'swift_success');
                    return $this->redirect(array('action' => 'index'));
                }   else {
                    $this->Session->setFlash(__("Unable to Add Cities"), 'swift_failure');
                    return $this->redirect(array('action' => 'add'));
                }
            }
        }
    }

    public function delete($id) {
        
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Cities->id = $id;
        
        if ($this->Cities->delete($this->Cities->id)) {
            $this->Session->setFlash(__("Cities has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Cities with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function deleteAll() {
        if($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);
            
            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->Cities->delete($value,true);
                }    
            }
        }
        exit;
    }
    
    public function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Cities']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);

        if (!$this->Cities->exists($id)) {
            throw new NotFoundException(__('Invalid Cities'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Cities']['id'] = $id;
            if ($this->Cities->save($this->request->data)) {
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }

}
