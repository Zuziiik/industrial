<?php

class RecipeItem {

    /** @var int */
    protected $itemId;

    /** @var int */
    protected $recipeId;

    /** @var int */
    protected $tablePos;

    /**
     * 
     * @param int $itemId
     * @param int $recipeId
     * @param int $tablePos
     */
    function __construct($itemId, $recipeId, $tablePos) {
        $this->itemId = $itemId;
        $this->recipeId = $recipeId;
        $this->tablePos = $tablePos;
    }

    public function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    public function setRecipeId($recipeId) {
        $this->recipeId = $recipeId;
    }

    public function getItemId() {
        return $this->itemId;
    }

    public function getRecipeId() {
        return $this->recipeId;
    }

    public function getTablePos() {
        return $this->tablePos;
    }

    public function setTablePos($tablePos) {
        $this->tablePos = $tablePos;
    }

}
