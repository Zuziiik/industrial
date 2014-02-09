<?php

include_once dirname(__FILE__) . '/../Entity/Ban.php';
include_once dirname(__FILE__) . '/../../db.php';

class BanDAO {

    public static function insert(Ban $ban) {
        $a = $ban->getBanStart();
        $b = $ban->getBanEnd();
        $c = $ban->getUserId();
        queryMysql("INSERT INTO ban (ban_start, ban_end, user_id_user) VALUES ('$a', '$b', '$c')");
        $ban->setIdBan(lastId());
    }

    public static function update(Ban $ban) {
        $a = $ban->getBanStart();
        $b = $ban->getBanEnd();
        $c = $ban->getUserId();
        $id = $ban->getIdBan();
        queryMysql("UPDATE ban SET ban_start='$a', ban_end='$b', user_id_user='$c' WHERE id_ban='$id'");
    }

    public static function delete(Ban $ban) {
        $id = $ban->getIdBan();
        queryMysql("DELETE FROM ban WHERE id_ban='$id'");
    }
    
    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM ban WHERE id_ban='$id'");
        $ban = new Ban($row['0'], $row['3'], $row['1'], $row['2']);
        return $ban;
    }

    public static function selectByUserId($userId) {
        if (!is_int($userId)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM ban WHERE user_id_user='$userId'");
        $ban = new Ban($row['0'], $row['3'], $row['1'], $row['2']);
        return $ban;
    }

}
