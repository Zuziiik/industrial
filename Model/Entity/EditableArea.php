<?php

class EditableArea {

    /** @var int */
    protected $idEditableArea;

    /** @var int */
    protected $editableAreaTypeId;

    /** @var int */
    protected $itemId;


    /** @var string */
    protected $date;

    /** @var string */
    protected $text;

    /** @var string */
    protected $title;

    /** @var int */
    protected $weight;

    /**
     * 
     * @param int $idEditableArea
     * @param int $editableAreaTypeId
     * @param int $itemId
     * @param string $date     
     * @param string $title
     * @param string $text
     * @param int $weight
     */
    function __construct($idEditableArea, $editableAreaTypeId, $itemId, $date, $title, $text, $weight) {
        $this->idEditableArea = $idEditableArea;
        $this->editableAreaTypeId = $editableAreaTypeId;
        $this->itemId = $itemId;
        $this->date = $date;
        $this->text = $text;
        $this->title = $title;
        $this->weight = $weight;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function setIdEditableArea($idEditableArea) {
        $this->idEditableArea = $idEditableArea;
    }

    public function setAreaEditByUserId($editableAreaTypeId) {
        $this->editableAreaTypeId = $editableAreaTypeId;
    }

    public function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    public function getIdEditableArea() {
        return $this->idEditableArea;
    }

    public function getEditableAreaTypeId() {
        return $this->editableAreaTypeId;
    }

    public function getItemId() {
        return $this->itemId;
    }

    public function getDate() {
        return $this->date;
    }

    public function getText() {
        return $this->text;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

}
