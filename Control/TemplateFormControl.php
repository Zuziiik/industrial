<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeTemplateDAO.php';

class TemplateFormControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            $this->model->add = FALSE;
            $this->model->edit = FALSE;
            $this->model->submitted = FALSE;
            $this->model->selectedImage = FALSE;
            $this->model->loaded = FALSE;
            if (isset($_POST['action']) && $_POST['action'] == 'addTemplate') {
                $this->model->add = TRUE;
                $this->loadImage();
            }
            if (isset($_POST['action']) && $_POST['action'] == 'submitPositions') {
                $this->model->add = TRUE;
                $this->model->selectedImage = TRUE;
                $this->loadPositions();
            }

        } else {
            $this->model->error = "<span class='error'>You're not logged in, or don`t have permissions for this.</span>";
        }
    }

    private function loadImage() {

        if (isset($_POST['submitPicture'])) {
            if (!empty($_FILES['image']['name'])) {
                $this->model->selectedImage = TRUE;
                $name = $text = substr(md5(uniqid(rand(), TRUE)), 0, 25) . ".png";

                $allowedExts = array("gif", "jpeg", "jpg", "png");
                $temp = explode(".", $_FILES["image"]["name"]);
                $extension = end($temp);
                if ((($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/pjpeg") || ($_FILES["image"]["type"] == "image/x-png") || ($_FILES["image"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
                    if (!($_FILES["image"]["error"] > 0)) {
                        move_uploaded_file($_FILES["image"]["tmp_name"], "pictures/templates/" . $_FILES["image"]["name"]);
                        rename("pictures/templates/" . $_FILES["image"]["name"], "pictures/templates/" . $name);
                        $this->model->imageName = $name;
                        $this->model->loaded = TRUE;
                    }
                } else {
                    $this->model->error = "<span class='error'>File's invalid.</span>";
                }

            } else {
                $this->model->selectedImage = FALSE;
                $this->model->error = "<span class='error'>No image selected.</span>";
            }
        }
    }

    private function loadPositions() {

        if (isset($_POST['submitPositions'])) {
            $this->model->submitted = TRUE;
            $this->model->imageName = sanitizeString($_POST['imageName']);
            $this->model->name = sanitizeString($_POST['name']);
            $this->model->positions = sanitizeString($_POST['positions']);

        }
        if (isset($_POST['confirm'])) {
            $this->model->imageName = sanitizeString($_POST['imageName']);
            $cords = '';
            foreach ($_POST['cords'] as $cord) {
                $cords = $cords . ' | ' . sanitizeString($cord);
            }
            $name = sanitizeString($_POST['name']);
            $template = new RecipeTemplate(666, $name, $cords, $this->model->imageName);
            RecipeTemplateDAO::insert($template);
            echo("<script>window.location = './index.php?page=recipeTemplates';</script>");
        }
    }

}