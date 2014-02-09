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
        $row = rowQueryMysql("SELECT * FROM item WHERE category_id='$categoryId'");
        $item = new Item($row['0'], $row['1'], $row['2'], $row['3']);
        return $item;
    }

}
