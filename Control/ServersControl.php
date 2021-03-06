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
            if (isset($_POST['deleteServer'])) {
                $this->deleteServer();
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



    private function deleteComment($id) {

        $comments = CommentDAO::selectByTypeAndTarget(Comment::RE, $id);
        foreach ($comments as $comment) {
            CommentDAO::delete($comment);
        }
        $server = CommentDAO::selectById($id);
        CommentDAO::delete($server);
    }

}