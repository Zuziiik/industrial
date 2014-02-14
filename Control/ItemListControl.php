<?php

include_once 'Control.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemIconDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/CategoryDAO.php';

class ItemListControl extends Control {
    
    private $items;
    private $categories;

    function __construct($model) {
        parent::__construct($model);
        $this->items=array();
    }

    public function initialize() {
        
        $this->loadCategories();
        $n= count($this->categories);
        for($i=0;$i<$n;$i++){
            
            $categoryId = $this->categories[$i]->getIdCategory();
            $name = $this->categories[$i]->getName();
            $items=  ItemDAO::selectByCategoryId($categoryId);
            $this->model->categories[$i]=array(new Category($categoryId, $name),$items);
        }
    }
    
    
    private function loadCategories() {
        
        $this->categories = CategoryDAO::selectAll();
    }

}
