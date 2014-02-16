<?php

include_once dirname(__FILE__) . '/../Entity/Category.php';
include_once dirname(__FILE__) . '/../../db.php';

class CategoryDAO {

    public static function insert(Category $category) {
        $a = $category->getName();
        queryMysql("INSERT INTO category (name) VALUES ('$a')");
        $category->setIdCategory(lastId());
    }

    public static function update(Category $category) {
        $a = $category->getName();
        $id = $category->getIdCategory();
        queryMysql("UPDATE category SET name='$a' WHERE id_category='$id'");
    }

    public static function delete(Category $category) {
        $id = $category->getIdCategory();
        queryMysql("DELETE FROM category WHERE id_category='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT category_id, name FROM category WHERE id_category='$id'");
        $category = new Category($row['0'], $row['1']);
        return $category;
    }

    public static function selectByName($name) {
        if (!is_string($name)) {
            die('Argument passed isnt instance of string.');
        }
        $row = rowQueryMysql("SELECT category_id, name FROM category WHERE name='$name'");
        $category = new Category($row['0'], $row['1']);
        var_dump($category);
        return $category;
    }

    public static function selectAll() {
        $result = queryMysql("SELECT category_id, name FROM category ORDER BY name ASC");
        $n = mysql_num_rows($result);
        $categories = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $category = new Category($row['0'], $row['1']);
            $categories[$i] = $category;
        }
        return $categories;
    }
    
    public static function exists($name){
        if (!is_string($name)) {
            die('Argument passed isnt instance of string.');
        }
        $result = queryMysql("SELECT category_id, name FROM category WHERE name='$name'");
        $n = mysql_num_rows($result);
        if($n>0){
            return TRUE;
        }
        return FALSE;
    }

}
