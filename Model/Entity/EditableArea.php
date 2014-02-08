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
