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
class Ipwiseads extends AppModel {
    public $name        = 'IPADS';
    public $useTable    = 'ipwise_adid';
    public $primaryKey  = 'id';
    
    public $belongsTo = array(
        'Accounts' => array(
            'className' => 'Accounts',
            'foreignKey' => 'acc_id'
        ),
        'Applications' => array(
            'className' => 'Applications',
            'foreignKey' => 'app_code'
        ),
    );
}

