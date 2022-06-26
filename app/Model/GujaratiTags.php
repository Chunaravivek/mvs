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
class GujaratiTags extends AppModel {
    
    public $name        = 'GujaratiTags';
    public $useTable    = 'gujarati_tags';
    public $primaryKey  = 'id';
    public $displayField = 'name';
    
//    public $belongsTo = array(
//        'GujaratiTagTypes' => array(
//            'className' => 'GujaratiTagTypes',
//            'foreignKey' => 'tag_type'
//        ),
//    );
}
