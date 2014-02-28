<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/CommentDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';
include_once dirname(__FILE__) . '/../Model/CommentModel.php';
include_once dirname(__FILE__) . '/CommentControl.php';
include_once dirname(__FILE__) . '/../View/CommentView.php';

class TutorialControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        if(isset($_GET['id'])){
            $id =(int) sanitizeString($_GET['id']);
            if(EditableAreaDAO::editableAreaExists($id)){
                $this->exists($id);
            }else{
                header('Location: ./index.php?page=404');
            }
        }
    }

    private function exists($id){
        $this->model->tutorial = EditableAreaDAO::selectById($id);
    }

}