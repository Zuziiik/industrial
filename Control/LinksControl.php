<?php

include_once 'Control.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class LinksControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		if(isset($_POST['delete'])) {
			$this->delete();
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