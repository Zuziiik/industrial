<?php

class ItemFormModel {

    public $item;
    public $area;
    public $error;
    public $addItem;
    public $addArea;
    public $categoryName;

    function __construct() {
        $this->area = NULL;
        $this->item = NULL;
        $this->error = '';
    }

}
