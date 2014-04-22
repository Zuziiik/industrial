<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class ServerFormControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		global $loggedIn;
		global $admin;
		$this->model->edit = FALSE;
		$this->model->add = FALSE;
		if($loggedIn && $admin) {
			if(isset($_POST['action']) && $_POST['action'] == 'addServer') {

				$this->model->add = TRUE;
				$this->add();
			}
			if(isset($_POST['action']) && $_POST['action'] == 'editServer') {
				$this->model->edit = TRUE;
				$serverId = (int)sanitizeString($_POST['ServerId']);
				$this->model->server = EditableAreaDAO::selectById($serverId);
				$this->edit($this->model->server);
			}
		} else {
			$this->model->error = "<span class='text-danger'>You are not logged in or you must be admin to add/edit.</span>";
		}
	}

	private function add() {
		if(isset($_POST['save'])) {
			$type = EditableArea::SERVER;
			$title = sanitizeString($_POST['title']);
			$message = sanitizeTextArea($_POST['message']);
			$date = date("Y-m-d H:i:s", time());
			$server = new EditableArea(666, NULL, $type, $date, $title, $message, NULL);
			EditableAreaDAO::insert($server);
			$this->model->add = FALSE;
			echo("<script>window.location = './index.php?page=servers';</script>");

		}
	}

	private function edit($server) {
		if(isset($_POST['save'])) {
			$title = sanitizeString($_POST['title']);
			$message = sanitizeTextArea($_POST['message']);
			$date = date("Y-m-d H:i:s", time());
			$server->setTitle($title);
			$server->setMessage($message);
			$server->setDate($date);
			EditableAreaDAO::update($server);
			$this->model->edit = FALSE;
			echo("<script>window.location = './index.php?page=servers';</script>");
		}
	}

}