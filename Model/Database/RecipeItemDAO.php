<?php

include_once dirname(__FILE__) . '/../Entity/RecipeItem.php';
include_once dirname(__FILE__) . '/../../db.php';

class RecipeItemDAO {

    public static function insert(RecipeItem $recipeItem) {
        $a = $recipeItem->getRecipeId();
        $b = $recipeItem->getItemId();
        $c = $recipeItem->getTablePos();
        queryMysql("INSERT INTO recipe_item (recipe_id_recipe, item_item_id, table_pos)"
                . "VALUES ('$a', '$b', '$c')");
    }

    public static function update(RecipeItem $recipeItem) {
        $a = $recipeItem->getRecipeId();
        $b = $recipeItem->getItemId();
        $c = $recipeItem->getTablePos();
        queryMysql("UPDATE recipe_item SET table_pos='$c'"
                . "WHERE recipe_id_recipe='$a' AND item_item_id='$b'");
    }

    public static function delete(RecipeItem $recipeItem) {
        $id1 = $recipeItem->getRecipeId();
        $id2 = $recipeItem->getItemId();
         $c = $recipeItem->getTablePos();
        queryMysql("DELETE FROM recipe_item WHERE recipe_id_recipe='$id1' AND item_item_id='$id2' AND table_pos='$c'");
    }

    public static function selectByIds($id1, $id2) {
        if ((!is_int($id1)) || (!is_int($id2))) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM recipe_item WHERE item_item_id='$id1' AND recipe_id_recipe='$id2'");
        $recipeItem = new RecipeItem($row['0'], $row['1'], $row['2']);
        return $recipeItem;
    }

    public static function selectAll() {
        $result = queryMysql("SELECT * FROM recipe_item");
        $n = mysql_num_rows($result);
        $recipeItems = array();
        for ($i = 0; $i < $n;  ++$i) {
            $row = mysql_fetch_row($result);
            $recipeItem = new RecipeItem($row['0'], $row['1'], $row['2']);
            $recipeItems[$i] = $recipeItem;
        }
        return $recipeItems;
    }

}
