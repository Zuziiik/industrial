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
     * 
     * @param int $idRecipe
     * @param int $itemId
     * @param string $type
     * @param string $uotput
     */
    function __construct($idRecipe, $itemId, $type, $uotput) {
        $this->idRecipe = $idRecipe;
        $this->itemId = $itemId;
        $this->type = $type;
        $this->uotput = $uotput;
    }

    public function setIdRecipe($idRecipe) {
        $this->idRecipe = $idRecipe;
    }

    public function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    public function getIdRecipe() {
        return $this->idRecipe;
    }

    public function getItemId() {
        return $this->itemId;
    }

    public function getType() {
        return $this->type;
    }

    public function getUotput() {
        return $this->uotput;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setUotput($uotput) {
        $this->uotput = $uotput;
    }

}
