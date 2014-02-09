<?php

include_once dirname(__FILE__) . '/../Entity/ItemIcon.php';
include_once dirname(__FILE__) . '/../../db.php';

class ItemIconDAO {

    public static function set(ItemIcon $itemIcon) {
        $a = $itemIcon->getImage();
        $id = $itemIcon->getItemId();
        queryMysql("UPDATE item SET icon='$a'"
                . "WHERE id_item='$id'");
    }

    public static function reset(ItemIcon $itemIcon) {
        $a = $itemIcon->getImage();
        $id = $itemIcon->getItemId();
        queryMysql("UPDATE item SET icon=NULL "
                . "WHERE id_item='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT icon FROM item WHERE id_item='$id'");
        $itemIcon = new ItemIcon($id, $row['0']);
        return $itemIcon;
    }

}
