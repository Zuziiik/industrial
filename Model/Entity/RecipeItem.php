<?php

class RecipeItem {

    /** @var int */
    protected $itemId;

    /** @var int */
    protected $recipeId;

    /** @var string */
    protected $tablePos;

    /**
     * @param int $itemId
     * @param int $recipeId
     * @param string $tablePos
     */
    function __construct($itemId, $recipeId, $tablePos) {
        $this->itemId = $itemId;
        $this->recipeId = $recipeId;
        $this->tablePos = $tablePos;
    }

    /**
     * @param $itemId
     */
    public function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    /**
     * @param $recipeId
     */
    public function setRecipeId($recipeId) {
        $this->recipeId = $recipeId;
    }

    /**
     * @return int
     */
    public function getItemId() {
        return $this->itemId;
    }

    /**
     * @return int
     */
    public function getRecipeId() {
        return $this->recipeId;
    }

    /**
     * @return string
     */
    public function getTablePos() {
        return $this->tablePos;
    }

    /**
     * @param $tablePos
     */
    public function setTablePos($tablePos) {
        $this->tablePos = $tablePos;
    }

}
