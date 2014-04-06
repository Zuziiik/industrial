<?php

include_once 'Control.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';

class LoginControl extends Control {

	function __construct($model) {
		parent::__construct($model);
	}

	private function login() {
		if(isset($_POST['user']) || isset($_POST['pass'])) {
			$this->model->logging = TRUE;
			$username = sanitizeString($_POST['user']);
			$pass = sanitizeString($_POST['pass']);
			$user = UserDAO::selectByName($username);
			$this->model->user = $username;
			if($this->checkLoginValues($username, $user, $pass)) {
				$this->loginUser($user, $pass);
			}
		} else {
			$this->model->error = "<span class='error'>&#10007; malformed form data</span>";
		}
	}

	private function loginUser($user, $pass) {
		$hash = hash('sha256', $user->getSalt() . hash('sha256', $pass));
		if($hash != $user->getPassword()) {
			$this->model->passwordError = "<span class='error'>&#10007; Password invalid</span>";
		} else {
			$date = date('Y-m-d h:i:s', time());
			$user->setLastLogin($date);
			UserDAO::update($user);
			$_SESSION['id_user'] = $user->getIdUser();
			$_SESSION['username'] = $user->getUsername();
			$_SESSION['admin'] = $user->getAdmin();
			$_SESSION['confirmed'] = $user->getConfirmed();

			global $loggedIn;
			$loggedIn = TRUE;
			echo("<script>window.location = './index.php?page=home';</script>");
		}
	}

	private function checkLoginValues($username, $user, $pass) {
		if(!$this->emptyFields($username, $pass)) {
			if($this->userExists((int)$user->getIdUser())) {
				return TRUE;
			}
		}
		return FALSE;
	}

	private function emptyFields($username, $pass) {
		if($username == "" || $pass == "") {
			$this->model->fieldsError = "<span class='error'>&#10007; Not all fields were entered</span>";
			return TRUE;
		}
		return FALSE;
	}

	private function userExists($id) {
		if(!$id) {
			$this->model->usernameError = "<span class='error'>&#10007; Username invalid</span>";
			return FALSE;
		}
		return TRUE;
	}

	private function destroySession() {
		$_SESSION = array();

		if(session_id() != "" || isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time() - 2592000, '/');
		}
		session_destroy();
		global $loggedIn;
		$loggedIn = FALSE;
	}

	private function logout() {
		global $loggedIn;
		if($loggedIn) {
			$this->destroySession();
			$this->model->msg = "You have been logged out.";
		} else {

		}
	}

	public function initialize() {
		$action = "";
		if(isset($_POST['action'])) {
			$action = sanitizeString($_POST['action']);
		}
		if(isset($_GET['action'])) {

			$action = sanitizeString($_GET['action']);
		}
		switch ($action) {
			case 'login':
				$this->login();
				break;
			case 'logout':
				$this->logout();
				break;
			default:
		}
	}

}
