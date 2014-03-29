<?php

include_once 'Control.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class LinksFormControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		global $admin;
		global $loggedIn;
		$this->model->add = FALSE;
		$this->model->edit = FALSE;
		$this->model->error = '';
		if($admin && $loggedIn) {
			if(isset($_POST['action']) && $_POST['action'] == 'addResourcePack') {
				$this->model->add = TRUE;
				$this->model->type = EditableArea::RESOURCE_PACK;
				$this->add();
			}
			if(isset($_POST['action']) && $_POST['action'] == 'addLink') {
				$this->model->add = TRUE;
				$this->model->type = EditableArea::LINK;
				$this->add();
			}
			if(isset($_POST['action']) && $_POST['action'] == 'editResourcePack') {
				$this->model->edit = TRUE;
				$this->model->type = EditableArea::RESOURCE_PACK;
				$id = (int)sanitizeString($_POST['LinkId']);
				$this->model->link = EditableAreaDAO::selectById($id);
				$this->edit();
			}
			if(isset($_POST['action']) && $_POST['action'] == 'editLink') {
				$this->model->edit = TRUE;
				$this->model->type = EditableArea::LINK;
				$id = (int)sanitizeString($_POST['LinkId']);
				$this->model->link = EditableAreaDAO::selectById($id);
				$this->edit();
			}
		} else {
			$this->model->error = "<span class='error'>You are not logged in or you must be admin to add/edit.</span>";
		}

	}

	private function add() {
		if(isset($_POST['save'])) {
			$title = sanitizeString($_POST['title']);
			$message = sanitizeString($_POST['message']);
			$message = "http://" . $message;
			$date = date("Y-m-d H:i:s", time());
			$link = new EditableArea(666, NULL, $this->model->type, $date, $title, $message, NULL);
			EditableAreaDAO::insert($link);
			$this->model->add = FALSE;
			echo("<script>window.location = './index.php?page=links';</script>");
		}
	}

	private function edit() {
		if(isset($_POST['save'])) {
			$title = sanitizeString($_POST['title']);
			$message = sanitizeString($_POST['message']);
			if(strpos($message, "http://")) {
				$message = "http://" . $message;
			}
			$date = date("Y-m-d H:i:s", time());
			$this->model->link->setTitle($title);
			$this->model->link->setMessage($message);
			$this->model->link->setDate($date);
			EditableAreaDAO::update($this->model->link);
			$this->model->edit = FALSE;
			echo("<script>window.location = './index.php?page=links';</script>");
		}
	}

}