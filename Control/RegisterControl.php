<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';

class RegisterControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {
		global $loggedIn;
		if($loggedIn) {
			$this->model->error = "<span class='error'>You can`t register, because you're already logged in</span>";
		} else {
			if(isset($_POST['user']) || isset($_POST['password']) || isset($_POST['repeatPassword']) || isset($_POST['email'])) {
				$this->model->user = sanitizeString($_POST['user']);
				$this->model->email = sanitizeString($_POST['mail']);
				$pass1 = sanitizeString($_POST['password']);
				$pass2 = sanitizeString($_POST['repeatPassword']);
				if($this->checkLoginValues($this->model->user, $this->model->email, $pass1, $pass2)) {
					$this->register($this->model->user, $this->model->email, $pass1);
				}
			}
		}
	}

	private function register($username, $email, $pass1) {
		$hash = hash('sha256', $pass1);
		$salt = $this->createSalt();
		$password = hash('sha256', $salt . $hash);
		$createTime = date('Y-m-d h:i:s', time());
		UserDAO::insert(new User(666, $username, $password, $salt, $email, $createTime, 0, 0, $createTime, ""));
		$this->model->msg = "Registration complete. Plese log in <a class='link' href='./index.php?page=login'>here</a>";
	}

	private function createSalt() {
		$text = md5(uniqid(rand(), TRUE));
		return substr($text, 0, 3);
	}

	private function checkLoginValues($username, $email, $pass1, $pass2) {
		$error = FALSE;
		if($this->emptyFields($username, $email, $pass1, $pass2)) {
			return FALSE;
		}

		if($this->userExists($username, $email)) {
			return FALSE;
		}

		if($pass1 !== $pass2) {
			$this->model->errorPass = "<span class='error'>&#10007; Passwords don`t match.</span>";
			$error = TRUE;
		}

		if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
			$this->model->errorEmailFormat = "<span class='error'>&#10007; Invalid email format!</span><br />";
			$error = TRUE;
		}
		return !$error;
	}

	private function emptyFields($username, $email, $pass1, $pass2) {
		if($username == "" || $pass1 == "" || $pass2 == "" || $email == "") {
			$this->model->error = "<span class='error'>&#10007; Not all fields were entered</span>";
			return TRUE;
		}
		return FALSE;
	}

	private function userExists($username, $email) {
		$error = FALSE;
		if(UserDAO::UsernameExists($username)) {
			$this->model->errorUser = "<span class='error'>&#10007; Username already exists.</span>";
			$error = TRUE;
		}
		if(UserDAO::EmailExists($email)) {
			$this->model->errorEmail = "<span class='error'>&#10007; Email already exists.</span>";
			$error = TRUE;
		}
		return $error;
	}

}
