<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/CommentDAO.php';

class CommentControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function setType($type) {
        $this->model->type = $type;
    }

    public function setTargetId($targetId) {
        $this->model->targetId = $targetId;
    }

    public function initialize() {
        $this->model->comments = CommentDAO::selectByTypeAndTarget($this->model->type, $this->model->targetId);
    }

}