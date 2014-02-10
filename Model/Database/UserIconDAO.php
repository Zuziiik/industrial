<?php

include_once dirname(__FILE__) . '/../Entity/UserIcon.php';
include_once dirname(__FILE__) . '/../../db.php';

class UserIconDAO {
    
    public static function set(UserIcon $userIcon) {
        $a = $userIcon->getImage();
        $id = $userIcon->getUserId();
        queryMysql("UPDATE user SET icon='$a'"
                . "WHERE id_user='$id'");
    }

    public static function reset(UserIcon $userIcon) {
        $a = $userIcon->getImage();
        $id = $userIcon->getUserId();
        queryMysql("UPDATE user SET icon=NULL "
                . "WHERE id_user='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT icon FROM user WHERE id_user='$id'");
        $userIcon = new UserIcon($id, $row['0']);
        return $userIcon;
    }
}