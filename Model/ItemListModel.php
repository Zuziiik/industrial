<?php

class ItemListModel {

    public $error;
    public $msg;
    public $categories;

    function __construct() {
        $this->msg = '';
        $this->error = '';
        $this->categories = array();
    }

}
