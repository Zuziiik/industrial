<?php

include_once 'View.php';

class TutorialListView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		echo("Tutorials");
	}

	public function printNavigation() {
		echo("Tutorials");
	}

	public function printBody() {
		global $admin;
		global $loggedIn;
		if($admin && $loggedIn) {
			?>
			<form id='addTutorial' name='addTutorial' method='post' action='./index.php?page=tutorialEdit'>
				<input type='hidden' name='action' value='addTutorial'/>
				<input type='submit' name='addTutorial' value='Add Tutorial'/>
			</form>
		<?php
		}
		foreach ($this->model->tutorials as $tutorial) {
			$id = (int)$tutorial->getIdEditableArea();
			$title = $tutorial->getTitle();
			$message = $tutorial->getMessage();
			$message = substr($message, 0, 300);
			?><span class='tutorialTitle'><h2><?php echo($title); ?></h2></span><?php
			?><span class='tutorialMessage'><?php echo($message); ?></span><?php
			?><a class='more' href='./index.php?page=tutorial&id=<?php echo($id); ?>'>More...</a><?php
			if($admin && $loggedIn) {
				?>
				<form class='deleteButton' name='deleteTutorial' method='post' action='./index.php?page=tutorialList'>
					<input type='hidden' name='action' value='deleteTutorial'/>
					<input type='hidden' name='id' value='<?php echo($id); ?>'/>
					<input type='submit' name='deleteTutorial' value='Delete'/>
				</form>
			<?php
			}
		}
	}

	public function printPageHeader() {
		echo("Tutorials");
	}

}