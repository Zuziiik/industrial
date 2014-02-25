<?php

include_once dirname(__FILE__) . '/../Entity/Comment.php';
include_once dirname(__FILE__) . '/../../db.php';

class CommentDAO {

    /**
     * @param Comment $comment
     */
    public static function insert(Comment $comment) {
        $a = $comment->getUserId();
        $b = $comment->getTargetId();
        $c = $comment->getType();
        $d = $comment->getTitle();
        $e = $comment->getMessage();
        queryMysql("INSERT INTO comment (user_id_user, target_id, comment_type, title, message) " . "VALUES ('$a', '$b', '$c', '$d', '$e')");
        $comment->setIdComment(lastId());
    }

    /**
     * @param Comment $comment
     */
    public static function update(Comment $comment) {
        $a = $comment->getUserId();
        $b = $comment->getTargetId();
        $c = $comment->getType();
        $d = $comment->getTitle();
        $e = $comment->getMessage();
        $id = $comment->getIdComment();
        queryMysql("UPDATE comment SET user_id_user='$a', target_id='$b', comment_type='$c', title='$d', message='$e'" . "WHERE id_comment='$id'");
    }

    /**
     * @param Comment $comment
     */
    public static function delete(Comment $comment) {
        $id = $comment->getIdComment();
        queryMysql("DELETE FROM comment WHERE id_comment='$id'");
    }

    /**
     * @param $id
     * @return Comment
     */
    public static function selectById($id) {
        if (!is_int($id)) {
            die('Argument passed isn`t instance of int.');
        }
        $row = rowQueryMysql("SELECT id_comment, user_id_user, target_id, comment_type, title, message  FROM comment WHERE id_comment='$id'");
        $comment = new Comment($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
        return $comment;
    }

    /**
     * @param $userId
     * @return array[Comment]
     */
    public static function selectByUserId($userId) {
        if (!is_int($userId)) {
            die('Argument passed isn`t instance of int.');
        }
        $result = queryMysql("SELECT id_comment, user_id_user, target_id, comment_type, title, message FROM comment WHERE user_id_user='$userId'");
        $n = mysql_num_rows($result);
        $comments = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $comment = new Comment($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
            $comments[$i] = $comment;
        }
        return $comments;
    }

    /**
     * @param $targetId
     * @return array[Comment]
     */
    public static function selectByTargetId($targetId) {
        if (!is_int($targetId)) {
            die('Argument passed isn`t instance of int.');
        }
        $result = queryMysql("SELECT id_comment, user_id_user, target_id, comment_type, title, message FROM comment WHERE target_id='$targetId'");
        $n = mysql_num_rows($result);
        $comments = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $comment = new Comment($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
            $comments[$i] = $comment;
        }
        return $comments;
    }

    public static function selectByType($type) {
        if (!is_int($type)) {
            die('Argument passed isn`t instance of int.');
        }
        $result = queryMysql("SELECT id_comment, user_id_user, target_id, comment_type, title, message FROM comment WHERE comment_type='$type'");
        $n = mysql_num_rows($result);
        $comments = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $comment = new Comment($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
            $comments[$i] = $comment;
        }
        return $comments;
    }

    public static function selectByTypeAndTarget($type, $targetId) {
        if (!is_int($type) || !is_int($targetId)) {
            die('Argument passed isn`t instance of int.');
        }
        $result = queryMysql("SELECT id_comment, user_id_user, target_id, comment_type, title, message FROM comment WHERE comment_type='$type' AND target_id='$targetId'");
        $n = mysql_num_rows($result);
        $comments = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $comment = new Comment($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
            $comments[$i] = $comment;
        }
        return $comments;
    }

    /**
     * @return array[Comment]
     */
    public static function selectAll() {
        $result = queryMysql("SELECT id_comment, user_id_user, target_id, comment_type, title, message FROM comment");
        $n = mysql_num_rows($result);
        $comments = array();
        for ($i = 0; $i < $n; ++$i) {
            $row = mysql_fetch_row($result);
            $comment = new Comment($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5']);
            $comments[$i] = $comment;
        }
        return $comments;
    }

    public static function loadComments($type, $targetId) {
        $comments = self::selectByTypeAndTarget($type, $targetId);
        foreach ($comments as $comment) {
            $id = (int) $comment->getIdComment();
            $comment->comments = self::loadComments(Comment::RE, $id);
        }
        return $comments;
    }
}
