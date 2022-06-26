<?php
App::uses('AppModel', 'Model');

class Settings extends AppModel 
{
    public $name = 'Settings';
    public $useTable = 'settings';
    public $primaryKey  = 'id';
}