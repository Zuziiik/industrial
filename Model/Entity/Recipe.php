<?php

class Recipe {

    /** @var int */
    protected $idRecipe;

    /** @var int */
    protected $itemId;

    /** @var string */
    protected $recipeTemplateId;

    /** @var string */
    protected $uotput;

    /**
     * @param int    $idRecipe
     * @param int    $itemId
     * @param string $type
     * @param string $uotput
     */
    function __construct($idRecipe, $itemId, $recipeTemplateId, $uotput) {
        $this->idRecipe = $idRecipe;
        $this->itemId = $itemId;
        $this->recipeTemplateId = $recipeTemplateId;
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
    public function getRecipeTemplateId() {
        return $this->recipeTemplateId;
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
    public function setRecipeTemplateId($recipeTemplateId) {
        $this->recipeTemplateId = $recipeTemplateId;
    }

    /**
     * @param $uotput
     */
    public function setUotput($uotput) {
        $this->uotput = $uotput;
    }

}
