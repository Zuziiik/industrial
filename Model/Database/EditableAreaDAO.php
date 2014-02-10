<?php

include_once dirname(__FILE__) . '/../Entity/EditableArea.php';
include_once dirname(__FILE__) . '/../../db.php';

class EditableAreaDAO {

    public static function insert(EditableArea $editableArea) {
        $a = $editableArea->getItemId();
        $b = $editableArea->getArchivedItemId();
        $c = $editableArea->getEditableAreaTypeId();
        $d = $editableArea->getDate();
        $e = $editableArea->getTitle();
        $f = $editableArea->getLocked();
        $g = $editableArea->getText();
        queryMysql("INSERT INTO editable_area (item_id, archived_item_id, editable_area_type_id, date, title, locked, text) "
                . "VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g')");
        $editableArea->setIdEditableArea(lastId());
    }

    public static function update(EditableArea $editableArea) {
        $a = $editableArea->getItemId();
        $b = $editableArea->getArchivedItemId();
        $c = $editableArea->getEditableAreaTypeId();
        $d = $editableArea->getDate();
        $e = $editableArea->getTitle();
        $f = $editableArea->getLocked();
        $g = $editableArea->getText();
        $id = $editableArea->getIdEditableArea();
        queryMysql("UPDATE editable_area SET item_id='$a', archived_item_id='$b', editable_area_type_id='$c', date='$d', title='$e', locked='$f', text='$g' "
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
        $row = rowQueryMysql("SELECT * FROM editable_area WHERE id_editable_area='$id'");
        $editableArea = new EditableArea($row['0'], $row['5'], $row['1'], $row['2'], $row['4'], $row['7'], $row['5'], $row['6']);
        return $editableArea;
    }

    public static function selectByItemId($itemId) {
        if (!is_int($itemId)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM editable_area WHERE item_id='$itemId'");
        $editableArea = new EditableArea($row['0'], $row['5'], $row['1'], $row['2'], $row['4'], $row['7'], $row['5'], $row['6']);
        return $editableArea;
    }

    public static function selectByArchivedItemId($archivedItemId) {
        if (!is_int($archivedItemId)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM editable_area WHERE archived_item_id='$archivedItemId'");
        $editableArea = new EditableArea($row['0'], $row['5'], $row['1'], $row['2'], $row['4'], $row['7'], $row['5'], $row['6']);
        return $editableArea;
    }

    public static function selectAll() {
        $result = queryMysql("SELECT * FROM editable_area");
        $n = mysql_num_rows($result);
        $editableAreas = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $editableArea = new EditableArea($row['0'], $row['5'], $row['1'], $row['2'], $row['4'], $row['7'], $row['5'], $row['6']);
            $editableAreas[$i] = $editableArea;
        }
        return $editableAreas;
    }

}
