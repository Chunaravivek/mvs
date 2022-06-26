<?php

App::uses('AppModel', 'Model');

class PunjabiTextCategories2 extends AppModel 
{
    public $name = 'PunjabiTextCategories2';
    public $useTable = 'punjabi_text_categories2';
    public $primaryKey  = 'id';
    public $displayField = 'cat_name';
}