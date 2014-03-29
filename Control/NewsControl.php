<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/CommentDAO.php';

class NewsControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        $id = (int)sanitizeString($_GET['id']);
        $this->model->news = EditableAreaDAO::selectById($id);
    }

}