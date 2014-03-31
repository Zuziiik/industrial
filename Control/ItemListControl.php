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
		$this->model->fail = FALSE;
		if(isset($_POST['categoryName'])) {
			if($loggedIn && $admin) {
				$categoryName = sanitizeString($_POST['categoryName']);
				$this->addCategory($categoryName);
			} else {
				$this->model->error = "<span class='error'>You're not logged in, or must be admin to add/edit.</span>";
			}
		}
		if(isset($_POST['deleteCategory'])) {
			if($loggedIn && $admin) {
				$delete = (int)sanitizeString($_POST['categoryDelete']);
				$category = CategoryDAO::selectById($delete);
				$items = ItemDAO::selectByCategoryId($delete);
				if($items!=NULL){
					$this->model->fail = TRUE;
					$this->model->error = "<span class='error'>Can't delete category with items in it.</span>";
				}else{
					CategoryDAO::delete($category);
				}

			} else {
				$this->model->error = "<span class='error'>You're not logged in, or must be admin to add/edit.</span>";
			}
		}
		if(isset($_POST['DeleteItem'])) {
			if($loggedIn && $admin) {
				$itemDeleteId = (int)sanitizeString($_POST['itemId']);
				$item = ItemDAO::selectById($itemDeleteId);
				ItemDAO::delete($item);
			} else {
				$this->model->error = "<span class='error'>You're not logged in, or must be admin to add/edit.</span>";
			}
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
		if(!CategoryDAO::exists($categoryName)) {
			CategoryDAO::insert(new Category(666, $categoryName));
		} else {
			$this->model->error = "<span class='error'>Category already exists.</span>";
		}
	}

	private function loadCategories() {

		$this->categories = CategoryDAO::selectAll();
	}

}
