<?php

class EditableAreaModel {

    public $item;
    public $area;
    public $msg;
    public $addItem;
    public $addArea;
    public $categoryName;

    function __construct() {
        $this->area = NULL;
        $this->item = NULL;
        $this->msg = '';
    }

}
