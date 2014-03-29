<?php

class RecipeTemplate {

    /** @var int */
    protected $IdRecipeTemplate;

    /** @var string */
    protected $name;

    /** @var array[int] */
    protected $positions;

    /** @var string */
    protected $imageName;

    /**
     * @param int    $IdRecipeTemplate
     * @param string $name
     * @param array  $positions
     */
    function __construct($IdRecipeTemplate, $name, $positions, $imageName) {
        $this->IdRecipeTemplate = $IdRecipeTemplate;
        $this->name = $name;
        $this->positions = $positions;
        $this->imageName = $imageName;
    }

    /**
     * @param int $IdRecipeTemplate
     */
    public function setIdRecipeTemplate($IdRecipeTemplate) {
        $this->IdRecipeTemplate = $IdRecipeTemplate;
    }

    /**
     * @return int
     */
    public function getIdRecipeTemplate() {
        return $this->IdRecipeTemplate;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName) {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName() {
        return $this->imageName;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param array $positions
     */
    public function setPositions($positions) {
        $this->positions = $positions;
    }

    /**
     * @return array
     */
    public function getPositions() {
        return $this->positions;
    }

}