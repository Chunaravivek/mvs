<?php

App::uses('AppModel', 'Model');

class GodTextCategories extends AppModel 
{
    public $name = 'GodTextCategories';
    public $useTable = 'god_text_categories';
    public $primaryKey  = 'id';
    public $displayField = 'cat_name';
}