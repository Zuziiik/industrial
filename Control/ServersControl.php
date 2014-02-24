<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/CommentDAO.php';
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

}