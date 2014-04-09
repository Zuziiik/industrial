<?php

include_once 'View.php';

class TutorialView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		$title = $this->model->tutorial->getTitle();
		echo("Industrial Craft Experimental - Wiki - ".$title);
	}

	public function printNavigation() {
		$title = $this->model->tutorial->getTitle();
		?> <a href='index.php?page=tutorialList'>Tutorials</a> |  <?php echo($title);
	}

	public function printBody() {
		global $admin;
		global $loggedIn;
		$id = (int)$this->model->tutorial->getIdEditableArea();
		if($admin && $loggedIn) {
			?>
			<form id='editTutorial' name='edit' method='post'
				  action='./index.php?page=tutorialEdit&id=<?php echo($id); ?>'>
				<input type='hidden' name='action' value='editTutorial'/>
				<button class="submitButton" type='submit' name='editTutorial'>Edit</button>
			</form>
		<?php
		}
		$title = $this->model->tutorial->getTitle();
		$message = $this->model->tutorial->getMessage();

		?>
		<h2><?php echo($title); ?></h2>
		<div class='tutorialMessage'><?php echo($message);
			$title = $this->model->tutorial->getTitle();
			$id = (int)$this->model->tutorial->getIdEditableArea();
			$path = base64_encode("<a href='index.php?page=tutorialList'>Tutorials</a> | <a href='index.php?page=tutorial&id=$id'> $title</a>");
			$this->model->commentView->setPath($path);
			$this->model->commentView->printBody();

			if($loggedIn) {
				$type = Comment::TUTORIAL;
				?>
				<form id='addComment' name='addComment' method='post' action='./index.php?page=comment'>
					<input type='hidden' name='action' value='addComment'/>
					<input type='hidden' name='path' value='<?php echo($path); ?>'/>
					<input type='hidden' name='targetId' value='<?php echo($id); ?>'/>
					<input type='hidden' name='type' value='<?php echo($type); ?>'/>
					<button class='submitButton' type='submit' name='addComment'>Comment</button>
				</form>
			<?php
			}
			?>
		</div>
	<?php
	}

	public function printPageHeader() {
		$title = $this->model->tutorial->getTitle();
		echo($title);
	}

}