<?php

include_once 'View.php';

class LinksView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		echo("Links");
	}

	public function printNavigation() {
		echo("Links");
	}

	public function printBody() {
		global $admin;
		global $loggedIn;
		?>
		<h2>Resource Packs</h2>
		<?php
		foreach ($this->model->resourcePacks as $resourcePack) {
			$title = $resourcePack->getTitle();
			$message = $resourcePack->getMessage();
			$id = $resourcePack->getIdEditableArea();
			?>
			<h3><?php echo($title); ?></h3>
			<a class="link" href='<?php echo($message); ?>'><?php echo($message); ?></a>
			<?php
			if($admin && $loggedIn) {
				?>
				<form class='deleteLink' name='delete' method='post' action='./index.php?page=links'>
					<input type='hidden' name='LinkId' value='<?php echo $id; ?>'/>
					<input class='submit' type='submit' name='delete' value='Delete'/>
				</form>
				<form class='editLink' name='editResourcePack' method='post' action='./index.php?page=linksForm'>
					<input type='hidden' name='action' value='editResourcePack'/>
					<input type='hidden' name='LinkId' value='<?php echo $id; ?>'/>
					<input class='submit' type='submit' name='editResourcePack' value='Edit'/>
				</form>
			<?php

			}

		}
		if($admin && $loggedIn) {
			?>
			<form id='addResourcePack' name='addResourcePack' method='post' action='./index.php?page=linksForm'>
				<input type='hidden' name='action' value='addResourcePack'/>
				<input class='submit' type='submit' name='addResourcePack' value='Add Resource Pack'/>
			</form>
		<?php

		}
		?>
		<h2>Other Links</h2>
		<?php
		foreach ($this->model->links as $link) {
			$title = $link->getTitle();
			$message = $link->getMessage();
			$id = $link->getIdEditableArea();
			?>
			<h3><?php echo($title); ?></h3>
			<a class="link" href='<?php echo($message); ?>'><?php echo($message); ?></a>
			<?php
			if($admin && $loggedIn) {
				?>
				<form class='deleteLink' name='delete' method='post' action='./index.php?page=links'>
					<input type='hidden' name='LinkId' value='<?php echo $id; ?>'/>
					<input class='submit' type='submit' name='delete' value='Delete'/>
				</form>
				<form class='editLink' name='editLink' method='post' action='./index.php?page=linksForm'>
					<input type='hidden' name='action' value='editLink'/>
					<input type='hidden' name='LinkId' value='<?php echo $id; ?>'/>
					<input class='submit' type='submit' name='editLink' value='Edit'/>
				</form>
			<?php
			}

		}
		if($admin && $loggedIn) {
			?>
			<form id='addLink' name='addLink' method='post' action='./index.php?page=linksForm'>
				<input type='hidden' name='action' value='addLink'/>
				<input class='submit' type='submit' name='addLink' value='Add Link'/>
			</form>
		<?php
		}
	}

	public function printPageHeader() {
		echo("Links");
	}

}