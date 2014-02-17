<?php

class EditableAreaModel {

    public $item;
    public $area;
    public $areas;
    public $msg;

    function __construct() {
        $this->area = NULL;
        $this->areas = array();
        $this->msg = '';
    }

}
