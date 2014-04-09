<?php

include_once 'View.php';

class ItemListView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printNavigation() {
		echo("Recipes & Resources");
	}

	public function printBody() {

		global $admin;
		global $loggedIn;
		echo($this->model->error);
		if($loggedIn && $admin) {

			?>
			<form name='addCategory' method='post' action='./index.php?page=recipes'>
				<label>Add Category<input id='title' type='text' name='categoryName'/></label>
				<button class="submitButton" type='submit'>Add</button>
			</form>
		<?php
		}
		echo("<div id='itemList'>");
		foreach ($this->model->categories as $category) {
			?>
			<div class='category frame'>
			<span class='categoryName'>
			<?php
			$nameCategory = $category[0]->getName();
			$id = $category[0]->getIdCategory();
			?>
				<h2><?php echo($nameCategory); ?></h2>
				<?php
				if($loggedIn && $admin) {

					?>
					<div class="categoryButtons buttonsGroup">
						<form name='deleteCategory' method='post' action='./index.php?page=recipes'>
							<input type='hidden' name='categoryDelete' value='<?php echo($id); ?>'/>
							<button class="submitButton" type='submit' name='deleteCategory'>Delete Category</button>
						</form>
						<form class="addItem" name='addItem' method='post' action='./index.php?page=edit'>
							<input type='hidden' name='action' value='addItem'/>
							<input type='hidden' name='categoryName' value='<?php echo($nameCategory); ?>'/>
							<button class="submitButton" type='submit' name='AddItem'>Add Item</button>
						</form>
					</div>
				<?php
				}
				echo("</span>");
				foreach ($category[1] as $item) {
					?>
					<div class="itemContainer frame">
						<div class='item'>
							<?php
							$id = $item->getIdItem();
							$name = $item->getName();
							$details = $item->getDetails();
							?>
							<img class='itemIcon' src='image.php?type=item&id=<?php echo($id); ?>'>
							<h3><a class='itemName'
								   href='./index.php?page=item&item=<?php echo($id); ?>'><?php echo($name); ?></a></h3>
							<div class='itemDetails'><?php echo($details); ?></div>
							<?php
							if($loggedIn && $admin) {
								?>
								<form name='deleteItem' method='post' action='./index.php?page=recipes'>
									<input type='hidden' name='action' value='deleteItem'/>
									<input type='hidden' name='itemId' value='<?php echo($id); ?>'/>
									<button class="submitButton" type='submit' name='DeleteItem'>Delete</button>
								</form>
							<?php
							}
							?>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		<?php

		}

		echo("</div>");
	}

	public function printPageHeader() {
		echo("Recipes & Resources");
	}

	public function printTitle() {
		echo("Recipes & Resources");
	}

}
