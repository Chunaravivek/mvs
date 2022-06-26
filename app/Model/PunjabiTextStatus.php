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
class PunjabiTextStatus extends AppModel {
    
    public $name        = 'PunjabiTextStatus';
    public $useTable    = 'punjabi_text_status';
    public $primaryKey  = 'id';
    public $displayField = 'cat_name';
    
    public $belongsTo = array(
        'PunjabiTags' => array(
            'className' => 'PunjabiTags',
            'foreignKey' => 'tag_id'
        ),
    );
}
