<?php

App::uses('AppModel', 'Model');

class GodTextCategories2 extends AppModel 
{
    public $name = 'GodTextCategories2';
    public $useTable = 'god_text_categories2';
    public $primaryKey  = 'id';
    public $displayField = 'cat_name';
}