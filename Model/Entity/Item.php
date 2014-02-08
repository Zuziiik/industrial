<?php

class Item {

    /** @var int */
    protected $idItem;

    /** @var int */
    protected $categoryId;

    /** @var string */
    protected $name;

    /** @var file */
    protected $icon;

    /** @var string */
    protected $details;

    public function getIdItem() {
        return $this->idItem;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getName() {
        return $this->name;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function getDetails() {
        return $this->details;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setIcon(file $icon) {
        $this->icon = $icon;
    }

    public function setDetails($details) {
        $this->details = $details;
    }

}
