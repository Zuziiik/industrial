<?php

class TutorialModel {

    public $tutorial;
    public $edit;

    function __construct() {
        $this->edit = FALSE;
        $this->tutorial = NULL;
    }
}