<?php

App::uses('AppModel', 'Model');

class PunjabiTextCategories extends AppModel 
{
    public $name = 'PunjabiTextCategories';
    public $useTable = 'punjabi_text_categories';
    public $primaryKey  = 'id';
    public $displayField = 'cat_name';
}