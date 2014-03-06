<?php

include_once 'View.php';

class RecipeTemplatesView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Recipe Templates");
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            ?>
            <form name='addTemplate' method='post' action='./index.php?page=templateForm'>
                <input type='hidden' name='action' value='addTemplate' />
                <input type='submit' name='addTemplate' value='Add Template' />
            </form>
        <?php

        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {
        echo("Recipe Templates");
    }

}