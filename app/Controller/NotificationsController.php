<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP NotificationsController
 * @author s4
 */
class NotificationsController extends AppController {

    public $uses = array('Notifications', 'Accounts', 'Uidesign', 'Applications', 'Templates');

    public function index() {
        $description = 'Manage Notifications';
        $keywords = 'Manage Notifications';
        $this->set(compact('keywords', 'description'));

        $account = $this->Accounts->find('list');
        $this->set('accounts', $account);

        $app_list = $this->Applications->find('list');
        $this->set("applications", $app_list);

        $ui = $this->Uidesign->find('list');
        $this->set("uidesigns", $ui);
    }

    public function records() {

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */

        $aColumns = array('', 'id', 'template_id', 'account_id', 'app_id', 'app_code', 'success', 'failure', 'created_date');
        $search = array('', '', '', '', 'success', 'failure');
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
                    $sOrder .= "Notifications." . $aColumns[intval($this->request->query['iSortCol_' . $i])] . " " .
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


        if (isset($this->request->query['sSearch']) && $this->request->query['sSearch'] != "") {

            $sWhere .= " AND ";
            for ($i = 0; $i < count($search); $i++) {

                $sWhere .= " Notifications." . $search[$i] . " LIKE '%" . $this->request->query['sSearch'] . "%' OR ";
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
                $sWhere = " Notifications." . $search[$i] . " LIKE '%" . $this->request->query['sSearch_' . $i] . "%' ";
            }
        }


        // echo "<pre>"; print_r($this->request->query); exit;

        $keys = $this->Notifications->find('all', array('conditions' => $sWhere, 'order' => $sOrder, 'offset' => $offset, 'limit' => $sLimit));

        $iTotal = $this->Notifications->find('count', array('conditions' => $sWhere, 'order' => $sOrder));

        $idisplayrecords = $this->Notifications->find('count', array('conditions' => $sWhere, 'limit' => $sLimit));
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

            if (ctype_digit($key['Notifications']['template_id'])) {

                $template = $this->Templates->find('first', array('conditions' => array('Templates.id' => $notification['Notifications']['template_id'])));
                $template_name = $template['Templates']['title'];
            } else {
                $template_name = $key['Notifications']['template_id'];
            }


            $account_name = $key['Accounts']['name'];
            $app_code = $key['Applications']['app_code'];
            $app_name = $key['Applications']['name'];

            $url = URL_PATH . "Templates/edit/" . $key['Notifications']['template_id'];

            $output['aaData'][]['Notifications'] = array(
                'id' => $key['Notifications']['id'],
                'template' => "<a href='$url'>" . $template_name . "</a>",
                'account' => $account_name,
                'application' => $app_name,
                'app_code' => $app_code,
                'success' => $key['Notifications']['success'],
                'failure' => $key['Notifications']['failure'],
                'created_date' => date('d/m/Y h:i:s A', $key['Notifications']['created_date']),
            );
        }

