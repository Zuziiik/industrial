<?php

abstract class Control {
    
    protected $model;
            
    function __construct($model) {
        $this->model=$model;
    }

        public abstract function initialize();
}
