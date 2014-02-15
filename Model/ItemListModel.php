<?php

class ItemListModel {

    public $error;
    public $categories;

    function __construct() {
        $this->error = '';
        $this->categories = array();
    }

}
