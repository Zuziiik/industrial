<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';

class UsersControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        global $loggedIn;
        global $admin;
        if (isset($_POST['action']) && $_POST['action'] === 'confirm') {
            $this->confirm();
        }
        if (isset($_POST['action']) && $_POST['action'] === 'changeAdmin') {
            $this->makeAdmin();
        }
        if ($loggedIn && $admin) {
            $this->model->users = UserDAO::selectAll();
        } else {
            $this->model->error = "<span class='error'>You're not logged in, or don`t have permissions for this.</span>";
        }
    }

    private function confirm() {
        if (isset($_POST['confirm'])) {
            $userId = (int)sanitizeString($_POST['id']);
            $user = UserDAO::selectById($userId);
            $user->setConfirmed(TRUE);
            UserDAO::update($user);
        }
    }

    private function makeAdmin() {
        if (isset($_POST['submit'])) {
            $userId = (int)sanitizeString($_POST['id']);
            $user = UserDAO::selectById($userId);
            if ($user->getAdmin()) {
                $user->setAdmin(FALSE);
            } else {
                $user->setAdmin(TRUE);
            }
            UserDAO::update($user);
        }
    }

}