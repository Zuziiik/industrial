<?php

class Recipe {

    /** @var int */
    protected $idRecipe;

    /** @var int */
    protected $itemId;

    /** @var int */
    protected $archivedItemId;

    /** @var string */
    protected $type;

    /** @var string */
    protected $uotput;

    /**
     * 
     * @param int $idRecipe
     * @param int $itemId
     * @param int $archivedItemId
     * @param string $type
     * @param string $uotput
     */
    function __construct($idRecipe, $itemId, $archivedItemId, $type, $uotput) {
        $this->idRecipe = $idRecipe;
        $this->itemId = $itemId;
        $this->archivedItemId = $archivedItemId;
        $this->type = $type;
        $this->uotput = $uotput;
    }

    public function setIdRecipe($idRecipe) {
        $this->idRecipe = $idRecipe;
    }

    public function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    public function setArchivedItemId($archivedItemId) {
        $this->archivedItemId = $archivedItemId;
    }

    public function getIdRecipe() {
        return $this->idRecipe;
    }

    public function getItemId() {
        return $this->itemId;
    }

    public function getArchivedItemId() {
        return $this->archivedItemId;
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
