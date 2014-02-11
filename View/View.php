<?php

abstract class View {

    protected $model;

    function __construct($model) {
        $this->model = $model;
    }

    public abstract function initialize();

    public abstract function printTitle();

    public abstract function printBody();
    
    public abstract function printPageHeader();
}
