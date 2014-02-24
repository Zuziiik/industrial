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

    /**
     * @return int
     */
    public function getIdCategory() {
        return (int)($this->idCategory);
    }

    /**
     * @return string
     */
    public function getName() {
        return (string)($this->name);
    }

    /**
     * @param $idCategory
     */
    public function setIdCategory($idCategory) {
        $this->idCategory = $idCategory;
    }

    /**
     * @param $name
     */
    public function setName($name) {
        $this->name = $name;
    }

}
