<?php

class Recipe {

    /** @var int */
    protected $idRecipe;

    /** @var int */
    protected $itemId;

    /** @var string */
    protected $recipeTemplateId;

    /**
     * @param int    $idRecipe
     * @param int    $itemId
     * @param string $type
     */
    function __construct($idRecipe, $itemId, $recipeTemplateId) {
        $this->idRecipe = $idRecipe;
        $this->itemId = $itemId;
        $this->recipeTemplateId = $recipeTemplateId;
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
     * @param $type
     */
    public function setRecipeTemplateId($recipeTemplateId) {
        $this->recipeTemplateId = $recipeTemplateId;
    }

}
