<?php

include_once 'View.php';

class NotFoundView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printBody() {
        echo("Page not found.");
    }

    public function printTitle() {
        echo("404 error");
    }

    public function printPageHeader() {
        echo("404 Error");
    }

}
