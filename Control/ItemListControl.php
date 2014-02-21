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
        global $loggedIn;
        global $admin;

        if ($loggedIn && $admin) {
            if (isset($_POST['categoryName'])) {
                $categoryName = sanitizeString($_POST['categoryName']);
                $this->addCategory($categoryName);
            }
            if (isset($_POST['deleteCategory'])) {
                $delete = (int)sanitizeString($_POST['categoryDelete']);
                $category = CategoryDAO::selectById($delete);
                CategoryDAO::delete($category);
            }
            if (isset($_POST['DeleteItem'])) {
                $itemDeleteId = (int)sanitizeString($_POST['itemId']);
                $item = ItemDAO::selectById($itemDeleteId);
                ItemDAO::delete($item);
            }
        } else {
            $this->model->error = "You're not logged in.";
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
