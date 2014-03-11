<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class NewsFormControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        $this->model->edit = FALSE;
        $this->model->add = FALSE;
        if(isset($_POST['action']) && $_POST['action']=='addNews'){
            $this->model->add = TRUE;
            $this->add();
        }
        if(isset($_POST['action']) && $_POST['action']=='editNews'){
            $this->model->edit = TRUE;
            $id = (int)sanitizeString($_POST['id']);
            $this->model->news = EditableAreaDAO::selectById($id);
            $this->edit($this->model->news, $id);
        }
    }

    private function add(){
        if(isset($_POST['save'])){
            $title = sanitizeString($_POST['title']);
            $message = sanitizeTextArea($_POST['message']);
            $date = date("Y-m-d H:i:s", time());
            $type = EditableArea::NEWS;
            $news = new EditableArea(666, NULL, $type, $date, $title, $message, NULL);
            EditableAreaDAO::insert($news);
            $this->model->add = FALSE;
            echo("<script>window.location = './index.php?page=home';</script>");
        }
    }

    private function edit($news, $id){
        if(isset($_POST['save'])){
            $title = sanitizeString($_POST['title']);
            $message = sanitizeTextArea($_POST['message']);
            $date = date("Y-m-d H:i:s", time());
            $news->setMessage($message);
            $news->setTitle($title);
            $news->setDate($date);
            EditableAreaDAO::update($news);
            $this->model->edit = FALSE;
            echo("<script>window.location = './index.php?page=news&id=$id';</script>");
        }
    }

}