<?php

include_once 'View.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeTemplateDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemIconDAO.php';

class ItemView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printNavigation() {
		$itemName = $this->model->item->getName();
		?> <a href='index.php?page=recipes'>Recipes & Resources</a> |  <?php echo($itemName);
	}

	public function printBody() {
		global $loggedIn;
		global $admin;
		$itemId = (int)$this->model->item->getIdItem();
		$itemName = $this->model->item->getName();
		if($this->model->fail) {
			echo($this->model->error);
		}
		if($loggedIn && $admin) {
			?>
			<form name='editItem' method='post' action='./index.php?page=edit&item=<?php echo($itemId); ?>'>
				<input type='hidden' name='action' value='editItem'/>
				<button class="submitButton" type='submit' name='editItem'>Edit</button>
			</form>
		<?php
		}
		?>
		<h2>Recipe</h2>

		<?php
		$recipes = RecipeDAO::selectByItemId($itemId);
		foreach ($recipes as $recipe) {
			$outputId = (int)$recipe->getItemId();
			$recipeId = (int)$recipe->getIdRecipe();
			$recipeItems = RecipeItemDAO::selectByRecipeId($recipeId);
			$item = ItemDAO::selectById($outputId);
			$outputName = $item->getName();
			if($outputName == $itemName) {
				$this->printRecipe($recipe, $recipeItems, $item, $outputName, $itemId);
			}

		}
		?>
		<h2>Usage</h2>
		<?php
		$recipes = RecipeDAO::selectAll();
		foreach ($recipes as $recipe) {
			$recipeItems = array();
			$outputId = (int)$recipe->getItemId();
			$recipeId = (int)$recipe->getIdRecipe();
			$tempRecipeItems = RecipeItemDAO::selectByRecipeId($recipeId);
			foreach ($tempRecipeItems as $recipeItem) {
				$recipeItemId = (int)$recipeItem->getItemId();
				$push = FALSE;
				if($recipeItemId === $itemId) {
					$push = TRUE;
				}
				if($push) {
					$recipeItems = $tempRecipeItems;
				}
			}
			$item = ItemDAO::selectById($outputId);
			$outputName = $item->getName();
			if($outputName != $itemName) {
				$this->printRecipe($recipe, $recipeItems, $item, $outputName, $itemId);
			}
		}
		?>
		<?php
		if($admin && $loggedIn) {
			$templates = RecipeTemplateDAO::selectAll();
			if($loggedIn && $admin) {
				?>
				<div class='buttonsRecipe'>
					<form id="addRecipe" name='addRecipe' method='post'
						  action='./index.php?page=recipe&item=<?php echo($itemId); ?>'>
						<input type='hidden' name='action' value='addRecipe'/>
						<button class="submitButton" type='submit' name='addRecipe'>Add Recipe</button>
					</form>
					<div class="styled-select">
						<select name="templateList" form="addRecipe">
							<?php foreach ($templates as $template) {
								$templateId = $template->getIdRecipeTemplate();
								$templateName = $template->getName();
								?>
								<option value="<?php echo($templateId); ?>"><?php echo($templateName); ?></option> <?php
							} ?>
						</select>
					</div>
				</div>
			<?php
			}
		}
		foreach ($this->model->editArea as $area) {
			$title = $area->getTitle();

			echo("<div class='itemTextArea'>");
			$this->printSubsectionHeader($title);
			$text = $area->getMessage();
			$date = $area->getDate();
			$this->printTextArea($text, $date);
			$id = $area->getIdEditableArea();
			if($loggedIn && $admin) {

				?>
				<div class='buttonsItemEditArea'>
					<form name='editItem' method='post' action='./index.php?page=edit&item=<?php echo($itemId); ?>'>
						<input type='hidden' name='action' value='editArea'/>
						<input type='hidden' name='areaId' value='<?php echo($id); ?>'/>
						<button class="submitButton" type='submit' name='editArea'>Edit</button>
					</form>

					<form name='deleteItemEdit' method='post'
						  action='./index.php?page=item&item=<?php echo($itemId); ?>'>
						<input type='hidden' name='action' value='delete'/>
						<input type='hidden' name='areaId' value='<?php echo($id); ?>'/>
						<input class="submitButton" type='submit' name='delete' value='Delete'/>
					</form>

					<form name='changeWeight' method='post'
						  action='./index.php?page=item&item=<?php echo($itemId); ?>'>
						<input type='hidden' name='action' value='moveUp'/>
						<input type='hidden' name='areaId' value='<?php echo($id); ?>'/>
						<input type='image' name='up' src='pictures/up.png' alt='move up'/>
					</form>

					<form name='changeWeight' method='post'
						  action='./index.php?page=item&item=<?php echo($itemId); ?>'>
						<input type='hidden' name='action' value='moveDown'/>
						<input type='hidden' name='areaId' value='<?php echo($id); ?>'/>
						<input type='image' name='down' src='pictures/down.png'
							   alt='move down'/>
					</form>
				</div>
			<?php
			}
			echo("</div>");
		}
		if($loggedIn && $admin) {
			?>
			<form id='addSection' name='addSection' method='post'
				  action='./index.php?page=edit&item=<?php echo($itemId); ?>'>
				<input type='hidden' name='action' value='addArea'/>
				<button class="submitButton" type='submit' name='addArea'>Add Section</button>
			</form>
		<?php
		}
	}

	public function printPageHeader() {
		$name = $this->model->item->getName();
		if($name != '') {
			echo($name);
		} else {
			echo("Add Item");
		}
	}

	public function printTextArea($text, $date) {
		?>
		<article>
			<?php
			echo($text);
			?>
		</article>
		<span class='date'>
			<?php echo($date);
			?></span>
	<?php
	}

	public function printSubsectionHeader($name) {
		?><h2>
		<?php
		echo($name);
		?></h2>
	<?php
	}

	public function printTitle() {
		$name = $this->model->item->getName();
		if($name != '') {
			echo($name);
		} else {
			echo("Add Item");
		}
	}

	private function printRecipe($recipe, $recipeItems, $outputItem, $outputName, $itemId) {
		global $loggedIn;
		global $admin;
		$templateId = (int)$recipe->getRecipeTemplateId();
		$template = RecipeTemplateDAO::selectById($templateId);
		$templateImageName = $template->getImageName();
		?>
		<div class="template">  <?php
		$size = getimagesize("./pictures/templates/" . $templateImageName);
		$recipeId = (int)$recipe->getIdRecipe();
		$positions = $template->getPositions();
		$positions = explode(' | ', $positions);
		?>
		<div class="divImageTemplate" <?php echo $size[3]; ?>>
			<img class="imageTemplate" src="./pictures/templates/<?php echo($templateImageName); ?>">
			<?php
			foreach ($recipeItems as $recipeItem) {
				$position = $this->findPosition($positions, $recipeItem);
				$xy = explode(' , ', $position);
				$x = $xy[0] - 16;
				$y = $xy[1] - 16;
				$recipeItemId = (int)$recipeItem->getItemId();
				$item = ItemDAO::selectById($recipeItemId);
				$recipeItemName = $item->getName();
				?>
				<a href='./index.php?page=item&item=<?php echo($recipeItemId); ?>'>
					<img class='itemIcon'
						 alt='<?php echo($recipeItemName); ?>'
						 src='image.php?type=item&id=<?php echo($recipeItemId); ?>'
						 style="position: absolute; top:<?php echo($y); ?>px;
							 left:<?php echo($x); ?>px; width: 25px; height: 25px;">
				</a>
			<?php
			}
			$length = count($positions) - 1;
			$xy = explode(' , ', $positions[$length]);
			$x = $xy[0] - 16;
			$y = $xy[1] - 16;
			$outputItemId = $outputItem->getIdItem();
			?>
			<a href='./index.php?page=item&item=<?php echo($outputItemId); ?>'>
				<img class='itemIcon'
					 alt='<?php echo($outputName); ?>'
					 src='image.php?type=item&id=<?php echo($outputItemId); ?>'
					 style="position: absolute; top:<?php echo($y); ?>px;
						 left:<?php echo($x); ?>px; width: 25px; height: 25px;">
			</a>
		</div>
		<?php
		if($loggedIn && $admin) {
			?>
			<div class="buttonsRecipe">
				<form class="deleteRecipe" name='deleteRecipe' method='post'
					  action='./index.php?page=item&item=<?php echo($itemId); ?>'>
					<input type='hidden' name='action' value='deleteRecipe'/>
					<input type='hidden' name='id' value='<?php echo($recipeId); ?>'/>
					<button class="deleteButton" type='submit' name='deleteRecipe'>Delete</button>
				</form>
				<form id="editRecipe" name='editRecipe' method='post'
					  action='./index.php?page=recipe&item=<?php echo($itemId); ?>'>
					<input type='hidden' name='id' value='<?php echo($recipeId); ?>'/>
					<input type='hidden' name='action' value='editRecipe'/>
					<input type='hidden' name='templateId' value='<?php echo($templateId); ?>'/>
					<button class="editButton" type='submit' name='editRecipe'>Edit</button>
				</form>
			</div>
			</div>
		<?php
		}
	}

	private function findPosition($positions, $recipeItem) {
		foreach ($positions as $position) {
			$itemPos = $recipeItem->getTablePos();
			if($itemPos == $position) {
				return $position;
			}
		}
		return NULL;
	}

}
