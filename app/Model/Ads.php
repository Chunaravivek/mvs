<?php

App::uses('AppModel', 'Model');

class Ads extends AppModel 
{
    public $name = 'Ads';
    public $useTable = 'ads';
    public $primaryKey  = 'id';
    public $displayField = 'app_name';
    
    public $belongsTo = array(
        'Accounts' => array(
            'className' => 'Accounts',
            'foreignKey' => 'acc_id'
        ),
        'Applications' => array(
            'className' => 'Applications',
            'foreignKey' => 'app_code'
        ),
    );
}