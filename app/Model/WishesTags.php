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
class WishesTags extends AppModel {
    
    public $name        = 'WishesTags';
    public $useTable    = 'wishes_tags';
    public $primaryKey  = 'id';
    public $displayField = 'name';
    
//    public $belongsTo = array(
//        'HindiTagTypes' => array(
//            'className' => 'HindiTagTypes',
//            'foreignKey' => 'tag_type'
//        ),
//    );
}
