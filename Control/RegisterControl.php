<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';

class RegisterControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        global $loggedin;
        if ($loggedin) {
            $this->model->error = "<span class='error'>You cant register, because you're already logged in</span>";
        } else {
            if (isset($_POST['user']) || isset($_POST['pass1']) || isset($_POST['pass2']) || isset($_POST['email'])) {
                $this->model->user = sanitizeString($_POST['user']);
                $this->model->email = sanitizeString($_POST['email']);
                $pass1 = sanitizeString($_POST['pass1']);
                $pass2 = sanitizeString($_POST['pass2']);
                if ($this->checkLoginValues($this->model->user, $this->model->email, $pass1, $pass2)) {
                    $this->register($this->model->user, $this->model->email, $pass1);
                }
            } else {
                $this->model->msg = "malfored form data";
            }
        }
    }

    private function register($username, $email, $pass1) {
        $hash = hash('sha256', $pass1);
        $salt = $this->createSalt();
        $password = hash('sha256', $salt . $hash);
        $createTime = date('Y-m-d h:i:s', time());
        UserDAO::insert(new User(666, $username, $password, $salt, $email, $createTime, 0, 0, $createTime, ""));
        $this->model->msg = "Registration complete. Plese log in <a href='./index.php?page=login'>here</a>";
    }

    private function createSalt() {
        $text = md5(uniqid(rand(), true));
        return substr($text, 0, 3);
    }

    private function checkLoginValues($username, $email, $pass1, $pass2) {
        $error = FALSE;
        if ($this->emptyFields($username, $email, $pass1, $pass2)) {
            return FALSE;
        }

        if ($this->userExists($username, $email)) {
            return FALSE;
        }

        if ($pass1 !== $pass2) {
            $this->model->errorPass = "<span class='error'>Passwords doesnt match.</span>";
            $error = TRUE;
        }

        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            $this->model->errorEmailFormat = "<span class='error'>Invalid email format!</span><br />";
            $error = TRUE;
        }
        return !$error;
    }

    private function emptyFields($username, $email, $pass1, $pass2) {
        if ($username == "" || $pass1 == "" || $pass2 == "" || $email == "") {
            $this->model->error = "<span class='error'>Not all fields were entered</span>";
            return true;
        }
        return false;
    }

    private function userExists($username, $email) {
        $error = FALSE;
        if (UserDAO::UsernameExists($username)) {
            $this->model->errorUser = "<span class='error'>Username already exists.</span>";
            $error = TRUE;
        }
        if (UserDAO::EmailExists($email)) {
            $this->model->errorEmail = "<span class='error'>Email already exists.</span>";
            $error = TRUE;
        }
        return $error;
    }

}
