<?php

include_once 'View.php';

class RecipeTemplatesView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		echo("Recipe Templates");
	}

	public function printNavigation() {
		?> <a href='.'>Home</a> | Recipe Templates <?php
	}

	public function printBody() {
		global $loggedIn;
		global $admin;
		if($loggedIn && $admin) {
			echo($this->model->error);
			?>
			<form name='addTemplate' method='post' action='./index.php?page=templateForm'>
				<input type='hidden' name='action' value='addTemplate'/>
				<button class="submitButton" type='submit' name='addTemplate'>Add Template</button>
			</form>

			<?php
			foreach ($this->model->templates as $template) {
				?>
				<div class="template">  <?php
					$imageName = $template->getImageName();
					$size = getimagesize("./pictures/templates/" . $imageName);
					$id = $template->getIdRecipeTemplate();
					$name = $template->getName();
					$positions = $template->getPositions();
					$positions = explode(' | ', $positions);
					?> <h2><?php echo $name; ?></h2>

					<div class="divImageTemplate" <?php echo $size[3]; ?>>
						<img class="imageTemplate" src="./pictures/templates/<?php echo($imageName); ?>">
						<?php
						foreach ($positions as $position) {
							if($position != '') {
								$xy = explode(' , ', $position);
								$x = $xy[0] - 16;
								$y = $xy[1] - 16;
								?>
								<div class="templateIconDiv"
									 style="top:<?php echo($y); ?>px; left:<?php echo($x); ?>px;"></div>
							<?php
							}
						}
						?>
					</div>
					<form class="deleteTemplate" name='deleteTemplate' method='post'
						  action='./index.php?page=recipeTemplates'>
						<input type='hidden' name='action' value='deleteTemplate'/>
						<input type='hidden' name='id' value='<?php echo($id); ?>'/>
						<button class="submitButton" type='submit' name='deleteTemplate'>Delete</button>
					</form>
				</div>
			<?php
			}

		} else {
			echo($this->model->error);
		}
	}

	public function printPageHeader() {
		echo("Recipe Templates");
	}

}