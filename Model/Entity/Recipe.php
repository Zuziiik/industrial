<?php

class Recipe {

    /** @var int */
    protected $idRecipe;

    /** @var int */
    protected $itemId;

    /** @var string */
    protected $type;

    /** @var string */
    protected $uotput;

    /**
     * @param int    $idRecipe
     * @param int    $itemId
     * @param string $type
     * @param string $uotput
     */
    function __construct($idRecipe, $itemId, $type, $uotput) {
        $this->idRecipe = $idRecipe;
        $this->itemId = $itemId;
        $this->type = $type;
        $this->uotput = $uotput;
    }

    /**
     * @param $idRecipe
     */
    public function setIdRecipe($idRecipe) {
        $this->idRecipe = $idRecipe;
    }

    /**
     * @param $itemId
     */
    public function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    /**
     * @return int
     */
    public function getIdRecipe() {
        return $this->idRecipe;
    }

    /**
     * @return int
     */
    public function getItemId() {
        return $this->itemId;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUotput() {
        return $this->uotput;
    }

    /**
     * @param $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @param $uotput
     */
    public function setUotput($uotput) {
        $this->uotput = $uotput;
    }

}
