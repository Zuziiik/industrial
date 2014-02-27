<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/CommentDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';
include_once dirname(__FILE__) . '/../Model/CommentModel.php';
include_once dirname(__FILE__) . '/CommentControl.php';
include_once dirname(__FILE__) . '/../View/CommentView.php';

class ServersControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        global $loggedIn;
        global $admin;
        $type = EditableArea::SERVER;
        if ($loggedIn && $admin) {
            if (isset($_POST['addServer'])) {
                $this->add($type);
            }
            if (isset($_POST['deleteServer'])) {
                $this->deleteServer();
            }
            if (isset($_POST['addComment'])) {
                $this->comment();
            }
            if (isset($_POST['deleteComment'])) {
                $id = (int)sanitizeString($_POST['commentId']);
                $this->deleteComment($id);
            }
        }
        $this->model->servers = EditableAreaDAO::selectByEditableAreaType($type);
        $i = 0;
        foreach ($this->model->servers as $server) {
            $this->model->commentModels[$i] = new CommentModel();
            $this->model->commentControls[$i] = new CommentControl($this->model->commentModels[$i]);
            $this->model->commentViews[$i] = new CommentView($this->model->commentModels[$i]);
            $this->model->commentControls[$i]->setType(Comment::SERVER);
            $this->model->commentControls[$i]->setTargetId((int)$server->getIdEditableArea());
            $this->model->commentControls[$i]->initialize();
            $i++;
        }
    }

    private function add($type) {
        $title = sanitizeString($_POST['title']);
        $message = sanitizeString($_POST['message']);
        $date = date("Y-m-d H:i:s", time());
        $weight = EditableAreaDAO::selectHighestWeight() + 1;
        $server = new EditableArea(666, NULL, $type, $date, $title, $message, $weight);
        EditableAreaDAO::insert($server);
    }

    private function deleteServer() {
        $id = (int)sanitizeString($_POST['ServerId']);
        $server = EditableAreaDAO::selectById($id);
        $comments = CommentDAO::selectByTypeAndTarget(Comment::SERVER, $id);
        foreach($comments as $comment){
            $commentId = (int)$comment->getIdComment();
            $this->deleteComment($commentId);
        }

        EditableAreaDAO::delete($server);
    }

    private function comment() {
        global $username;
        $user = UserDAO::selectByName($username);
        $userId = $user->getIdUser();
        $type = (int)sanitizeString($_POST['type']);
        $title = sanitizeString($_POST['title']);
        $message = sanitizeString($_POST['message']);
        $targetId = sanitizeString($_POST['targetId']);
        $comment = new Comment(666, $userId, $targetId, $type, $title, $message);
        CommentDAO::insert($comment);
    }

    private function deleteComment($id) {

        $comments = CommentDAO::selectByTypeAndTarget(Comment::RE, $id);
        foreach ($comments as $comment) {
            CommentDAO::delete($comment);
        }
        $server = CommentDAO::selectById($id);
        CommentDAO::delete($server);
    }

}