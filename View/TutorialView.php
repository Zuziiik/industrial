<?php

include_once 'View.php';

class TutorialView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        $title = $this->model->tutorial->getTitle();
        echo($title);
    }

    public function printBody() {
        global $admin;
        global $loggedIn;

        if ($admin && $loggedIn) {
            $id = (int)$this->model->tutorial->getIdEditableArea();
            echo <<<_END
                <form id='editTutorial'  name='edit' method='post' action='./index.php?page=tutorialEdit&id=$id'>
                <input type='hidden' name='action' value='editTutorial'/>
                <input type='submit' name='editTutorial' value='Edit'/>
                </form>
_END;
        }
        $title = $this->model->tutorial->getTitle();
        $message = $this->model->tutorial->getMessage();

        echo("<span class='tutorialTitle'><h2>$title</h2></span>");
        echo("<span class='tutorialMessage'>$message</span>");

    }

    public function printPageHeader() {
        $title = $this->model->tutorial->getTitle();
        echo($title);
    }

}