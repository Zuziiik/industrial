<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/ItemDAO.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class ItemControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        if (isset($_GET['item'])) {
            $id = (int) sanitizeString($_GET['item']);
            echo ("ID: ".$id);
            if (ItemDAO::exists($id)) {
                $this->exists($id);
            } else {
                die();
                header('Location: ./index.php?page=404');
            }
        }
    }

    private function exists($id) {
        if (isset($_POST['action'])) {
            $this->delete();
        }
        $this->model->item = ItemDAO::selectById($id);
        $this->model->editArea = EditableAreaDAO::selectByItemId($id);
    }

    private function delete() {
        if(isset($_POST['areaId'])){
            $areaId=  (int)sanitizeString($_POST['areaId']);
            $area = EditableAreaDAO::selectById($areaId);
            EditableAreaDAO::delete($area);
            $this->model->msg = "Textarea deleted.";
        }
    }

}
