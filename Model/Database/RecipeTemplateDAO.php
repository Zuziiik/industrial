<?php

include_once dirname(__FILE__) . '/../Entity/RecipeTemplate.php';
include_once dirname(__FILE__) . '/../../db.php';

class RecipeTemplateDAO {

    public static function insert(RecipeTemplate $recipeTemplate) {
        $a = $recipeTemplate->getName();
        $b = $recipeTemplate->getPositions();
        $c = $recipeTemplate->getImageName();
        queryMysql("INSERT INTO recipe_template (recipe_name, positions, image_name)" . "VALUES ('$a', '$b', '$c')");
        $recipeTemplate->setIdRecipeTemplate(lastId());
    }

    public static function update(RecipeTemplate $recipeTemplate) {
        $a = $recipeTemplate->getName();
        $b = $recipeTemplate->getPositions();
        $c = $recipeTemplate->getImageName();
        $id = $recipeTemplate->getIdRecipeTemplate();
        queryMysql("UPDATE recipe_template SET recipe_name='$a', positions='$b', image_name='$c'" . "WHERE id_recipe_template='$id'");
    }

    public static function delete(RecipeTemplate $recipeTemplate) {
        $id = $recipeTemplate->getIdRecipeTemplate();
        queryMysql("DELETE FROM recipe_template WHERE id_recipe_template='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isn`t instance of int.');
        }
        $row = rowQueryMysql("SELECT id_recipe_template, recipe_name, positions, image_name FROM recipe_template WHERE id_recipe_template='$id'");
        $recipeTemplate = new RecipeTemplate($row['0'], $row['1'], $row['2'], $row['3']);
        return $recipeTemplate;
    }

    public static function selectAll() {
        $result = queryMysql("SELECT id_recipe_template, recipe_name, positions, image_name FROM recipe_template");
        $n = mysql_num_rows($result);
        $recipeTemplates = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $recipeTemplate = new RecipeTemplate($row['0'], $row['1'], $row['2'], $row['3']);
            $recipeTemplates[$i] = $recipeTemplate;
        }
        return $recipeTemplates;
    }

} 