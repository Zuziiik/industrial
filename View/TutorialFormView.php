<?php

class TutorialFormView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		if($this->model->edit) {
			echo("Edit Tutorial");
		} else {
			echo("Add Tutorial");
		}
	}

	public function printNavigation() {
		if($this->model->edit) {
			$title = $this->model->tutorial->getTitle();
			$id = (int)$this->model->tutorial->getIdEditableArea();
			?> <a href='index.php?page=tutorialList'>Tutorials</a> | <a
				href='index.php?page=tutorial&id=<?php echo($id); ?>'><?php echo($title); ?></a> |  Edit <?php echo($title);
		} else {
			?> <a href='index.php?page=tutorialList'>Tutorials</a> |  Add Tutorial<?php
		}
	}

	public function printBody() {
		global $admin;
		global $loggedIn;
		if($admin && $loggedIn) {
			if($this->model->edit) {
				$id = (int)$this->model->tutorial->getIdEditableArea();
				$title = $this->model->tutorial->getTitle();
				$message = $this->model->tutorial->getMessage();

				?>
				<form class='editTutorial' name='edit' method='post'
					  action='./index.php?page=tutorialEdit&id=<?php echo $id; ?>'>
					<input type='hidden' name='action' value='editTutorial'/>
					<input id='title' type='text' placeholder="Title" name='title' autofocus
						   value='<?php echo $title; ?>'/>
					<textarea class='EditForm' name='text' id='tutorialText' rows="50"
							  cols="30"><?php echo $message; ?></textarea>
					<input type='submit' class='save' name='save' value='Save'/>
				</form>

			<?php
			} else {
				?>

				<form id='addTutorial' name='addTutorial' method='post' action='./index.php?page=tutorialEdit'>
					<input type='hidden' name='action' value='addTutorial'/>
					<input id='title' type='text' placeholder="Title" name='title' autofocus/>
					<textarea class='addForm' name='text' id='tutorialText' rows="50" cols="30"></textarea>
					<input type='submit' class='save' name='save' value='Save'/>
				</form>


			<?php
			}
		} else {
			echo($this->model->error);
		}
	}

	public function printPageHeader() {
		if($this->model->edit) {
			echo("Edit Tutorial");
		} else {
			echo("Add Tutorial");
		}
	}

} 