<?php

include_once 'View.php';

class HomeView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printBody() {
		global $admin;
		global $loggedIn;
		?>
		<h2>News</h2>
		<?php
		if($admin && $loggedIn) {
			?>
			<form name='addNews' method='post' action='./index.php?page=newsEdit'>
				<input type='hidden' name='action' value='addNews'/>
				<button class='submitButton' type='submit' name='addNews'>Add news</button>
			</form>
		<?php
		}
		foreach ($this->model->news as $singleNews) {
			$id = (int)$singleNews->getIdEditableArea();
			$title = $singleNews->getTitle();
			$message = $singleNews->getMessage();
			$message = substr($message, 0, 500);
			?>
			<div class="news">
				<h3><?php echo $title; ?></h3><?php
				?>
				<div class='newsMessage'><?php echo $message; ?><?php
					?><a class='more' href='./index.php?page=news&id=<?php echo $id; ?>'>More...</a><?php
					if($admin && $loggedIn) {
						?>
						<form name='deleteNews' method='post' action='./index.php?page=home'>
							<input type='hidden' name='action' value='deleteNews'/>
							<input type='hidden' name='id' value='<?php echo $id; ?>'/>
							<button class='submitButton' type='submit' name='deleteNews'> Delete</button>
						</form>
					<?php
					}
					?>
				</div>
			</div>
		<?php
		}
	}

	public function printNavigation() {
		echo("Home");
	}

	public function printPageHeader() {
	}

	public function printTitle() {
		echo("Industrial Craft - Wiki");
	}

}

