<?php

include_once 'Control.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class LinksControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		global $admin;
		global $loggedIn;
		$this->model->fail = FALSE;
		if(isset($_POST['delete'])) {
			if($admin && $loggedIn) {
				$this->delete();
			} else {
				$this->model->fail = TRUE;
				$this->model->error = "<span class='text-danger'>You're not logged in or you don`t have permissions to do this.</span>";
			}

		}
		$this->model->links = EditableAreaDAO::selectByEditableAreaType(EditableArea::LINK);
		$this->model->resourcePacks = EditableAreaDAO::selectByEditableAreaType(EditableArea::RESOURCE_PACK);
	}

	private function delete() {
		$id = (int)sanitizeString($_POST['LinkId']);
		$link = EditableAreaDAO::selectById($id);
		EditableAreaDAO::delete($link);
	}

}