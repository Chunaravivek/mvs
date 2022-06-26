<?php
App::uses('AppModel', 'Model');

class Templates extends AppModel {

    public $name        = 'Templates';
    public $useTable    = 'templates';
    public $primaryKey  = 'id';
    public $displayField = 'title';
    public $belongsTo = array(
        'Uidesign' => array(
            'className' => 'Uidesign',
            'foreignKey' => 'type'
        ),
        'TemplateTypes' => array(
            'className' => 'TemplateTypes',
            'foreignKey' => 'template_type',
        ),
        'Accounts' => array(
            'className' => 'Accounts',
            'foreignKey' => 'account_id',
        ),
        'Applications' => array(
            'className' => 'Applications',
            'foreignKey' => 'app_code',
        ),
    );
}
