<?php

include_once 'Control.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';

class LoginControl extends Control {

    private $username = '';
    private $pass = '';
    private $error = '';

    function __construct($model) {
        parent::__construct($model);
    }

    private function login() {
        if (isset($_POST['user']) || isset($_POST['pass'])) {
            $this->model->logging = TRUE;
            $username = sanitizeString($_POST['user']);
            $pass = sanitizeString($_POST['pass']);
            $user = UserDAO::selectByName($username);
            $this->model->user = $username;
            if ($this->checkLoginValues($username, $user, $pass)) {
                $this->loginUser($user, $pass);
            }
        } else {
            $this->model->msg = "malfored form data";
        }
    }

    private function loginUser($user, $pass) {
        $hash = hash('sha256', $user->getSalt() . hash('sha256', $pass));
        if ($hash != $user->getPassword()) {
            $this->model->error = "<span id='error'>Password invalid</span>";
        } else {
            $date = date('Y-m-d h:i:s', time());
            $user->setLastLogin($date);
            UserDAO::update($user);
            $_SESSION['id_user'] = $user->getIdUser();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['admin'] = $user->getAdmin();
            $_SESSION['confirmed'] = $user->getConfirmed();
            
            
            global $loggedin;
            $loggedin = TRUE;
            $this->model->msg = "You are now logged in.  <a href='index.php'> click here </a>to continue.";
        }
    }

    private function checkLoginValues($username, $user, $pass) {
        if (!$this->emptyFields($username, $pass)) {
            if ($this->userExists($user)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    private function emptyFields($username, $pass) {
        if ($username == "" || $pass == "") {
            $this->model->error = "<span id='error'>Not all fields were entered</span>";
            return true;
        }
        return false;
    }

    private function userExists($user) {
        if (!$user) {
            $this->model->error = "<span id='error'>Username invalid</span>";
            return FALSE;
        }
        return TRUE;
    }

    private function destroySession() {
        $_SESSION = array();

        if (session_id() != "" || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 2592000, '/');
        }
        session_destroy();
        global $loggedin;
        $loggedin = FALSE;
    }

    private function logout() {
        global $loggedin;
        if ($loggedin) {
            $this->destroySession();
            $this->model->msg = "You have been logged out.";
        } else {
            
        }
    }

    public function initialize() {
        $action = "";
        if (isset($_POST['action'])) {
            $action = sanitizeString($_POST['action']);
        }
        if (isset($_GET['action'])) {

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
