<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeTemplateDAO.php';

class RecipeTemplatesControl extends Control {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            if (isset($_POST['action']) && $_POST['action'] == 'deleteTemplate') {
                $this->delete();
            }
            $this->model->templates = RecipeTemplateDAO::selectAll();
        } else {
            $this->model->error = "<span class='error'>You're not logged in, or don`t have permissions for this.</span>";
        }
    }

    private function delete() {
        if (isset($_POST['deleteTemplate'])) {
            $id = (int)sanitizeString($_POST['id']);
            $template = RecipeTemplateDAO::selectById($id);
            RecipeTemplateDAO::delete($template);
        }
    }

}