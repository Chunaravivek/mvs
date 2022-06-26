<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP DashboardController
 * @author s4
 */
class DashboardController extends AppController {
    public $uses = array('Admin', 'Accounts', 'Applications', 'Ads', 'Users', 'PunjabiVideos','GodVideos');
    
    public function index() {
        $description = 'Manage Dashboard';
        $keywords = 'Manage Dashboard';
        $this->set(compact('keywords', 'description'));
    }
    
    public function stats() {
        
        $description = 'Manage Statistics';
        $keywords = 'Manage Statistics';
        $this->set(compact('keywords', 'description'));
        
        $admin = $this->Admin->find('count');
        $this->set('admin_count', $admin);
        
        $apps = $this->Applications->find('count');
        $this->set('apps_count', $apps);
        
        $acc = $this->Accounts->find('count');
        $this->set('acc_count', $acc);
        
        $ads = $this->Ads->find('count');
        $this->set('ads_count', $ads);
        
        $users = $this->Users->find('count');
        $this->set('users_count', $users);
        
        $punjabi_video_count = $this->PunjabiVideos->find('count');
        $this->set('punjabi_video_count', $punjabi_video_count);
        
        $god_video_count = $this->GodVideos->find('count');
        $this->set('god_video_count', $god_video_count);
    }

}
