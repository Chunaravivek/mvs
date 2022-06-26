<?php

App::uses('AppModel', 'Model');

class DesignTypes extends AppModel 
{
    public $name = 'DesignTypes';
    public $useTable = 'design_types';
    public $primaryKey  = 'id';
    public $displayField = 'name';
}