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
     * @param int    $idItem
     * @param int    $categoryId
     * @param string $name
     * @param string $details
     */
    function __construct($idItem, $categoryId, $name, $details) {
        $this->idItem = $idItem;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->details = $details;
    }

    /**
     * @param $idItem
     */
    public function setIdItem($idItem) {
        $this->idItem = $idItem;
    }

    /**
     * @param $categoryId
     */
    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    /**
     * @return int
     */
    public function getIdItem() {
        return $this->idItem;
    }

    /**
     * @return int
     */
    public function getCategoryId() {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDetails() {
        return $this->details;
    }

    /**
     * @param $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param $details
     */
    public function setDetails($details) {
        $this->details = $details;
    }

}
