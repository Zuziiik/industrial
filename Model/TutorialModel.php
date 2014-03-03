<?php

class TutorialModel {

    public $tutorial;
    public $edit;
    public $commentModel;
    public $commentControl;
    public $commentView;

    function __construct() {
        $this->edit = FALSE;
        $this->tutorial = NULL;
        $this->commentModel = NULL;
        $this->commentControl = NULL;
        $this->commentView = NULL;
    }
}