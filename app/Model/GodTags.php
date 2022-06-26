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
class GodTags extends AppModel {
    
    public $name        = 'GodTags';
    public $useTable    = 'god_tags';
    public $primaryKey  = 'id';
    public $displayField = 'name';
    
//    public $belongsTo = array(
//        'GodTagTypes' => array(
//            'className' => 'GodTagTypes',
//            'foreignKey' => 'tag_type'
//        ),
//    );
}
