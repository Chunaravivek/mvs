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
class GujaratiImages extends AppModel {
    
    public $name        = 'GujaratiImages';
    public $useTable    = 'gujarati_images';
    public $primaryKey  = 'id';
    public $displayField = 'title';
}
