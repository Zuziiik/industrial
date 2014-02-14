<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemIconDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/CategoryDAO.php';

class ItemListControl extends Control {

    private $items;
    private $categories;

    function __construct($model) {
        parent::__construct($model);
        $this->items = array();
    }

    public function initialize() {
        global $loggedin;
        global $admin;

        if ($loggedin) {
            if (isset($_POST['categoryName'])) {
                $categoryName = sanitizeString($_POST['categoryName']);
                $this->addCategory($categoryName);
            }
            if(isset($_POST['deleteCategory'])){
                $delete=$_POST['categoryDelete'];
                $category = CategoryDAO::selectByName($delete);
                CategoryDAO::delete($category);
            }
            
        } else {
            header("Location: ./index.php?page=login");
        }
        $this->loadCategories();
        $n = count($this->categories);
        for ($i = 0; $i < $n; $i++) {
            $categoryId = $this->categories[$i]->getIdCategory();
            $name = $this->categories[$i]->getName();
            $items = ItemDAO::selectByCategoryId($categoryId);
            $this->model->categories[$i] = array(new Category($categoryId, $name), $items);
        }
    }

    private function addCategory($categoryName) {
        if (!CategoryDAO::exists($categoryName)) {
            CategoryDAO::insert(new Category(666, $categoryName));
        } else {
            $this->model->error = "Category already exists";
        }
    }

    private function loadCategories() {

        $this->categories = CategoryDAO::selectAll();
    }

}
