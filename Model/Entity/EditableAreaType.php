<?php

class EditableAreaType {

    /** @var int */
    protected $idEditableAreaType;

    /** @var string */
    protected $name;

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
