<?php

include_once 'Control.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/../Model/Database/EditableAreaDAO.php';

class HomeControl extends Control {
    
    function __construct($model) {
        parent::__construct($model);
    }

    
    public function initialize() {
        
    }

}
