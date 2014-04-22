<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeTemplateDAO.php';

class TemplateFormControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		global $loggedIn;
		global $admin;
		if($loggedIn && $admin) {
			$this->model->add = FALSE;
			$this->model->edit = FALSE;
			$this->model->submitted = FALSE;
			$this->model->selectedImage = FALSE;
			$this->model->loaded = FALSE;
			if(isset($_POST['action']) && $_POST['action'] == 'addTemplate') {
				$this->model->add = TRUE;
				$this->loadImage();
			}
			if(isset($_POST['action']) && $_POST['action'] == 'submitPositions') {
				$this->model->selectedImage = TRUE;
				$this->model->add = TRUE;
				$this->loadPositions();
			}
			if(isset($_POST['action']) && $_POST['action'] == 'backFromPositions') {
				$this->backFromPositions();
			}
			if(isset($_POST['action']) && $_POST['action'] == 'backFromConfirm') {
				$this->backFromConfirm();
			}

		} else {
			$this->model->error = "<span class='text-danger'>You're not logged in, or don`t have permissions for this.</span>";
		}
	}

	private function backFromPositions() {
		$this->model->selectedImage = FALSE;
		$this->model->add = TRUE;
		$this->model->imageName = sanitizeString($_POST['imageName']);
		unlink("pictures/templates/" . $this->model->imageName);
		$this->model->loaded = FALSE;
	}

	private function backFromConfirm() {
		$this->model->selectedImage = TRUE;
		$this->model->add = TRUE;
		$this->model->loaded = TRUE;
		$this->model->imageName = sanitizeString($_POST['imageName']);
		$this->model->name = sanitizeString($_POST['name']);
		$this->model->positions = sanitizeString($_POST['positions']);
		$this->model->submitted = FALSE;

	}

	private function loadImage() {

		if(isset($_POST['submitPicture'])) {
			if(!empty($_FILES['image']['name'])) {
				$this->model->selectedImage = TRUE;
				$name = $text = substr(md5(uniqid(rand(), TRUE)), 0, 25) . ".png";

				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES["image"]["name"]);
				$extension = end($temp);
				if((($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/pjpeg") || ($_FILES["image"]["type"] == "image/x-png") || ($_FILES["image"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
					if(!($_FILES["image"]["error"] > 0)) {
						move_uploaded_file($_FILES["image"]["tmp_name"], "pictures/templates/" . $_FILES["image"]["name"]);
						rename("pictures/templates/" . $_FILES["image"]["name"], "pictures/templates/" . $name);
						$this->imgResize("pictures/templates/" . $name);
						$this->model->imageName = $name;
						$this->model->loaded = TRUE;
					}
				} else {
					$this->model->error = "<span class='text-danger'>File's invalid.</span>";
				}

			} else {
				$this->model->selectedImage = FALSE;
				$this->model->error = "<span class='text-danger'>No image selected.</span>";
			}
		}
	}

	private function imgResize($path) {

		$x = getimagesize($path);
		$width = $x['0'];
		$height = $x['1'];

		$rs_width = 256; //resize to half of the original width.
		$rs_height = 132; //resize to half of the original height.
		$img = imagecreatefrompng($path);

		$img_base = imagecreatetruecolor($rs_width, $rs_height);
		imagecopyresized($img_base, $img, 0, 0, 0, 0, $rs_width, $rs_height, $width, $height);
		imagepng($img_base, $path);

	}

	private function loadPositions() {

		if(isset($_POST['submitPositions'])) {
			$this->model->submitted = TRUE;
			$this->model->imageName = sanitizeString($_POST['imageName']);
			$this->model->name = sanitizeString($_POST['name']);
			$this->model->positions = sanitizeString($_POST['positions']);

		}
		if(isset($_POST['confirm'])) {
			$this->model->imageName = sanitizeString($_POST['imageName']);
			$cords = '';
			foreach ($_POST['cords'] as $cord) {
				$cords = $cords . ' | ' . sanitizeString($cord);
			}
			$name = sanitizeString($_POST['name']);
			$template = new RecipeTemplate(666, $name, $cords, $this->model->imageName);
			RecipeTemplateDAO::insert($template);
			echo("<script>window.location = './index.php?page=recipeTemplates';</script>");
		}
	}

}