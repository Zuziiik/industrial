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
        
    }

    public function printPageHeader() {
        $title = $this->model->tutorial->getTitle();
        echo($title);
    }

}