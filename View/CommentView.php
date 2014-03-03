<?php

include_once 'View.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';

class CommentView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
    }

    public function printTitle() {

    }

    public function printBody() {
        if ($this->model->comments) {
            echo("<div class='comments'>");
            $this->printComment($this->model->comments, 0);
            echo("</div>");
        }

    }

    public function printComment($comments) {
        global $username;
        global $admin;
        global $loggedIn;
        foreach ($comments as $comment) {
            $id = $comment->getIdComment();
            $title = $comment->getTitle();
            $message = $comment->getMessage();
            $userId = (int)$comment->getUserId();
            $user = UserDAO::selectById($userId);
            $commentUsername = $user->getUsername();
            $type = $comment->getType();
            if ($type == Comment::RE) {
                echo("<div class='reComment'>");
            } else {
                echo("<div class='comment'>");
            }
            echo("<h3>$title</h3>");
            echo("<span class='commentUser'> User: $commentUsername</span>");
            echo("<span class='commentMessage'> Message: $message</span>");

            if ($loggedIn && ($admin || $commentUsername == $username)) {
                echo <<<_END
                <form class='deleteComment' name='deleteComment' method='post' action='./index.php?page=servers'>
                <input type='hidden' name='action' value='deleteComment'/>
                <input type='hidden' name='commentId' value='$id'/>
                <input class='deleteComment' type='submit' name='deleteComment' value='Delete Comment'/>
                </form>
_END;
            }
            if ($loggedIn && $commentUsername == $username) {
                echo <<<_END
                <form class='editComment' name='editComment' method='post' action='./index.php?page=comment'>
                <input type='hidden' name='action' value='editComment'/>
                <input type='hidden' name='title' value='$title'/>
                <input type='hidden' name='message' value='$message'/>
                <input type='hidden' name='commentId' value='$id'/>
                <input class='editComment' type='submit' name='editComment' value='Edit Comment'/>
                </form>
_END;
            }

            if ($loggedIn) {
                $commentType = Comment::RE;
                echo <<<_END
                <form class='replyComment' name='replyComment' method='post' action='./index.php?page=comment'>
                <input type='hidden' name='type' value='$commentType'/>
                <input type='hidden' name='action' value='replyComment'/>
                <input type='hidden' name='title' value='$title'/>
                <input type='hidden' name='commentId' value='$id'/>
                <input class='replyComment' type='submit' name='replyComment' value='Reply'/>
                </form>
_END;
            }

            $reComments = $comment->getComments();
            echo("<span class='reComment'>" . $this->printComment($reComments) . "</span>");
            echo("</div>");
        }

    }

    public function printPageHeader() {

    }

}