<?php

class RecipeItem {

    /** @var int */
    protected $itemId;

    /** @var int */
    protected $recipeId;

    /** @var int */
    protected $tablePos;

    function __construct($itemId, $recipeId, $tablePos) {
        $this->itemId = $itemId;
        $this->recipeId = $recipeId;
        $this->tablePos = $tablePos;
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
