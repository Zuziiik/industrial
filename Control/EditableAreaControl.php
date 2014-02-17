<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';

class EditableAreaControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        if (isset($_GET['item'])) {
            $itemId = (int) sanitizeString($_GET['item']);
            $this->model->item = ItemDAO::selectById($itemId);
            if (isset($_POST['areaId'])) {
                $areaId = (int) sanitizeString($_POST['areaId']);
                $this->model->area = EditableAreaDAO::selectById($areaId);
//                if(isset($_POST['action']) && sanitizeString($_POST['action'])=="edit"){
//                    $this->editArea($areaId);
//                }
                
            }
        }
    }

    private function editArea($areaId) {
        if (isset($_POST['editArea'])) {
            $title = sanitizeString($_POST['title']);
            $text = sanitizeString($_POST['text']);
            $area = EditableAreaDAO::selectById($areaId);
            $area->setTitle($title);
            $area->setText($text);
            $this->model->msg = "Title updated to " . $title . "</br>Text updated to " . $text;
            EditableAreaDAO::update($area);
        }
    }

}
