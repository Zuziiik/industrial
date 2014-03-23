<?php

include_once dirname(__FILE__) . '/../Entity/RecipeItem.php';
include_once dirname(__FILE__) . '/../../db.php';

class RecipeItemDAO {

	public static function insert(RecipeItem $recipeItem) {
		$a = $recipeItem->getRecipeId();
		$b = $recipeItem->getItemId();
		$c = $recipeItem->getTablePos();
		queryMysql("INSERT INTO recipe_item (recipe_id_recipe, item_item_id, table_pos)" . "VALUES ('$a', '$b', '$c')");
	}

	public static function update(RecipeItem $recipeItem) {
		$a = $recipeItem->getRecipeId();
		$b = $recipeItem->getItemId();
		$c = $recipeItem->getTablePos();
		queryMysql("UPDATE recipe_item SET table_pos='$c'" . "WHERE recipe_id_recipe='$a' AND item_item_id='$b'");
	}

	public static function delete(RecipeItem $recipeItem) {
		$id1 = $recipeItem->getRecipeId();
		$id2 = $recipeItem->getItemId();
		$c = $recipeItem->getTablePos();
		queryMysql("DELETE FROM recipe_item WHERE recipe_id_recipe='$id1' AND item_item_id='$id2' AND table_pos='$c'");
	}

	public static function selectByIds($itemId, $recipeId) {
		if((!is_int($itemId)) || (!is_int($recipeId))) {
			die('Argument passed isn`t instance of int.');
		}
		$row = rowQueryMysql("SELECT item_item_id, recipe_id_recipe, table_pos  FROM recipe_item WHERE item_item_id='$itemId' AND recipe_id_recipe='$recipeId'");
		$recipeItem = new RecipeItem($row['0'], $row['1'], $row['2']);
		return $recipeItem;
	}

	public static function selectByRecipeId($recipeId) {
		if(!is_int($recipeId)) {
			die('Argument passed isn`t instance of int.');
		}
		$result = queryMysql("SELECT item_item_id, recipe_id_recipe, table_pos FROM recipe_item WHERE recipe_id_recipe='$recipeId'");
		$n = mysql_num_rows($result);
		$recipeItems = array();
		for ($i = 0; $i < $n; ++$i) {
			$row = mysql_fetch_row($result);
			$recipeItem = new RecipeItem($row['0'], $row['1'], $row['2']);
			$recipeItems[$i] = $recipeItem;
		}
		return $recipeItems;
	}

	public static function selectAll() {
		$result = queryMysql("SELECT item_item_id, recipe_id_recipe, table_pos FROM recipe_item");
		$n = mysql_num_rows($result);
		$recipeItems = array();
		for ($i = 0; $i < $n; ++$i) {
			$row = mysql_fetch_row($result);
			$recipeItem = new RecipeItem($row['0'], $row['1'], $row['2']);
			$recipeItems[$i] = $recipeItem;
		}
		return $recipeItems;
	}

}
