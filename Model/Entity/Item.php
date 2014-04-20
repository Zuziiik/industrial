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

    /** @var boolean */
    protected $industrial;

    /** @var string */
    protected $link;

    /**
     * @param int     $idItem
     * @param int     $categoryId
     * @param string  $name
     * @param string  $details
     * @param boolean $industrial
     */
    function __construct($idItem, $categoryId, $name, $details, $industrial, $link) {
        $this->idItem = $idItem;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->details = $details;
        $this->industrial = $industrial;
        $this->link = $link;
    }

    /**
     * @param string $link
     */
    public function setLink($link) {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * @param boolean $industrial
     */
    public function setIndustrial($industrial) {
        $this->industrial = $industrial;
    }

    /**
     * @return boolean
     */
    public function getIndustrial() {
        return $this->industrial;
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
