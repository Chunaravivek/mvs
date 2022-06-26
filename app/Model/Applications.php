<?php

App::uses('AppModel', 'Model');

class Applications extends AppModel 
{
    public $name = 'Applications';
    public $useTable = 'applications';
    public $primaryKey  = 'id';
    public $displayField = 'name';
    
    public $belongsTo = array(
        'Accounts' => array(
            'className' => 'Accounts',
            'foreignKey' => 'account_id'
        )
    );
}