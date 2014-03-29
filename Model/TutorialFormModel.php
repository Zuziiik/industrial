<?php

class TutorialFormModel {

    public $edit;
    public $add;
    public $tutorial;
    public $error;

    function __construct() {
        $this->edit = FALSE;
        $this->add = FALSE;
        $this->error = '';
        $this->tutorial = NULL;
    }
}