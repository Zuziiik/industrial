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
            if (isset($_POST['action']) && $_POST['action'] == 'replyComment') {
                $this->model->reply = TRUE;
				$this->model->path = sanitizeString($_POST['path']);
                $this->model->title = sanitizeString($_POST['title']);
                $this->model->commentType = sanitizeString($_POST['type']);
                $this->model->commentId = sanitizeString($_POST['commentId']);
                $this->reply($userId);
            }
            if (isset($_POST['action']) && $_POST['action'] == 'editComment') {
                $this->model->edit = TRUE;
				$this->model->path = sanitizeString($_POST['path']);
                $this->model->title = sanitizeString($_POST['title']);
                $this->model->commentId = (int)sanitizeString($_POST['commentId']);
                $this->model->message = sanitizeString($_POST['message']);
                $this->edit($this->model->commentId);
            }
            if (isset($_POST['action']) && $_POST['action'] == 'addComment') {
                $this->model->add = TRUE;
				$this->model->path = sanitizeString($_POST['path']);
                $this->model->commentType = (int)sanitizeString($_POST['type']);
                $this->model->targetId = (int)sanitizeString($_POST['targetId']);
                $this->comment();
            }
        }else{
			$this->model->error = "<span class='error'>You're banned or not logged in.</span>";
		}
    }

    private function comment() {
        if (isset($_POST['save'])) {
            global $username;
            $user = UserDAO::selectByName($username);
            $userId = $user->getIdUser();
            $type = (int)sanitizeString($_POST['type']);
            $title = sanitizeString($_POST['title']);
            $message = sanitizeString($_POST['message']);
            $targetId = (int)sanitizeString($_POST['targetId']);
            $comment = new Comment(666, $userId, $targetId, $type, $title, $message);
            CommentDAO::insert($comment);
            $this->model->add = FALSE;
			echo("<script>window.history.go(-2);</script>");
        }
    }

    private function reply($userId) {
        if (isset($_POST['save'])) {
            $type = sanitizeString($_POST['type']);
            $targetId = sanitizeString($_POST['commentId']);
            $title = sanitizeString($_POST['title']);
            $title = "RE:" . $title;
            $message = sanitizeString($_POST['message']);
            $comment = new Comment(666, $userId, $targetId, $type, $title, $message);
            CommentDAO::insert($comment);
            $this->model->reply = FALSE;
			echo("<script>window.history.go(-2);</script>");
        }
    }

    private function edit($commentId) {
        if (isset($_POST['save'])) {
            $title = sanitizeString($_POST['title']);
            $message = sanitizeString($_POST['message']);
            $comment = CommentDAO::selectById($commentId);
            $comment->setTitle($title);
            $comment->setMessage($message);
            CommentDAO::update($comment);
            $this->model->edit = FALSE;
			echo("<script>window.history.go(-2);</script>");
        }
    }

}
