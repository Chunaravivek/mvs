<?php

App::uses('AppModel', 'Model');

class GodTagTypes extends AppModel 
{
    public $name = 'GodTagTypes';
    public $useTable = 'god_tag_types';
    public $primaryKey  = 'id';
    public $displayField = 'name';
    
    public $belongsTo = array(
        'DesignTypes' => array(
            'className' => 'DesignTypes',
            'foreignKey' => 'design_type'
        ),
    );
}