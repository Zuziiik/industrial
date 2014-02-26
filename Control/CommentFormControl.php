<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/CommentDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/BanDAO.php';

class CommentFormControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        global $loggedIn;
        global $username;
        $user = UserDAO::selectByName($username);
        $userId = (int)$user->getIdUser();
        $ban = BanDAO::selectCurrentByUserId($userId);
        if ($ban->getIdBan()) {
            $this->model->banned = TRUE;
        } else {
            $this->model->banned = FALSE;
        }
        if ($loggedIn && !$this->model->banned) {
            if( isset($_POST['action']) && $_POST['action'] == 'replyComment'){
                $this->model->reply = TRUE;
                $this->model->commentType = sanitizeString($_POST['type']);
                $this->model->commentId = sanitizeString($_POST['commentId']);
                $this->reply($userId);
            }
        }
    }

    private function reply($userId){
        if(isset($_POST['save'])){
            $type = sanitizeString($_POST['type']);
            $targetId = sanitizeString($_POST['commentId']);
            $title = sanitizeString($_POST['title']);
            $message = sanitizeString($_POST['message']);
            $comment = new Comment(666, $userId, $targetId, $type, $title, $message);
            CommentDAO::insert($comment);
            echo '<a href="javascript:javascript:history.go(-2)">Go Back</a>';

        }
    }

}
