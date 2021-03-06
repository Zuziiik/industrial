<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeTemplateDAO.php';

class RecipeFormControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		global $loggedIn;
		global $admin;
		if($admin && $loggedIn) {
			$this->model->add = FALSE;
			$this->model->edit = FALSE;
			if(isset($_POST['action']) && $_POST['action'] == 'addRecipe') {
				$this->model->add = TRUE;
				$templateId = (int)sanitizeString($_POST['templateList']);
				$this->model->template = RecipeTemplateDAO::selectById($templateId);
				$itemId = (int)sanitizeString($_GET['item']);
				$this->model->item = ItemDAO::selectById($itemId);
				$this->add($itemId, $templateId);
			}
			if(isset($_POST['action']) && $_POST['action'] == 'editRecipe') {
				$this->model->edit = TRUE;
				$itemId = (int)sanitizeString($_GET['item']);
				$this->model->item = ItemDAO::selectById($itemId);
				$this->model->recipeId = (int)sanitizeString($_POST['id']);
				$templateId = (int)sanitizeString($_POST['templateId']);
				$this->model->template = RecipeTemplateDAO::selectById($templateId);
				$this->edit($itemId, $templateId);
			}
		} else {
			$this->model->error = "<span class='text-danger'>You are not logged in or you must be admin to add/edit.</span>";
		}

	}

	private function add($itemId, $templateId) {
		if(isset($_POST['save'])) {
			$recipeItems = array();
			foreach ($_POST['recipeItems'] as $recipeItem) {
				array_push($recipeItems, (int)sanitizeString($recipeItem));
			}
			end($recipeItems);
			$index = key($recipeItems);
			$recipeOutputItemId = $recipeItems[$index];
			$recipe = new Recipe(666, $recipeOutputItemId, $templateId);
			$recipeId = RecipeDAO::insert($recipe);
			$positions = $this->model->template->getPositions();
			$positions = explode(' | ', $positions);
			$i = 0;
			$length = count($recipeItems) - 2;
			foreach ($positions as $position) {
				if($position != '' && $i <= $length) {
					$recipeItemId = $recipeItems[$i];
					$recipeItem = new RecipeItem($recipeItemId, $recipeId, $position);
					RecipeItemDAO::insert($recipeItem);
					$i++;
				}
			}
			$this->model->add = FALSE;
			echo("<script>window.location = './index.php?page=item&item=$itemId';</script>");
		}

	}

	private function edit($itemId, $templateId) {
		if(isset($_POST['save'])) {
			$recipeItems = array();
			foreach ($_POST['recipeItems'] as $recipeItem) {
				array_push($recipeItems, (int)sanitizeString($recipeItem));
			}
			$oldRecipe = RecipeDAO::selectById($this->model->recipeId);
			RecipeItemDAO::delete($this->model->recipeId);
			RecipeDAO::delete($oldRecipe);
			end($recipeItems);
			$index = key($recipeItems);
			$recipeOutputItemId = $recipeItems[$index];
			$recipe = new Recipe(666, $recipeOutputItemId, $templateId);
			$recipeId = RecipeDAO::insert($recipe);
			$positions = $this->model->template->getPositions();
			$positions = explode(' | ', $positions);
			$i = 0;
			$length = count($recipeItems) - 2;
			foreach ($positions as $position) {
				if($position != '' && $i <= $length) {
					$recipeItemId = $recipeItems[$i];
					$recipeItem = new RecipeItem($recipeItemId, $recipeId, $position);
					RecipeItemDAO::insert($recipeItem);
					$i++;
				}
			}
			$this->model->edit = FALSE;
			echo("<script>window.location = './index.php?page=item&item=$itemId';</script>");

		}
	}

} 