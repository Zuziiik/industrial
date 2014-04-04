<?php

include_once 'View.php';

class ItemFormView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printBody() {
		global $loggedIn;
		global $admin;
		if(!$loggedIn && !$admin) {
			echo($this->model->error);
		} else {
			// loggedIn and admin
			$this->addOrEdit();
		}
	}

	public function printNavigation() {
		if($this->model->addItem) {
			?> <a href='index.php?page=recipes'>Recipes & Resources</a> |  Add Item<?php
		} else {
			$itemName = $this->model->item->getName();
			$itemId = $this->model->item->getIdItem();
			if($this->model->addArea) {
				?> <a href='index.php?page=recipes'>Recipes & Resources</a> |  <a
					href='index.php?page=item&item=<?php echo($itemId); ?>'><?php echo($itemName); ?></a> | add Section<?php
			} else {
				?> <a href='index.php?page=recipes'>Recipes & Resources</a> |  <a
					href='index.php?page=item&item=<?php echo($itemId); ?>'><?php echo($itemName); ?></a> | edit <?php echo($itemName);
			}
		}
	}

	public function addOrEdit() {
		if(!$this->model->addItem && !$this->model->addArea) {
			$this->edit();
		} else {
			if($this->model->addArea) {
				$this->addArea();
			} else {
				$this->addItem();
			}
		}
	}

	public function edit() {
		if($this->model->area) {
			//edit one subsection of item
			$itemId = $this->model->item->getIdItem();
			$title = $this->model->area->getTitle();
			$id = $this->model->area->getIdEditableArea();
			$text = $this->model->area->getMessage();
			?>
			<form name='editArea' method='post' action='./index.php?page=edit&item=<?php echo($itemId); ?>'>
				<input type='hidden' name='action' value='editArea'/>
				<input id='title' type='text' placeholder="Title" name='title'
					   value='<?php echo $title; ?>'/>
				<input type='hidden' name='areaId' value='<?php echo $id; ?>'/>
				<textarea class='editForm' name=text rows="4" cols="50" wrap='hard'><?php echo($text); ?> </textarea>
				<button class='submitButton' type='submit' name='save'>Save</button>
			</form>

		<?php
		} else {
			$itemId = $this->model->item->getIdItem();
			$itemName = $this->model->item->getName();
			$details = $this->model->item->getDetails();
			?>
			<form name='edit' method='post' action='./index.php?page=edit&item=<?php echo($itemId); ?>'
				  enctype='multipart/form-data'>
				<input type='hidden' name='action' value='editItem'/>
				<input id='title' type='text' name='name' placeholder="Name"
					   value='<?php echo($itemName); ?>'/>
				<label for='image'>Icon</label>
				<input class="custom-file-input" type='file' id='image' name='image' size='14' maxlength='32'/>
				<textarea class='editForm' name='details' id='details' wrap="hard" placeholder="Details" rows="4"
						  cols="50"><?php echo($details); ?></textarea>
				<button class='submitButton' type='submit' name='save'>Save</button>
			</form>

		<?php
		}
	}

	public function addItem() {
		$nameCategory = $this->model->categoryName;
		?>
		<form name='add' method='post' action='./index.php?page=edit' enctype='multipart/form-data'>
			<input type='hidden' name='action' value='addItem'/>
			<input type='hidden' name='categoryId' value='addItem'/>
			<input id='title' type='text' name='name' placeholder="Name" autofocus/>
			<label for='image'>Icon</label>
			<input class="custom-file-input" type='file' id='image' name='image' size='14' maxlength='32'/>
			<input type='hidden' name='categoryName' value='<?php echo($nameCategory); ?>'/>
			<textarea class='editForm' name='details' id='details' rows="4" cols="50">Add details.</textarea>
			<button class='submitButton' type='submit' name='save'>Save</button>
		</form>
	<?php
	}

	public function addArea() {
		$itemId = $this->model->item->getIdItem();
		?>
		<form name='addArea' method='post' action='./index.php?page=edit&item=<?php echo($itemId); ?>'>
			<input type='hidden' name='action' value='addArea'/>
			<input id='title' type='text' placeholder="Title" name='title' autofocus/>
			<textarea class='editForm' name='text' rows="4" cols="50"></textarea>
			<button class='submitButton' type='submit' name='save'>Save</button>
		</form>
	<?php
	}

	public function printPageHeader() {
		if($this->model->addItem) {
			echo("Add item");
		} else {
			if($this->model->addArea) {
				echo("Add section");
			}
			$itemName = $this->model->item->getName();
			echo("Edit " . $itemName);
		}
	}

	public function printTitle() {
		if($this->model->addItem) {
			echo("Add item");
		} else {
			if($this->model->addArea) {
				echo("Add section");
			}
			$itemName = $this->model->item->getName();
			echo("Edit " . $itemName);
		}
	}

}
