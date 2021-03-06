<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class ItemControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		$this->model->fail = FALSE;
		if(isset($_GET['item'])) {
			$id = (int)sanitizeString($_GET['item']);
			if(ItemDAO::exists($id)) {
				$this->exists($id);
			} else {
				header('Location: ./index.php?page=404');
			}
		}
	}

	private function exists($id) {
		global $loggedIn;
		global $admin;

		if(isset($_POST['action']) && $_POST['action'] == 'delete') {
			if($loggedIn && $admin) {
				$this->delete();
			} else {
				$this->model->fail = TRUE;
				$this->model->error = "<span class='text-danger'>You don`t have permissions to do this.</span>";
			}
		}
		if(isset($_POST['action']) && $_POST['action'] == 'deleteRecipe') {
			if($loggedIn && $admin) {
				$this->deleteRecipe();
			} else {
				$this->model->fail = TRUE;
				$this->model->error = "<span class='text-danger'>You don`t have permissions to do this.</span>";
			}
		}
		if(isset($_POST['action']) && $_POST['action'] == 'moveUp') {

			if($loggedIn && $admin) {
				$this->move($id, "up");
			} else {
				$this->model->fail = TRUE;
				$this->model->error = "<span class='text-danger'>You don`t have permissions to do this.</span>";
			}
		}
		if(isset($_POST['action']) && $_POST['action'] == 'moveDown') {
			if($loggedIn && $admin) {
				$this->move($id, "down");
			} else {
				$this->model->fail = TRUE;
				$this->model->error = "<span class='text-danger'>You don`t have permissions to do this.</span>";
			}
		}
		$this->model->item = ItemDAO::selectById($id);
		$this->model->editArea = EditableAreaDAO::selectByTargetId($id);
	}

	private function delete() {
		if(isset($_POST['areaId'])) {
			$areaId = (int)sanitizeString($_POST['areaId']);
			$area = EditableAreaDAO::selectById($areaId);
			EditableAreaDAO::delete($area);
		}
	}

	private function deleteRecipe() {
		if(isset($_POST['id'])) {
			$recipeId = (int)sanitizeString($_POST['id']);
			RecipeItemDAO::delete($recipeId);
			$recipe = RecipeDAO::selectById($recipeId);
			RecipeDAO::delete($recipe);
		}
	}

	private function move($itemId, $dir) {
		if(isset($_POST['areaId'])) {
			$areaId = (int)sanitizeString($_POST['areaId']);
			$areas = EditableAreaDAO::selectByTargetId($itemId);
			$area = EditableAreaDAO::selectById($areaId);
			$weight = $area->getWeight();
			$pos = $this->getPosition($areas, $areaId);
			$n = count($areas);
			if($dir === "up" && $pos > 0) {
				$temp = $areas[$pos - 1]->getWeight();
				$areas[$pos - 1]->setWeight($weight);
				$areas[$pos]->setWeight($temp);
				EditableAreaDAO::update($areas[$pos - 1]);
				EditableAreaDAO::update($areas[$pos]);
			}
			if($dir === "down" && $pos < $n - 1) {
				$temp = $areas[$pos + 1]->getWeight();
				$areas[$pos + 1]->setWeight($weight);
				$areas[$pos]->setWeight($temp);
				EditableAreaDAO::update($areas[$pos + 1]);
				EditableAreaDAO::update($areas[$pos]);
			}
		}
	}

	private function getPosition($areas, $areaId) {
		$i = 0;
        var_dump($areaId);
		foreach ($areas as $a) {
			if((int)$a->getIdEditableArea() == $areaId) {
                var_dump((int)$a->getIdEditableArea());
				break;
			}
            var_dump($i);
			$i++;
		}
		return $i;
	}

}
