<?php

include_once dirname(__FILE__) . '/../Entity/Recipe.php';
include_once dirname(__FILE__) . '/../../db.php';

class RecipeDAO {

    public static function insert(Recipe $recipe) {
        $a = $recipe->getItemId();
        $b = $recipe->getRecipeTemplateId();
        queryMysql("INSERT INTO recipe (item_id, recipe_template_id)" . "VALUES ('$a', '$b')");
        $recipe->setIdRecipe(lastId());
        return $recipe->getIdRecipe();
    }

    public static function update(Recipe $recipe) {
        $a = $recipe->getItemId();
        $b = $recipe->getRecipeTemplateId();
        $id = $recipe->getIdRecipe();
        queryMysql("UPDATE recipe SET item_id='$a', recipe_template_id='$b' " . "WHERE id_recipe='$id'");
    }

    public static function delete(Recipe $recipe) {
        $id = $recipe->getIdRecipe();
        queryMysql("DELETE FROM recipe WHERE id_recipe='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isn`t instance of int.');
        }
        $row = rowQueryMysql("SELECT id_recipe, item_id, recipe_template_id FROM recipe WHERE id_recipe='$id'");
        $recipe = new Recipe($row['0'], $row['1'], $row['2']);
        return $recipe;
    }

    public static function selectByItemId($id) {
        if (!is_int($id)) {
            die('Argument passed isn`t instance of int.');
        }
        $result = queryMysql("SELECT id_recipe, item_id, recipe_template_id FROM recipe WHERE item_id='$id'");
        $n = mysql_num_rows($result);
        $recipes = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $recipe = new Recipe($row['0'], $row['1'], $row['2']);
            $recipes[$i] = $recipe;
        }
        return $recipes;
    }

	public static function selectByTemplateId($id) {
		if (!is_int($id)) {
			die('Argument passed isn`t instance of int.');
		}
		$result = queryMysql("SELECT id_recipe, item_id, recipe_template_id FROM recipe WHERE recipe_template_id='$id'");
		$n = mysql_num_rows($result);
		$recipes = array();
		for ($i = 0; $i < $n; ++$i) {
			$row = mysql_fetch_row($result);
			$recipe = new Recipe($row['0'], $row['1'], $row['2']);
			$recipes[$i] = $recipe;
		}
		return $recipes;
	}

    public static function selectAll() {
        $result = queryMysql("SELECT id_recipe, item_id, recipe_template_id FROM recipe");
        $n = mysql_num_rows($result);
        $recipes = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $recipe = new Recipe($row['0'], $row['1'], $row['2']);
            $recipes[$i] = $recipe;
        }
        return $recipes;
    }

}
