<?php

class EditableArea {

    /** @var int */
    protected $idEditableArea;

    /** @var int */
    protected $AreaEditByUserId;

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

    function __construct($idEditableArea, $AreaEditByUserId, $itemId, $archivedItemId, $date, $text, $title, $locked) {
        $this->idEditableArea = $idEditableArea;
        $this->AreaEditByUserId = $AreaEditByUserId;
        $this->itemId = $itemId;
        $this->archivedItemId = $archivedItemId;
        $this->date = $date;
        $this->text = $text;
        $this->title = $title;
        $this->locked = $locked;
    }

    public function setIdEditableArea($idEditableArea) {
        $this->idEditableArea = $idEditableArea;
    }

    public function setAreaEditByUserId($AreaEditByUserId) {
        $this->AreaEditByUserId = $AreaEditByUserId;
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

    public function getAreaEditByUserId() {
        return $this->AreaEditByUserId;
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
