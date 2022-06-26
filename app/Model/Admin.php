<?php
App::uses('AppModel', 'Model');

class Admin extends AppModel 
{
    public $name = 'Admin';
    public $useTable = 'admin';
    public $primaryKey  = 'id';
}