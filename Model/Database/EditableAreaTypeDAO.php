<?php

include_once dirname(__FILE__) . '/../Entity/EditableAreaType.php';
include_once dirname(__FILE__) . '/../../db.php';

class EditableAreaTypeDAO {

    public static function insert(EditableAreaType $editableAreatype) {
        $a = $editableAreatype->getName();
        queryMysql("INSERT INTO editable_area_type (name) "
                . "VALUES ('$a')");
        $editableAreatype->setIdEditableAreaType(lastId());
    }

    public static function update(EditableAreaType $editableAreatype) {
        $a = $editableAreatype->getName();
        $id = $editableAreatype->getIdEditableAreaType();
        queryMysql("UPDATE editable_area_type SET name='$a' "
                . "WHERE id_editable_area_type='$id'");
    }

    public static function delete(EditableAreaType $editableAreatype) {
        $id = $editableAreatype->getIdEditableAreaType();
        queryMysql("DELETE FROM editable_area_type WHERE id_editable_area_type='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT id_editable_area_type, name FROM editable_area_type WHERE id_editable_area_type='$id'");
        $editableAreatype = new EditableAreaType($row['0'], $row['1']);
        return $editableAreatype;
    }
    
        public static function selectByName($name) {
        if (!is_string($name)) {
            die('Argument passed isnt instance of string.');
        }
        $row = rowQueryMysql("SELECT id_editable_area_type, name FROM editable_area_type WHERE name='$name'");
        $editableAreatype = new EditableAreaType($row['0'], $row['1']);
        return $editableAreatype;
    }

    public static function selectAll() {
        $result = queryMysql("SELECT id_editable_area_type, name FROM editable_area_type");
        $n = mysql_num_rows($result);
        $editableAreatypes = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $editableAreatype = new EditableAreaType($row['0'], $row['1']);
            $editableAreatypes[$i] = $editableAreatype;
        }
        return $editableAreatypes;
    }

}
