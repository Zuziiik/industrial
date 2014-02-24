<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

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