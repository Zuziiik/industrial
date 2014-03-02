<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class TutorialListControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        $type = EditableArea::TUTORIAL;
        if(isset($_POST['deleteTutorial'])){
            $id = (int)sanitizeString($_POST['id']);
            if(EditableAreaDAO::editableAreaExists($id)){
                $tutorial = EditableAreaDAO::selectById($id);
                EditableAreaDAO::delete($tutorial);
            }
        }
        $this->model->tutorials = EditableAreaDAO::selectByEditableAreaType($type);
    }

}