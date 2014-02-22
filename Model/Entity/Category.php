<?php

class Category {

    /** @var int */
    protected $idCategory;

    /** @var string */
    protected $name;
    
    
    /**
     * @param int $idCategory
     * @param string $name
     */
    function __construct($idCategory, $name) {
        $this->idCategory = $idCategory;
        $this->name = $name;
    }

    public function getIdCategory() {
        return (int)($this->idCategory);
    }

    public function getName() {
        return (string)($this->name);
    }

    public function setIdCategory($idCategory) {
        $this->idCategory = $idCategory;
    }

    public function setName($name) {
        $this->name = $name;
    }

}
