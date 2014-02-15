<?php

class EditableArea {

    /** @var int */
    protected $idEditableArea;

    /** @var int */
    protected $editableAreaTypeId;

    /** @var int */
    protected $itemId;

    /** @var int */
    protected $archivedItemId;

    /** @var string */
    protected $date;

    /** @var string */
    protected $text;

    /** @var string */
    protected $title;

    /** @var boolean */
    protected $locked;

    /** @var int */
    protected $weight;

    /**
     * 
     * @param int $idEditableArea
     * @param int $editableAreaTypeId
     * @param int $itemId
     * @param int $archivedItemId
     * @param string $date
     * @param string $text
     * @param string $title
     * @param boolean $locked
     * @param int $weight
     */
    function __construct($idEditableArea, $editableAreaTypeId, $itemId, $archivedItemId, $date, $text, $title, $locked, $weight) {
        $this->idEditableArea = $idEditableArea;
        $this->editableAreaTypeId = $editableAreaTypeId;
        $this->itemId = $itemId;
        $this->archivedItemId = $archivedItemId;
        $this->date = $date;
        $this->text = $text;
        $this->title = $title;
        $this->locked = $locked;
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

    public function setArchivedItemId($archivedItemId) {
        $this->archivedItemId = $archivedItemId;
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

    public function getArchivedItemId() {
        return $this->archivedItemId;
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

    public function getLocked() {
        return $this->locked;
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

    public function setLocked($locked) {
        $this->locked = $locked;
    }

}
