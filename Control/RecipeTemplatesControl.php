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

        } else {
            $this->model->error = "<span class='error'>You're not logged in, or don`t have permissions for this.</span>";
        }
    }

}