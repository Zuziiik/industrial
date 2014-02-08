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
