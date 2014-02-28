<?php

include_once 'View.php';

class TutorialListView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Tutorials");
    }

    public function printBody() {
        foreach ($this->model->tutorials as $tutorial) {
            $title = $tutorial->getTitle();
            $message = $tutorial->getMessage();
            $message = substr($message, 0, 300);
            $id = (int)$tutorial->getIdEditableArea();
            echo("<span class='tutorialTitle'><h2>$title</h2></span>");
            echo("<span class='tutorialMessage'>$message");
            echo(" <a href='./index.php?page=tutorial&id=$id'>More...</a> </span>");
        }
    }

    public function printPageHeader() {
        echo("Tutorials");
    }

}