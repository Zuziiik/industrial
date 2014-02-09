<?php

include_once dirname(__FILE__) . '/../Entity/AreaEditByUser.php';
include_once dirname(__FILE__) . '/../../db.php';

class AreaEditByUserDAO {

    public static function insert(AreaEditByUser $areaEditByUser) {
        $a = $areaEditByUser->getAllowed();
        $b = $areaEditByUser->getEditing();
        $c = $areaEditByUser->getTimeOfStart();
        $d = $areaEditByUser->getEditableAreaId();
        $e = $areaEditByUser->getUserId();
        queryMysql("INSERT INTO edited (allowed, editing, time_of_start, id_editable_area, user_id_user) "
                . "VALUES ('$a', '$b', '$c', $d, $e)");
        $areaEditByUser->setIdAreaEditByUser(lastId());
    }

    public static function update(AreaEditByUser $areaEditByUser) {
        $a = $areaEditByUser->getAllowed();
        $b = $areaEditByUser->getEditing();
        $c = $areaEditByUser->getTimeOfStart();
        $d = $areaEditByUser->getEditableAreaId();
        $e = $areaEditByUser->getUserId();
        $id = $areaEditByUser->getIdAreaEditByUser();
        queryMysql("UPDATE edited SET allowed='$a', editing='$b', time_of_start='$c', id_editable_area='$d', user_id_user='$e' "
                . "WHERE id_edited='$id'");
    }

    public static function delete(AreaEditByUser $areaEditByUser) {
        $id = $areaEditByUser->getIdAreaEditByUser();
        queryMysql("DELETE FROM edited WHERE id_edited='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM edited WHERE id_edited='$id'");
        $areaEditByUser = new AreaEditByUser($row['0'], $row['4'], $row['5'], $row['1'], $row['2'], $row['3']);
        return $areaEditByUser;
    }

    public static function selectByUserId($userId) {
        if (!is_int($userId)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM edited WHERE user_id_user='$userId'");
        $areaEditByUser = new AreaEditByUser($row['0'], $row['4'], $row['5'], $row['1'], $row['2'], $row['3']);
        return $areaEditByUser;
    }

}
