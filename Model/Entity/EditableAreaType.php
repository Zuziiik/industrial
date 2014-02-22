<?php

class EditableAreaType {

    /** @var int */
    protected $idEditableAreaType;

    /** @var string */
    protected $name;

    /**
     * 
     * @param int $idEditableAreaType
     * @param string $name
     */
    function __construct($idEditableAreaType, $name) {
        $this->idEditableAreaType = $idEditableAreaType;
        $this->name = $name;
    }

    public function setIdEditableAreaType($idEditableAreaType) {
        $this->idEditableAreaType = $idEditableAreaType;
    }

    public function getIdEditableAreaType() {
        return $this->idEditableAreaType;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

}
