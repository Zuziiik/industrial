<?php

class NewsFormModel {

    public $add;
    public $edit;
    public $news;
	public $error;

    function __construct() {
        $this->add = FALSE;
        $this->edit = FALSE;
    }
}