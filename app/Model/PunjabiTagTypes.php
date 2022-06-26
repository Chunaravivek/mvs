<?php

App::uses('AppModel', 'Model');

class PunjabiTagTypes extends AppModel 
{
    public $name = 'PunjabiTagTypes';
    public $useTable = 'punjabi_tag_types';
    public $primaryKey  = 'id';
    public $displayField = 'name';
    
    public $belongsTo = array(
        'DesignTypes' => array(
            'className' => 'DesignTypes',
            'foreignKey' => 'design_type'
        ),
    );
}