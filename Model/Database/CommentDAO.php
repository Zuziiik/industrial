<?php

include_once dirname(__FILE__) . '/../Entity/Comment.php';
include_once dirname(__FILE__) . '/../../db.php';

class CommentDAO {

    public static function insert(Comment $comment) {
        $a = $comment->getEditableAdeaId();
        $b = $comment->getUserId();
        $c = $comment->getText();
        queryMysql("INSERT INTO comment (id_editable_area, user_id_user, text) "
                . "VALUES ('$a', '$b', '$c')");
        $comment->setIdComment(lastId());
    }

    public static function update(Comment $comment) {
        $a = $comment->getEditableAdeaId();
        $b = $comment->getUserId();
        $c = $comment->getText();
        $id = $comment->getIdComment();
        queryMysql("UPDATE comment SET id_editable_area='$a', user_id_user='$b', text='$c'"
                . "WHERE id_comment='$id'");
    }

    public static function delete(Comment $comment) {
        $id = $comment->getIdComment();
        queryMysql("DELETE FROM comment WHERE id_comment='$id'");
    }

    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM comment WHERE id_comment='$id'");
        $comment = new Comment($row['0'], $row['1'], $row['2'], $row['3']);
        return $comment;
    }

    public static function selectByUserId($userId) {
        if (!is_int($userId)) {
            die('Argument passed isnt instance of int.');
        }
        $row = rowQueryMysql("SELECT * FROM comment WHERE user_id_user='$userId'");
        $comment = new Comment($row['0'], $row['1'], $row['2'], $row['3']);
        return $comment;
    }

    public static function selectAll() {
        $result = queryMysql("SELECT * FROM comment");
        $n = mysql_num_rows($result);
        $comments = array();
        for ($i = 0; $i < $n;  ++$i) {
            $row = mysql_fetch_row($result);
            $comment = new Comment($row['0'], $row['1'], $row['2'], $row['3']);
            $comments[$i] = $comment;
        }
        return $comments;
    }

}
