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
				if($items != NULL) {
					$this->model->fail = TRUE;
					$this->model->error = "<span class='error'>Can't delete category with items in it.</span>";
				} else {
					CategoryDAO::delete($category);
				}

			} else {
				$this->model->error = "<span class='error'>You're not logged in, or must be admin to add/edit.</span>";
			}
		}
		if(isset($_POST['DeleteItem'])) {
			if($loggedIn && $admin) {
				$itemDeleteId = (int)sanitizeString($_POST['itemId']);
				$editableAreas = EditableAreaDAO::selectByTargetId($itemDeleteId);
				$item = ItemDAO::selectById($itemDeleteId);
				$itemName = $item->getName();
				foreach ($editableAreas as $editableArea) {
					EditableAreaDAO::delete($editableArea);
				}
				//Delete recipe
				$recipes = RecipeDAO::selectByItemId($itemDeleteId);
				foreach ($recipes as $recipe) {
					$outputId = (int)$recipe->getItemId();
					$recipeId = (int)$recipe->getIdRecipe();
					$item = ItemDAO::selectById($outputId);
					$outputName = $item->getName();
					if($outputName == $itemName) {
						RecipeItemDAO::delete($recipeId);
						$recipe = RecipeDAO::selectById($recipeId);
						RecipeDAO::delete($recipe);
					}
				}
				//Delete Usages
				$recipes = RecipeDAO::selectAll();
				foreach ($recipes as $recipe) {
					$recipesDelete = array();
					$recipeId = (int)$recipe->getIdRecipe();
					$tempRecipeItems = RecipeItemDAO::selectByRecipeId($recipeId);
					foreach ($tempRecipeItems as $recipeItem) {
						$recipeItemId = (int)$recipeItem->getItemId();
						$push = FALSE;
						if($recipeItemId === $itemDeleteId) {
							$push = TRUE;
						}
						if($push) {
							$recipesDelete = $recipe;
						}
					};
					$outputName = $item->getName();
					if($outputName != $itemName) {
						foreach ($recipesDelete as $recipeDelete) {
							$recipeDeleteId = (int)$recipeDelete->getIdRecipe();
							RecipeItemDAO::delete($recipeDeleteId);
							RecipeDAO::delete($recipeDelete);
						}
					}
				}
				//Delete Item
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
			if(isset($_POST['filter'])){
				$display = sanitizeString($_POST['items']);
				switch($display){
					case 'Industrial':
						$items = ItemDAO::selectByCategoryIdAndIndustrial($categoryId, TRUE);
						$this->model->categories[$i] = array(new Category($categoryId, $name), $items);
						break;
					case 'Vanilla':
						$items = ItemDAO::selectByCategoryIdAndIndustrial($categoryId, FALSE);
						$this->model->categories[$i] = array(new Category($categoryId, $name), $items);
						break;
					default:
						$items = ItemDAO::selectByCategoryId($categoryId);
						$this->model->categories[$i] = array(new Category($categoryId, $name), $items);
				}
			}else{
				$items = ItemDAO::selectByCategoryIdAndIndustrial($categoryId, TRUE);
				$this->model->categories[$i] = array(new Category($categoryId, $name), $items);
			}
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
