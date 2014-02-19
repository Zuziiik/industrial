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
            echo ("ID: " . $id);
            if (ItemDAO::exists($id)) {
                $this->exists($id);
            } else {
                die();
                header('Location: ./index.php?page=404');
            }
        }
    }

    private function exists($id) {
        if (isset($_POST['action']) && $_POST['action'] == 'delete') {
            $this->delete();
        }
        if (isset($_POST['action']) && $_POST['action'] == 'moveUp') {
            $this->move($id, "up");
        }
        if (isset($_POST['action']) && $_POST['action'] == 'moveDown') {
            $this->move($id, "down");
        }
        $this->model->item = ItemDAO::selectById($id);
        $this->model->editArea = EditableAreaDAO::selectByItemId($id);
    }

    private function delete() {
        if (isset($_POST['areaId'])) {
            $areaId = (int) sanitizeString($_POST['areaId']);
            $area = EditableAreaDAO::selectById($areaId);
            EditableAreaDAO::delete($area);
            $this->model->msg = "Textarea deleted.";
        }
    }

    private function move($itemId, $dir) {
        if (isset($_POST['areaId'])) {
            $areaId = (int) sanitizeString($_POST['areaId']);
            $areas = EditableAreaDAO::selectByItemId($itemId);
            $area = EditableAreaDAO::selectById($areaId);
            $weight = $area->getWeight();
            $pos = $this->getPosition($areas, $areaId);
            $n = count($areas);
            if ($dir === "up" && $pos > 0) {
                $temp = $areas[$pos - 1]->getWeight();
                $areas[$pos - 1]->setWeight($weight);
                $areas[$pos]->setWeight($temp);
                EditableAreaDAO::update($areas[$pos - 1]);
                EditableAreaDAO::update($areas[$pos]);
            }
            if ($dir === "down" && $pos < $n - 1) {
                $temp = $areas[$pos + 1]->getWeight();
                $areas[$pos + 1]->setWeight($weight);
                $areas[$pos]->setWeight($temp);
                EditableAreaDAO::update($areas[$pos + 1]);
                EditableAreaDAO::update($areas[$pos]);
            }
        }
    }

    private function getPosition($areas, $areaId) {
        $i = 0;
        foreach ($areas as $a) {
            if ($a->getIdEditableArea() == $areaId) {
                break;
            }
            $i++;
        }
        return $i;
    }

}
