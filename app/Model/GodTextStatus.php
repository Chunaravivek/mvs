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
class GodTextStatus extends AppModel {
    
    public $name        = 'GodTextStatus';
    public $useTable    = 'god_text_status';
    public $primaryKey  = 'id';
    public $displayField = 'cat_name';
    
    public $belongsTo = array(
        'GodTags' => array(
            'className' => 'GodTags',
            'foreignKey' => 'tag_id'
        ),
    );
}
