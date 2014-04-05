<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/UserIconDAO.php';

class ProfileControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		global $loggedIn;
		global $username;
		if($loggedIn) {
			if(isset($_GET['name'])) {
				$this->model->edit = FALSE;
				$this->model->username = sanitizeString($_GET['name']);
				$user = UserDAO::selectByName($this->model->username);
				$id = (int)$user->getIdUser();
				if(UserDAO::userExists($id)) {
					$this->model->user = $user;
					if(isset($_POST['action']) == 'editProfile') {
						$this->model->edit = TRUE;
						$this->edit($id, $user);
					}
					if(isset($_POST['changePassword']) && ($username == $this->model->username)) {
						$this->changePassword($user);
					}
				}
			}
		} else {
			$this->model->error = "<span class='error'>You`re not logged in.</span>";
		}
	}

	private function changePassword($user) {
		$oldPassword = sanitizeString($_POST['oldPassword']);
		$newPassword = sanitizeString($_POST['newPassword']);
		$repeatPassword = sanitizeString($_POST['repeatPassword']);
		if($this->checkPasswords($user, $oldPassword, $newPassword, $repeatPassword)) {
			$hash = hash('sha256', $newPassword);
			$salt = $this->createSalt();
			$password = hash('sha256', $salt . $hash);
			$user->setSalt($salt);
			$user->setPassword($password);
			UserDAO::update($user);
		}

	}

	private function createSalt() {
		$text = md5(uniqid(rand(), TRUE));
		return substr($text, 0, 3);
	}

	private function checkPasswords($user, $oldPassword, $newPassword, $repeatPassword) {
		$pass = TRUE;
		$hash = hash('sha256', $user->getSalt() . hash('sha256', $oldPassword));
		if($hash != $user->getPassword()) {
			$pass = FALSE;
			$this->model->OldPasswordError = "<span class='error'>Password invalid</span>";
		}
		if($newPassword != $repeatPassword) {
			$pass = FALSE;
			$this->model->PasswordsMatchError = "<span class='error'>Passwords don`t match.</span>";
		}
		if($newPassword == '' || $oldPassword == '' || $repeatPassword == '') {
			$pass = FALSE;
			$this->model->EmptyFieldsError = "<span class='error'>Not all fields were entered</span>";
		}
		return $pass;
	}

	private function edit($userId, $user) {
		if(isset($_POST['save'])) {
			global $username;
			if($username == $this->model->username) {
				if(isset($_FILES['image']['name'])) {
					$saveto = "$userId.png";
					move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
					$this->updateImage($saveto, $userId);
				}
				$about = sanitizeTextArea($_POST['about']);
				$user->setAbout($about);
				UserDAO::update($user);
			} else {
				$this->model->error = "<span class='error'>You don`t have permissions to do that.</span>";
			}
			$this->model->edit = FALSE;
		}
	}

	private function updateImage($saveto, $userId) {
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

			UserIconDAO::set(new UserIcon($userId, $content));

			unlink($saveto);
		}
	}

	private function resizeImage($saveto, $src) {
		list($w, $h) = getimagesize($saveto);

		$max = 100;
		$tw = $w;
		$th = $h;

		if($w > $h && $max < $w) {
			$th = $max / $w * $h;
			$tw = $max;
		} elseif($h > $w && $max < $h) {
			$tw = $max / $h * $w;
			$th = $max;
		} elseif($max < $w) {
			$tw = $th = $max;
		}

		$tmp = imagecreatetruecolor($tw, $th);
		imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));
		imagealphablending($tmp, FALSE);
		imagesavealpha($tmp, TRUE);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
		imageconvolution($tmp, array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
		imagepng($tmp, $saveto, 9);
		imagedestroy($tmp);
		imagedestroy($src);
		return $saveto;
	}

}