<?php

class TemplateFormModel {
    public $add;
    public $edit;
    public $error;
    public $selectedImage;
    public $imageName;
    public $loaded;
    public $submitted;
    public $positions;
    public $name;

    function __construct() {
        $this->error = '';
        $this->edit = FALSE;
        $this->add = FALSE;
        $this->loaded = FALSE;
        $this->selectedImage = FALSE;
        $this->imageName = '';
        $this->submitted = FALSE;
    }
}