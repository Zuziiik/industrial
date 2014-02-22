<?php

class ItemModel {

    public $error;
    public $msg;
    public $item;
    /* @var array[EditableArea] $editArea */
    public $editArea;

    function __construct() {
        $this->error = '';
        $this->msg = '';
    }

}
