<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemIconDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/CategoryDAO.php';

class ItemFormControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		global $loggedIn;
		global $admin;
		if(isset($_GET['item'])) {
			$this->model->addItem = FALSE;
			$this->model->addArea = FALSE;
			$itemId = (int)sanitizeString($_GET['item']);
			$this->model->item = ItemDAO::selectById($itemId);
			if(isset($_POST['areaId']) && $_POST['action'] == 'editArea') {
				if($admin && $loggedIn) {
					$areaId = (int)sanitizeString($_POST['areaId']);
					$this->model->area = EditableAreaDAO::selectById($areaId);
					$this->editArea($areaId, $itemId);
				} else {
					$this->model->error = "<span class='error'>You're not logged in, or must be admin to add/edit.</span>";
				}
			}
			if($_POST['action'] == 'addArea') {
				if($admin && $loggedIn) {
					$this->model->addArea = TRUE;
					$this->addArea($itemId);
				} else {
					$this->model->error = "<span class='error'>You're not logged in, or must be admin to add/edit.</span>";
				}
			}
			if(isset($_POST['action']) && $_POST['action'] == 'editItem') {
				if($admin && $loggedIn) {
					$this->edit();
				} else {
					$this->model->error = "<span class='error'>You're not logged in, or must be admin to add/edit.</span>";
				}
			}
		} else {
			if(isset($_POST['action']) && $_POST['action'] == 'addItem') {
				if($admin && $loggedIn) {
					$this->model->addItem = TRUE;
					$this->model->categoryName = sanitizeString($_POST['categoryName']);
					$this->add();
				} else {
					$this->model->error = "<span class='error'>You're not logged in, or must be admin to add/edit.</span>";
				}
			}
		}
	}

	private function addArea($itemId) {
		if(isset($_POST['save'])) {
			$title = sanitizeString($_POST['title']);
			$text = sanitizeTextArea($_POST['text']);
			$type = EditableArea::ITEM;
			$date = date('Y-m-d h:i:s', time());
			$weight = EditableAreaDAO::selectHighestWeight();
			$weight++;
			$area = new EditableArea(666, $itemId, $type, $date, $title, $text, $weight);
			EditableAreaDAO::insert($area);
			echo("<script>window.location = './index.php?page=item&item=$itemId';</script>");

		}
	}

	private function editArea($areaId, $itemId) {
		if(isset($_POST['save'])) {
			$title = sanitizeString($_POST['title']);
			$text = sanitizeTextArea($_POST['text']);
			$area = EditableAreaDAO::selectById($areaId);
			$area->setTitle($title);
			$area->setMessage($text);
			echo("<script>window.location = './index.php?page=item&item=$itemId';</script>");
			EditableAreaDAO::update($area);
		}
	}

	private function add() {
		if(isset($_POST['save'])) {
			$name = sanitizeString($_POST['name']);
			$details = sanitizeString($_POST['details']);
			$categoryName = sanitizeString($_POST['categoryName']);
			$industrial = (boolean)sanitizeString($_POST['industrial']);
			$category = CategoryDAO::selectByName($categoryName);
			$categoryId = $category->getIdCategory();
			ItemDAO::insert(new Item(666, $categoryId, $name, $details, $industrial));
			$item = ItemDAO::selectByName($name);
			$itemId = $item->getIdItem();
			if(isset($_FILES['image']['name'])) {
				$saveto = "pictures/upload/$itemId.png";
				move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
				$this->updateImage($saveto, $itemId);
			}
			echo("<script>window.location = './index.php?page=item&item=$itemId';</script>");
		}
	}

	private function edit() {
		if(isset($_POST['save'])) {
			$name = sanitizeString($_POST['name']);
			$details = sanitizeString($_POST['details']);
			$itemId = (int)sanitizeString($_GET['item']);
			$industrial = (boolean)sanitizeString($_POST['industrial']);
			if(isset($_FILES['image']['name'])) {

				$saveto = "pictures/upload/$itemId.png";
				move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
				$this->updateImage($saveto, $itemId);
			}
			$item = ItemDAO::selectById($itemId);
			$item->setIndustrial($industrial);
			$item->setName($name);
			$item->setDetails($details);
			ItemDAO::update($item);
			echo("<script>window.location = './index.php?page=item&item=$itemId';</script>");
		}
	}

	private function updateImage($saveto, $itemId) {
		$typeok = TRUE;

		switch ($_FILES['image']['type']) {
			case "image/gif":
				$src = imagecreatefromgif($saveto);
				break;
			case "image/jpeg": // Both regular and progressive jpegs
			case "image/pjpeg":
				$src = imagecreatefromjpeg($saveto);
				break;
			case "image/png":
				$src = imagecreatefrompng($saveto);
				break;
			default:
				$typeok = FALSE;
				break;
		}

		if($typeok) {

			$saveto = $this->resizeImage($saveto, $src);

			$content = addslashes(file_get_contents($saveto));

			ItemIconDAO::set(new ItemIcon($itemId, $content));

			unlink($saveto);
		}
	}

	private function resizeImage($saveto, $src) {
		list($width, $height) = getimagesize($saveto);

		$max = 100;
		$rs_width = $width;
		$rs_height = $height;

		if($width > $height && $max < $width) {
			$rs_height = $max / $width * $height;
			$rs_width = $max;
		} elseif($height > $width && $max < $height) {
			$rs_width = $max / $height * $width;
			$rs_height = $max;
		} elseif($max < $width) {
			$rs_width = $th = $max;
		}

		$tmp = imagecreatetruecolor($rs_width, $rs_height);
		imagealphablending($tmp, false);
		imagesavealpha($tmp,true);
		$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
		imagefilledrectangle($tmp, 0, 0, $rs_width, $rs_height, $transparent);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $rs_width, $rs_height, $width, $height);
		imagepng($tmp, $saveto);
		imagedestroy($tmp);
		imagedestroy($src);
		return $saveto;
	}

}
