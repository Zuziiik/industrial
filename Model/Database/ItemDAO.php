<?php

include_once dirname(__FILE__) . '/../Entity/Item.php';
include_once dirname(__FILE__) . '/../../db.php';

class ItemDAO {

    public static function insert(Item $item) {
        $a = $item->getCategoryId();
        $b = $item->getName();
        $c = $item->getDetails();
		$d = $item->getIndustrial();
        $e = $item->getLink();
        queryMysql("INSERT INTO item (category_id, item_name, details, industrial, link)"
                . "VALUES ('$a', '$b', '$c', '$d', '$e')");
        $item->setIdItem(lastId());
    }

    public static function update(Item $item) {
        $a = $item->getCategoryId();
        $b = $item->getName();
        $c = $item->getDetails();
		$d = $item->getIndustrial();
        $e = $item->getLink();
        $id = $item->getIdItem();
        queryMysql("UPDATE item SET category_id='$a', item_name='$b', details='$c', industrial='$d', link='$e'"
                . "WHERE id_item='$id'");
    }

    public static function delete(Item $item) {
        $id = $item->getIdItem();
        queryMysql("DELETE FROM item WHERE id_item='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isn`t instance of int.');
        }
        $row = rowQueryMysql("SELECT id_item, category_id, item_name, details, industrial, link FROM item WHERE id_item='$id'");
        $item = new Item($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
        return $item;
    }
    
        public static function selectByName($name) {
        if (!is_string($name)) {
            die('Argument passed isn`t instance of string.');
        }
        $row = rowQueryMysql("SELECT id_item, category_id, item_name, details, industrial, link FROM item WHERE item_name='$name'");
            $item = new Item($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
        return $item;
    }

    public static function selectByCategoryId($categoryId) {
        if (!is_int($categoryId)) {
            die('Argument passed isn`t instance of int.');
        }
        $result = queryMysql("SELECT id_item, category_id, item_name, details, industrial, link FROM item WHERE category_id='$categoryId'  ORDER BY item_name ASC");
        $n = mysql_num_rows($result);
        $items = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $item = new Item($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
            $items[$i] = $item;
        }
        return $items;
    }

	public static function selectByCategoryIdAndIndustrial($categoryId, $industrial) {
		if (!is_int($categoryId)) {
			die('Argument passed isn`t instance of int.');
		}
		if (!is_bool($industrial)) {
			die('Argument passed isn`t instance of boolean.');
		}
		$result = queryMysql("SELECT id_item, category_id, item_name, details, industrial, link FROM item WHERE category_id='$categoryId' AND industrial='$industrial' ORDER BY item_name ASC");
		$n = mysql_num_rows($result);
		$items = array();
		for ($i = 0; $i < $n; ++$i) {
			$row = mysql_fetch_row($result);
			$item = new Item($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
			$items[$i] = $item;
		}
		return $items;
	}

    public static function selectAll() {
        $result = queryMysql("SELECT id_item, category_id, item_name, details, industrial, link FROM item ORDER BY item_name ASC");
        $n = mysql_num_rows($result);
        $items = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $item = new Item($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
            $items[$i] = $item;
        }
        return $items;
    }
    
        public static function exists($id){
        if (!is_int($id)) {
            die('Argument passed isn`t instance of int.');
        }
        $result = queryMysql("SELECT id_item, category_id, item_name, details, industrial, link FROM item WHERE id_item='$id'");
        $n = mysql_num_rows($result);
        if($n>0){
            return TRUE;
        }
        return FALSE;
    }

}
