<?php

include_once 'View.php';

class HomeView extends View {
    
    function __construct($model) {
        parent::__construct($model);
    }

    
    public function initialize() {
        
    }

    public function printBody() {
        
    }

    public function printPageHeader() {
        echo("Industrial Craft - Wiki");
    }

    public function printTitle() {
        echo("Industrial Craft - Wiki");
    }

}

