<?php

include_once dirname(__FILE__) . '/../Entity/Item.php';
include_once dirname(__FILE__) . '/../../db.php';

class ItemDAO {

    public static function insert(Item $item) {
        $a = $item->getCategoryId();
        $b = $item->getName();
        $c = $item->getDetails();
        queryMysql("INSERT INTO item (category_id, name, details)"
                . "VALUES ('$a', '$b', '$c')");
        $item->setIdItem(lastId());
    }

    public static function update(Item $item) {
        $a = $item->getCategoryId();
        $b = $item->getName();
        $c = $item->getDetails();
        $id = $item->getIdItem();
        queryMysql("UPDATE item SET category_id='$a', name='$b', details='$c'"
                . "WHERE id_item='$id'");
    }

    public static function delete(Item $item) {
        $id = $item->getIdItem();
        queryMysql("DELETE FROM item WHERE id_item='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM item WHERE id_item='$id'");
        $item = new Item($row['0'], $row['1'], $row['2'], $row['3']);
        return $item;
    }

    public static function selectByCategoryId($categoryId) {
        if (!is_int($categoryId)) {
            die('Argument passed isnt instance of int.');
        }
        $result = queryMysql("SELECT * FROM item WHERE category_id='$categoryId'");
        $n = mysql_num_rows($result);
        $items = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $item = new Item($row['0'], $row['1'], $row['2'], $row['3']);
            $items[$i] = $item;
        }
        return $items;
    }

    public static function selectAll() {
        $result = queryMysql("SELECT * FROM item");
        $n = mysql_num_rows($result);
        $items = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $item = new Item($row['0'], $row['1'], $row['2'], $row['3']);
            $items[$i] = $item;
        }
        return $items;
    }
    
        public static function exists($name){
        if (!is_string($name)) {
            die('Argument passed isnt instance of string.');
        }
        $result = queryMysql("SELECT * FROM item WHERE name='$name'");
        $n = mysql_num_rows($result);
        if($n>0){
            return TRUE;
        }
        return FALSE;
    }

}
