<?php
App::uses('AppModel', 'Model');

class Schedules extends AppModel {

    public $name        = 'Schedules';
    public $useTable    = 'schedules';
    public $primaryKey  = 'id';
    public $displayField = 'template';
    
    public $belongsTo = array(
        'Templates' => array(
            'className' => 'Templates',
            'foreignKey' => 'template'
        )
    );
}
