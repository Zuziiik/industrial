<?php

class Item {

    /** @var int */
    protected $idItem;

    /** @var int */
    protected $categoryId;

    /** @var string */
    protected $name;

    /** @var string */
    protected $details;

    /**
     * 
     * @param int $idItem
     * @param int $categoryId
     * @param string $name
     * @param string $details
     */
    function __construct($idItem, $categoryId, $name, $details) {
        $this->idItem = $idItem;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->details = $details;
    }

    public function setIdItem($idItem) {
        $this->idItem = $idItem;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    public function getIdItem() {
        return $this->idItem;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getName() {
        return $this->name;
    }

    public function getDetails() {
        return $this->details;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDetails($details) {
        $this->details = $details;
    }

}
