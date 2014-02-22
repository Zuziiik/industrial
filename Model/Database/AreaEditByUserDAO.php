<?php

include_once dirname(__FILE__) . '/../Entity/AreaEditByUser.php';
include_once dirname(__FILE__) . '/../../db.php';

class AreaEditByUserDAO {

    public static function insert(AreaEditByUser $areaEditByUser) {
        $a = $areaEditByUser->getEditableAreaId();
        $b = $areaEditByUser->getUserId();
        $c = $areaEditByUser->getEditing();
        $d = $areaEditByUser->getTimeOfStart();  
        queryMysql("INSERT INTO edited (id_editable_area, user_id_user, editing, time_of_start) "
                . "VALUES ('$a', '$b', '$c', $d)");
        $areaEditByUser->setIdAreaEditByUser(lastId());
    }

    public static function update(AreaEditByUser $areaEditByUser) {
        $a = $areaEditByUser->getEditableAreaId();
        $b = $areaEditByUser->getUserId();
        $c = $areaEditByUser->getEditing();
        $d = $areaEditByUser->getTimeOfStart(); 
        $id = $areaEditByUser->getIdAreaEditByUser();
        queryMysql("UPDATE edited SET id_editable_area='$a', user_id_user='$b', editing='$c', time_of_start='$d' "
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
        $row = rowQueryMysql("SELECT id_edited, id_editable_area, user_id_user, editing, time_of_start FROM edited WHERE id_edited='$id'");
        $areaEditByUser = new AreaEditByUser($row['0'], $row['1'], $row['2'], $row['3'], $row['4']);
        return $areaEditByUser;
    }

    public static function selectByUserId($userId) {
        if (!is_int($userId)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT id_edited, id_editable_area, user_id_user, editing, time_of_start FROM edited WHERE user_id_user='$userId'");
        $areaEditByUser = new AreaEditByUser($row['0'], $row['1'], $row['2'], $row['3'], $row['4']);
        return $areaEditByUser;
    }
    
        public static function selectAll() {
        $result = queryMysql("SELECT id_edited, id_editable_area, user_id_user, editing, time_of_start FROM edited");
        $n = mysql_num_rows($result);
        $areaEditByUsers = array();
        for($i=0;$i<$n;++$i){
            $row = mysql_fetch_row($result);
            $areaEditByUser = new AreaEditByUser($row['0'], $row['1'], $row['2'], $row['3'], $row['4']);
            $areaEditByUsers[$i] = $areaEditByUser;
        }
        return $areaEditByUsers;
    }

}
