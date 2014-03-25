<?php

include_once 'View.php';

class LinksFormView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		if($this->model->type == EditableArea::LINK) {
			$type = 'Link';
		} else {
			$type = 'Resource Pack';
		}

		if($this->model->add) {
			echo("Add " . $type);
		} else {
			echo("Edit " . $type);
		}
	}

	public function printBody() {
		global $admin;
		global $loggedIn;
		if($admin && $loggedIn) {
			if($this->model->add) {
				$this->add();
			} else {
				$this->edit();
			}
		} else {
			echo($this->model->error);
		}
	}

	public function printPageHeader() {
		if($this->model->type == EditableArea::LINK) {
			$type = 'Link';
		} else {
			$type = 'Resource Pack';
		}

		if($this->model->add) {
			echo("Add " . $type);
		} else {
			echo("Edit " . $type);
		}
	}

	private function add() {
		if($this->model->type == EditableArea::LINK) {
			?>
			<form id='addLink' name='addLink' method='post' action='./index.php?page=linksForm'>
				<input type='hidden' name='action' value='addLink'/>
				<input type='text' name='title' id="linkTitle" placeholder="title"/>
				<input type='text' name='message' id="linkMessage" placeholder="link"/>
				<input class='save' type='submit' name='save' value='Save'/>
			</form>
		<?php
		} else {
			?>
			<form id='addResourcePack' name='addResourcePack' method='post' action='./index.php?page=linksForm'>
				<input type='hidden' name='action' value='addResourcePack'/>
				<input type='text' name='title' id="linkTitle" placeholder="title"/>
				<input type='text' name='message' id="linkMessage" placeholder="link"/>
				<input class='save' type='submit' name='save' value='Save'/>
			</form>
		<?php
		}
	}

	private function edit() {
		$id = (int)$this->model->link->getIdEditableArea();
		$title = $this->model->link->getTitle();
		$message = $this->model->link->getMessage();
		if($this->model->type == EditableArea::LINK) {
			?>
			<form id='editLink' name='addLink' method='post' action='./index.php?page=linksForm'>
				<input type='hidden' name='action' value='editLink'/>
				<input type='hidden' name='LinkId' value='<?php echo $id; ?>'/>
				<input type='text' name='title' id="linkTitle" value='<?php echo $title; ?>'/>
				<input type='text' name='message' id="linkMessage" value='<?php echo $message; ?>'/>
				<input class='save' type='submit' name='save' value='Save'/>
			</form>
		<?php
		} else {
			?>
			<form id='editResourcePack' name='addResourcePack' method='post' action='./index.php?page=linksForm'>
				<input type='hidden' name='action' value='editResourcePack'/>
				<input type='hidden' name='LinkId' value='<?php echo $id; ?>'/>
				<input type='text' name='title' id="linkTitle" value='<?php echo $title; ?>'/>
				<input type='text' name='message' id="linkMessage" value='<?php echo $message; ?>'/>
				<input class='save' type='submit' name='save' value='Save'/>
			</form>
		<?php
		}
	}

}