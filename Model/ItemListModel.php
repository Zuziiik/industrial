<?php

class ItemListModel {

    public $error;
    public $categories;
	public $fail;

    function __construct() {
        $this->error = '';
        $this->categories = array();
    }

}
