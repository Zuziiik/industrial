<?php

class EditableArea {

    const ITEM = 1;
    const NEWS = 2;
    const SERVER = 3;
    const TUTORIAL = 4;
	const LINK = 5;
	const RESOURCE_PACK = 6;

    /** @var int */
    protected $idEditableArea;

    /** @var int */
    protected $targetId;

    /** @var int */
    protected $editableAreaType;

    /** @var string */
    protected $date;

    /** @var string */
    protected $title;

    /** @var string */
    protected $message;

    /** @var int */
    protected $weight;

    /**
     * @param int    $idEditableArea
     * @param int    $targetId
     * @param int    $editableAreaType
     * @param string $date
     * @param string $title
     * @param string $message
     * @param int    $weight
     */
    function __construct($idEditableArea, $targetId, $editableAreaType, $date, $title, $message, $weight) {
        $this->idEditableArea = $idEditableArea;
        $this->targetId = $targetId;
        $this->editableAreaType = $editableAreaType;
        $this->date = $date;
        $this->message = $message;
        $this->title = $title;
        $this->weight = $weight;
    }

    /**
     * @param string $date
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param int $editableAreaType
     */
    public function setEditableAreaType($editableAreaType) {
        $this->editableAreaType = $editableAreaType;
    }

    /**
     * @return int
     */
    public function getEditableAreaType() {
        return $this->editableAreaType;
    }

    /**
     * @param int $idEditableArea
     */
    public function setIdEditableArea($idEditableArea) {
        $this->idEditableArea = $idEditableArea;
    }

    /**
     * @return int
     */
    public function getIdEditableArea() {
        return $this->idEditableArea;
    }

    /**
     * @param string $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @param int $targetId
     */
    public function setTargetId($targetId) {
        $this->targetId = $targetId;
    }

    /**
     * @return int
     */
    public function getTargetId() {
        return $this->targetId;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param int $weight
     */
    public function setWeight($weight) {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getWeight() {
        return $this->weight;
    }

}
