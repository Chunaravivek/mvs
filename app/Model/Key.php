<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Category
 * @author s4ittech
 */
class Key extends AppModel {
    
    public $name        = 'Key';
    public $useTable    = 'keys';
    public $primaryKey  = 'id';
    public $displayField = 'app_code';
}
