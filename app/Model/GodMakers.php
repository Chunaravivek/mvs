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
class GodMakers extends AppModel {
    
    public $name        = 'GodMakers';
    public $useTable    = 'god_makers';
    public $primaryKey  = 'id';
    public $displayField = 'title';
}
