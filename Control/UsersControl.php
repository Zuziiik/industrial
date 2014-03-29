<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/BanDAO.php';

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

            $this->changeAdmin();
        }
        if (isset($_POST['banUser'])) {

            $this->ban();
        }
        if (isset($_POST['action']) && $_POST['action'] === 'unbanUser') {
            $this->unban();
        }
        if ($loggedIn && $admin) {
            $this->model->users = UserDAO::selectAll();
            $this->model->bans = BanDAO::selectAllCurrent();
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

    private function changeAdmin() {
        global $username;
        if (isset($_POST['submit'])) {
            $userId = (int)sanitizeString($_POST['id']);
            $user = UserDAO::selectById($userId);
            $name = $user->getUsername();
            if($name=='Kiki' || $name == $username){
                $this->model->error = "<span class='error'>You can`t make user from $name!!</span>";
            }else{

                if ($user->getAdmin()) {
                    $user->setAdmin(FALSE);
                } else {
                    $user->setAdmin(TRUE);
                }
            }
            UserDAO::update($user);
        }
    }

    private function ban() {
            $days = sanitizeString($_POST['days']);
            $userId = (int)sanitizeString($_POST['id']);
            $ban = BanDAO::selectCurrentByUserId($userId);
            if ($ban->getIdBan()) {
                $end = $ban->getBanEnd();
                $this->model->error = "<span class='error'>User is already banned till $end.</span>";
            } else {
                $startDate = new Datetime(date("Y-m-d H:i:s", time()));
                $start = $startDate->format("Y-m-d H:i:s");
                $endDate = $startDate->modify('+ ' . $days . ' days');
                $end = $endDate->format("Y-m-d H:i:s");
                BanDAO::insert(new Ban(666, $userId, $start, $end));
                $this->model->msg = "<span class='msg'>User is banned till $end.</span>";
            }
    }

    private function unban() {
        if (isset($_POST['unbanUser'])) {
            $userId = (int)sanitizeString($_POST['id']);
            $ban = BanDAO::selectCurrentByUserId($userId);
            if (!$ban->getIdBan()) {
                $this->model->error = "<span class='error'>User isn`t banned.</span>";
            } else {
                $endDate = new Datetime(date("Y-m-d H:i:s", time()));
                $end = $endDate->format("Y-m-d H:i:s");
                $ban->setBanEnd($end);
                BAnDAO::update($ban);
                $this->model->msg = "<span class='msg'>User is unbanned.</span>";
            }
        }
    }

}