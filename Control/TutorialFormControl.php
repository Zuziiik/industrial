<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class TutorialFormControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        global $loggedIn;
        global $admin;
        if ($admin && $loggedIn) {
            $this->model->edit = FALSE;
            $this->model->add = FALSE;
            if (isset($_GET['id'])) {
                $id = (int)sanitizeString($_GET['id']);
                if (EditableAreaDAO::editableAreaExists($id)) {
                    $this->edit($id);
                } else {
                    header('Location: ./index.php?page=404');
                }
            }
            if (isset($_POST['action']) && $_POST['action'] == 'addTutorial') {
                $this->add();
            }
        } else {
            $this->model->error = "<span class='error'>You are not logged in or you must be admin to add/edit.</span>";
        }

    }

    private function edit($id) {
        $this->model->edit = TRUE;
        $this->model->tutorial = EditableAreaDAO::selectById($id);
        if (isset($_POST['save'])) {
            $title = sanitizeString($_POST['title']);
            $message = sanitizeTextArea($_POST['text']);
            var_dump($message);
            $text = $_POST['text'];
            var_dump($text);
            $date = date("Y-m-d H:i:s", time());
            $this->model->tutorial->setDate($date);
            $this->model->tutorial->setMessage($message);
            $this->model->tutorial->setTitle($title);
            EditableAreaDAO::update($this->model->tutorial);
            $this->model->edit = FALSE;
            echo("<script>window.location = './index.php?page=tutorialList';</script>");
        }
    }

    private function add() {
        $this->model->add = TRUE;
        if (isset($_POST['save'])) {
            $type = EditableArea::TUTORIAL;
            $title = sanitizeString($_POST['title']);
            $message = sanitizeTextArea($_POST['text']);
            $date = date("Y-m-d H:i:s", time());
            $weight = EditableAreaDAO::selectHighestWeight() + 1;
            $tutorial = new EditableArea(666, NULL, $type, $date, $title, $message, $weight);
            EditableAreaDAO::insert($tutorial);
            $this->model->add = FALSE;
            echo("<script>window.location = './index.php?page=tutorialList';</script>");
        }
    }

}