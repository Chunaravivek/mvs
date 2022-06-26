<?php
App::uses('AppModel', 'Model');

class Users extends AppModel 
{
    public $name = 'Users';
    public $useTable = 'users';
    public $primaryKey  = 'id';
}