<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP NotFoundsController
 * @author s4
 */
class NotFoundsController extends AppController {

    public function index() {
        $description = 'Not Found 404';
        $keywords = 'Not Found 404';
        $this->set(compact('keywords', 'description'));
        
        $this->layout = 'not404';
    }

}
