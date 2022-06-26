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
class TemplateTypes extends AppModel {
    
    public $name        = 'TemplateTypes';
    public $useTable    = 'template_types';
    public $primaryKey  = 'id';
    public $displayField = 'type';
}
