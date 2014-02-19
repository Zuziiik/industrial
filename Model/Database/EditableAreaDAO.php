<?php

include_once dirname(__FILE__) . '/../Entity/EditableArea.php';
include_once dirname(__FILE__) . '/../../db.php';

class EditableAreaDAO {

    public static function insert(EditableArea $editableArea) {
        $a = $editableArea->getEditableAreaTypeId();
        $b = $editableArea->getItemId();
        $c = $editableArea->getDate();
        $d = $editableArea->getTitle();
        $e = $editableArea->getText();
        $f = $editableArea->getWeight();
        queryMysql("INSERT INTO editable_area (editable_area_type_id, item_id, date, title, text, weight) "
                . "VALUES ('$a', '$b', '$c', '$d', '$e', '$f')");
        $editableArea->setIdEditableArea(lastId());
    }

    public static function update(EditableArea $editableArea) {
        $a = $editableArea->getEditableAreaTypeId();
        $b = $editableArea->getItemId();
        $c = $editableArea->getDate();
        $d = $editableArea->getTitle();
        $e = $editableArea->getText();
        $f = $editableArea->getWeight();
        $id = $editableArea->getIdEditableArea();
        queryMysql("UPDATE editable_area SET editable_area_type_id='$a', item_id='$b', date='$c', title='$d', text='$e', weight='$f' "
                . "WHERE id_editable_area='$id'");
    }

    public static function delete(EditableArea $editableArea) {
        $id = $editableArea->getIdEditableArea();
        queryMysql("DELETE FROM editable_area WHERE id_editable_area='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT id_editable_area, editable_area_type_id, item_id, date, title, text, weight FROM editable_area WHERE id_editable_area='$id'");
        $editableArea = new EditableArea($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6']);
        return $editableArea;
    }

    public static function selectByItemId($itemId) {
        if (!is_int($itemId)) {
            die('Argument passed isnt instance of int.');
        }
        $result = queryMysql("SELECT id_editable_area, editable_area_type_id, item_id, date, title, text, weight FROM editable_area WHERE item_id='$itemId' ORDER BY weight ASC");
        $n = mysql_num_rows($result);
        $editableAreas = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $editableArea = new EditableArea($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6']);
            $editableAreas[$i] = $editableArea;
        }
        return $editableAreas;
    }

    public static function selectAll() {
        $result = queryMysql("SELECT id_editable_area, editable_area_type_id, item_id, date, title, text, weight FROM editable_area ORDER BY weight ASC");
        $n = mysql_num_rows($result);
        $editableAreas = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $editableArea = new EditableArea($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6']);
            $editableAreas[$i] = $editableArea;
        }
        return $editableAreas;
    }
    
    public static function selectHighestWeight(){
        $row = rowQueryMysql("SELECT MAX(weight) FROM editable_area");
        $weight = $row['0'];
        return $weight;
    }
}
