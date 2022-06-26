<?php
App::uses('AppModel', 'Model');

class Notifications extends AppModel {
    
    public $name        = 'Notifications';
    public $useTable    = 'notifications';
    public $primaryKey  = 'id';
    public $displayField = 'template_id';
    
    public $belongsTo = array(
        'Templates' => array(
            'className' => 'Templates',
            'foreignKey' => 'template_id'
        ),
        'Accounts' => array(
            'className' => 'Accounts',
            'foreignKey' => 'account_id'
        ),
        'Applications' => array(
            'className' => 'Applications',
            'foreignKey' => 'app_id',
        )
    );
}
