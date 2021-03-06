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

    public function printNavigation() {
        // 	TODO: Implement printNavigation() method.
    }

    public function printBody() {
        if ($this->model->comments) {
            echo("<div class='comments'>");
            $this->printComment($this->model->comments, 0);
            echo("</div>");
        }

    }

    function setPath($path) {
        $this->model->path = $path;
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
            ?>
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $title; ?></h3>
            </div>
            <div class="panel-body">
                User: <a class="link"
                         href='./index.php?page=profile&name=<?php echo($commentUsername); ?>'><?php echo($commentUsername); ?></a> </br>
                Message: <?php echo($message); ?>
                <?php
                if ($loggedIn && $commentUsername == $username) {
                    ?>
                    <?php
                    if ($admin || $commentUsername == $username) {
                        ?>
                        <form id="deleteComment" name='deleteComment' method='post' action='./index.php?page=servers'>
                            <input type='hidden' name='action' value='deleteComment' />
                            <input type='hidden' name='commentId' value='<?php echo($id); ?>' />

                        </form>
                    <?php
                    }
                    ?>
                    <form id="editComment" class='editComment' name='editComment' method='post'
                          action='./index.php?page=comment'>
                        <input type='hidden' name='action' value='editComment' />
                        <input type='hidden' name='path' value='<?php echo($this->model->path); ?>' />
                        <input type='hidden' name='title' value='<?php echo($title); ?>' />
                        <input type='hidden' name='message' value='<?php echo($message); ?>' />
                        <input type='hidden' name='commentId' value='<?php echo($id); ?>' />

                    </form>
                <?php
                }

                if ($loggedIn) {
                    $commentType = Comment::RE;
                    ?>
                    <form id="replyComment" class='replyComment' name='replyComment' method='post'
                          action='./index.php?page=comment'>
                        <input type='hidden' name='type' value='<?php echo($commentType); ?>' />
                        <input type='hidden' name='path' value='<?php echo($this->model->path); ?>' />
                        <input type='hidden' name='action' value='replyComment' />
                        <input type='hidden' name='title' value='<?php echo($title); ?>' />
                        <input type='hidden' name='commentId' value='<?php echo $id; ?>' />

                    </form>
                    <div class="btn-group">
                        <button form="replyComment" class='btn btn-sm btn-default' type='submit' name='replyComment'>Reply
                        </button>
                        <?php
                        if ($commentUsername == $username) {
                            if ($admin || $commentUsername == $username) {
                                ?>
                                <button form="deleteComment" class='btn btn-sm btn-default' type='submit' name='deleteComment'>
                                    Delete
                                    Comment
                                </button>
                            <?php
                            }
                            ?>
                            <button form="editComment" class='btn btn-sm btn-default' type='submit' name='editComment'>Edit
                                Comment
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }

                $reComments = $comment->getComments();
                $this->printComment($reComments);
                ?></div></div><?php
        }

    }

    public function printPageHeader() {

    }

}