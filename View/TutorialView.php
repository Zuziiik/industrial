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
		?> <li><a href='index.php?page=tutorialList'>Tutorials</a></li><li class="active"><?php echo($title);?></li><?php
	}

	public function printBody() {
		global $admin;
		global $loggedIn;
		$id = (int)$this->model->tutorial->getIdEditableArea();
		if($admin && $loggedIn) {
			?>
			<form class="pull-right" id='editTutorial' name='edit' method='post'
				  action='./index.php?page=tutorialEdit&id=<?php echo($id); ?>'>
				<input type='hidden' name='action' value='editTutorial'/>
				<button class="btn btn-default" type='submit' name='editTutorial'>Edit</button>
			</form>
		<?php
		}
		$title = $this->model->tutorial->getTitle();
		$message = $this->model->tutorial->getMessage();

		?>
		<h2><?php echo($title); ?></h2>
        <div class="panel panel-default">
		<div class='panel-body'><?php echo($message);
			$title = $this->model->tutorial->getTitle();
			$id = (int)$this->model->tutorial->getIdEditableArea();
			$path = base64_encode("<li><a href='index.php?page=tutorialList'>Tutorials</a></li><li><a href='index.php?page=tutorial&id=$id'> $title</a></li>");
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
					<button class='btn btn-default' type='submit' name='addComment'>Comment</button>
				</form>
			<?php
			}
			?>
		</div>
        </div>
	<?php
	}

	public function printPageHeader() {
	}

}