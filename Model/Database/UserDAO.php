<?php

include_once dirname(__FILE__) . '/../Entity/User.php';
include_once dirname(__FILE__) . '/../../db.php';

class UserDAO {

    public static function insert(User $user) {
        $a = $user->getUsername();
        $b = $user->getPassword();
        $c = $user->getSalt();
        $d = $user->getEmail();
        $e = $user->getCreateTime();
        $f = $user->getAdmin();
        $g = $user->getConfirmed();
        $h = $user->getLastLogin();
        $i = $user->getAbout();
        queryMysql("INSERT INTO user (username, password, salt, email, create_time, admin, confirmed, last_login, about)"
                . "VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i')");
        $user->setIdUser(lastId());
    }

    public static function update(User $user) {
        $a = $user->getUsername();
        $b = $user->getPassword();
        $c = $user->getSalt();
        $d = $user->getEmail();
        $f = $user->getAdmin();
        $g = $user->getConfirmed();
        $h = $user->getLastLogin();
        $i = $user->getAbout();
        $id = $user->getIdUser();
        queryMysql("UPDATE user SET username='$a', password='$b', salt='$c', email='$d', admin='$f', confirmed='$g', last_login='$h', about='$i'"
                . "WHERE id_user='$id'");
    }

    public static function delete(User $user) {
        $id = $user->getIdUser();
        queryMysql("DELETE FROM user WHERE id_user='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT id_user, username, password, salt, email, create_time, admin, confirmed, last_login, about  FROM user WHERE id_user='$id'");
        $user = new User($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $row['8'], $row['9']);
        return $user;
    }

    public static function selectByName($username) {
        if (!is_string($username)) {
            die('Argument passed isnt instance of string.');
        }
        $row = rowQueryMysql("SELECT id_user, username, password, salt, email, create_time, admin, confirmed, last_login, about FROM user WHERE username='$username'");
        $user = new User($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $row['8'], $row['9']);
        return $user;
    }

    public static function selectByAdmin($admin) {
        if (!is_bool($admin)) {
            die('Argument passed isnt instance of boolean.');
        }
        $result = queryMysql("SELECT id_user, username, password, salt, email, create_time, admin, confirmed, last_login, about FROM user WHERE admin='$admin'");
        $n = mysql_num_rows($result);
        $users = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $user = new User($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $row['8'], $row['9']);
            $users[$i] = $user;
        }
        return $users;
    }

    public static function selectByConfirmed($confirmed) {
        if (!is_bool($confirmed)) {
            die('Argument passed isnt instance of boolean.');
        }
        $result = queryMysql("SELECT id_user, username, password, salt, email, create_time, admin, confirmed, last_login, about FROM user WHERE confirmed='$confirmed'");
        $n = mysql_num_rows($result);
        $users = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $user = new User($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $row['8'], $row['9']);
            $users[$i] = $user;
        }
        return $users;
    }

    public static function selectAll() {
        $result = queryMysql("SELECT id_user, username, password, salt, email, create_time, admin, confirmed, last_login, about FROM user");
        $n = mysql_num_rows($result);
        $users = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $user = new User($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $row['8'], $row['9']);
            $users[$i] = $user;
        }
        return $users;
    }

    public static function UsernameExists($name) {
        if (!is_string($name)) {
            die('Argument passed isnt instance of string.');
        }
        $result = queryMysql("SELECT id_user, username, password, salt, email, create_time, admin, confirmed, last_login, about FROM user WHERE username='$name'");
        $n = mysql_num_rows($result);
        if ($n > 0) {
            return TRUE;
        }
        return FALSE;
    }
    
        public static function EmailExists($email) {
        if (!is_string($email)) {
            die('Argument passed isnt instance of string.');
        }
        $result = queryMysql("SELECT id_user, username, password, salt, email, create_time, admin, confirmed, last_login, about FROM user WHERE email='$email'");
        $n = mysql_num_rows($result);
        if ($n > 0) {
            return TRUE;
        }
        return FALSE;
    }

}