        header('Content-type: application/json');
        echo json_encode($output);
        exit;
    }

    public function add() {
        if ($this->request->is('post')) {

            ini_set('memory_limit', '256M');
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            header('Content-type: text/plain; charset=utf-8');

            set_time_limit(1200);
            $conn = $this->db();
            $response = array();
            $resp_success = 0;
            $resp_failure = 0;
            $pay_load = array();

            $type = $this->request->data['Notifications']['type'];
            $template_id = $this->request->data['Notifications']['template_id'];

            if ($type == 1) {

                $pay_load['type'] = $this->request->data['Notifications']['type'];
                $this->request->data['Notifications']['template_id'] = $this->request->data['Notifications']['title'];
                $template_id = $this->request->data['Notifications']['title'];
                $pay_load['title'] = $this->request->data['Notifications']['title'];
                $pay_load['msg'] = $this->request->data['Notifications']['msg'];
            } else {

                $template = mysqli_query($conn, "SELECT * FROM `templates` WHERE `id` = $template_id");
                while ($row = $template->fetch_assoc()) {
                    foreach ($row as $key => $value) {
                        $pay_load[$key] = $value;
                    }
                }
            }

            //Selected Apps
            $app_cond = ' ';

            if (isset($this->request->data['Notifications']['app_name']) && !empty($this->request->data['Notifications']['app_name'])) {
                $id_arr = $this->request->data['Notifications']['app_name'];
                $ids = "";
                foreach ($id_arr as $app_id) {
                    $ids .= "'" . $app_id . "',";
                }
                $ids = rtrim($ids, ",");
                $app_cond .= " AND `id` IN($ids)";
            }

            if (isset($pay_load['template_type']) && $pay_load['template_type'] == 1) {

                if (isset($this->request->data['Notifications']['reminder'])) {
                    $app_cond .= "";
                } else {
                    $tmp_appcode = $pay_load['app_code'];
                    $app_cond .= " AND `app_code` != '$tmp_appcode'";
                }
            }

            $usr_cond = ' AND `notifs_status` = 1';
            if (isset($this->request->data['Notifications']['test']) && $this->request->data['Notifications']['test'] != NULL) {

                if (isset($this->request->data['Notifications']['android_ids']) && $this->request->data['Notifications']['android_ids'] != NULL) {

                    //Selected User
                    $android_ids = "'";
                    $android_ids .= $this->request->data['Notifications']['android_ids'];
                    $android_ids = str_replace(",", "','", $android_ids);
                    $android_ids .= "'";
                    $usr_cond .= " AND `android_id` IN($android_ids)";
                }
            }

            $app_qry = "SELECT `app_code`,`firebase_id` FROM `applications` WHERE `firebase_id` != 'undefined' AND `firebase_id` != ''";
            $app_qry = $app_qry . $app_cond;
//            echo $app_qry;
//            exit;
            $app_res = $conn->query($app_qry);
            if ($app_res->num_rows > 0) {

                $usr_update = $conn->query("UPDATE users SET `notifs_status`='1'");
                $apps = array();
                while ($app = $app_res->fetch_assoc()) {
                    array_push($apps, $app);
                }
                foreach ($apps as $application) {

                    $app_code = $application['app_code'];
                    $firebase_id = $application['firebase_id'];

                    $results = $this->send_notification($app_code, $pay_load, $firebase_id, $usr_cond, $conn);

                    $this->notificationLog($results['success'], $results['failure'], $app_code, $template_id, $conn);

                    $resp_success += $results['success'];
                    $resp_failure += $results['failure'];

                    unset($results);
                }
                $this->Session->setFlash(__('Notification sent Success ' . $resp_success . ' Failure ' . $resp_failure), 'swift_success');
                $this->redirect(array('controller' => 'Notifications', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('No App Available'), 'swift_failure');
                $this->redirect(array('controller' => 'Notifications', 'action' => 'index'));
            }

            $users = mysqli_query($conn, "SELECT * FROM `users` $conditions");

            $this->Session->setFlash(__('The Notification has been sent!'), 'swift_success');
            $this->redirect(array('controller' => 'Notifications', 'action' => 'index'));
        }
    }

    function send_notification($app_code, $message, $firebase_id, $usr_cond, $conn) {

        $resp = array();
        $resp['failure'] = 0;
        $resp['success'] = 0;

        $usr_res = $conn->query("SELECT device_token FROM `users` WHERE `app_code` = '$app_code' $usr_cond GROUP BY `device_token`");

        if ($usr_res->num_rows > 0) {
            $log_text = array();
            $id = CakeText::uuid();

            $dir = APP . 'webroot' . DS . 'notifs_log' . DS;
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $limit = 999;
            $loops = ceil($usr_res->num_rows / $limit);
            for ($i = 0; $i < $loops; $i++) {


                $tokens = array();
                $android_ids = array();
                $offset = $i * $limit;
                $user_sql = "SELECT `android_id`,`device_token` FROM `users` WHERE `app_code` = '$app_code' $usr_cond GROUP BY `device_token` LIMIT $offset, $limit";

                $user_res = $conn->query($user_sql);
                while ($row = $user_res->fetch_assoc()) {

                    array_push($tokens, $row['device_token']);
                    array_push($android_ids, $row['android_id']);
                }

                // send notifcation 
                $url = 'https://fcm.googleapis.com/fcm/send';

                $fields = array(
                    'registration_ids' => $tokens,
                    'data' => $message,
                );

                $headers = array(
                    'Authorization: key=' . $firebase_id,
                    'Content-Type: application/json'
                );

                $ch = curl_init();
                if (!$ch)
                    die("Android Failed to connect $err $errstr\n");

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields, true));
                $result = curl_exec($ch);
                $response = explode("\n", $result);
                $responseBody = json_decode($response[count($response) - 1], true);

                $failure_token = array();
                $success_ids = array();

                $l = 0;
                $m = 0;
                $result_count = count($tokens);
                $temp_array = array();
                for ($k = 0; $k < $result_count; $k++) {
                    if (isset($responseBody['results'][$k]['error'])) {

                        $filename = APP . 'webroot' . DS . 'uploads/noty/failed_tokens_' . time() . '.json';

                        $failure_token[$l] = $tokens[$k];
                        $resp['failure'] ++;
                        array_push($temp_array, $tokens[$k]);

                        file_put_contents($filename, json_encode($temp_array, JSON_PRETTY_PRINT));
                        $l++;
                    } else {
                        $success_ids[$m] = $android_ids[$k];
                        $resp['success'] ++;
                        $m++;
                    }
                }

                unset($tokens);
                unset($android_ids);
                unset($failure_token);
                unset($success_ids);
            }
        }
        return $resp;
    }

    public function notificationLog($success, $failure, $app_code, $template_id, $conn) {

        $time = time();
        $app_res = $conn->query("SELECT `account_id`,`id` from `applications` WHERE `app_code` = '$app_code'");
        $app_id = 0;

        if ($app_res->num_rows > 0) {
            $application = $app_res->fetch_assoc();
            $app_id = $application['id'];
            $account_id = $application['account_id'];
        }

        $result = $conn->query("INSERT INTO `notifications`(`success`, `failure`,`account_id`, `app_code`, `app_id`, `template_id`,`created_date`, `status`) VALUES ('$success','$failure','$account_id','$app_code','$app_id','$template_id','$time',1)");
        return $result;
    }

    public function delete($id) {

        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        $this->Notifications->id = $id;

        if ($this->Notifications->delete($this->Notifications->id)) {
            $this->Session->setFlash(__("Notifications has been deleted successfully"), 'swift_success');
        } else {
            $this->Session->setFlash(__("The Notifications with id: %s could not be deleted", h($id)), 'swift_failure');
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAll() {
        if ($this->request->is('post')) {
            $get_ids = explode(',', $this->request->data['id']);

            if (count($get_ids) > 0) {
                foreach ($get_ids as $key => $value) {
                    $this->Notifications->delete($value, true);
                }
            }
        }
        exit;
    }

    function update_status() {
        $id = $this->request->data['id'];
        unset($this->request->data['id']);
        $this->request->data['Notifications']['status'] = $this->request->data['status_val'];
        unset($this->request->data['status_val']);

        if (!$this->Notifications->exists($id)) {
            throw new NotFoundException(__('Invalid Notifications'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['Notifications']['id'] = $id;
//            echo "<pre>";print_r($this->request->data);exit;
            if ($this->Notifications->save($this->request->data)) {
                echo 1;
            } else {
                echo 2;
            }
        }
        exit;
    }

    function get_application() {
        $ac_id = $_REQUEST['ac_id'];

        $data = "";
        if ($ac_id != '') {
            $applications = $this->Applications->find('all', array('conditions' => array('Applications.account_id' => $ac_id)));
            if (count($applications) == 0) {
                echo 'sorry';
                exit;
            }
        } else {
            $applications = $this->Applications->find('all');
        }
        $data .= '<option value=""> -- Select App -- </option>';
        foreach ($applications as $application) {
            $data .= '<option value="' . $application['Applications']['id'] . '">' . $application['Applications']['name'] . '</option>';
        }
        echo $data;
        exit;
    }

    function get_template() {
        $type = $_REQUEST['type'];

        $data = array();
        $templates = $this->Templates->find('all', array('conditions' => array('Templates.type' => $type)));

        $i = 0;
        $data[$i]['id'] = "";
        $data[$i]['title'] = " -- Select Templates -- ";
        foreach ($templates as $template) {
            $i++;
            $data[$i]['id'] = $template['Templates']['id'];
            $data[$i]['title'] = $template['Templates']['title'];
        }
        echo json_encode($data);
        exit;
    }

    public function db() {
        static $conn;
        if ($conn === NULL) {
            // $conn = mysqli_connect("localhost", "root", "s4ittech@123", "mvs");
            $conn = mysqli_connect("localhost", "vsadmin", "za8zKY8FXT8WSsYH", "vsadmin");
            $conn->query("SET NAMES utf8");
        }
        return $conn;
    }

}
