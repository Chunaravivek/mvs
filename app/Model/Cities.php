<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Category
 * @author s4ittech
 */
class Cities extends AppModel {
    public $name        = 'Cities';
    public $useTable    = 'cities';
    public $primaryKey  = 'id';
    public $displayfield  = 'name';
}
