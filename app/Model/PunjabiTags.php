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
class PunjabiTags extends AppModel {
    
    public $name        = 'PunjabiTags';
    public $useTable    = 'punjabi_tags';
    public $primaryKey  = 'id';
    public $displayField = 'name';
    
//    public $belongsTo = array(
//        'PunjabiTagTypes' => array(
//            'className' => 'PunjabiTagTypes',
//            'foreignKey' => 'tag_type'
//        ),
//    );
}
