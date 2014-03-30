<?php

class ItemModel {

    public $error;
    public $fail;
    public $item;
    /* @var array[EditableArea] $editArea */
    public $editArea;

    function __construct() {
        $this->error = '';
    }

}
