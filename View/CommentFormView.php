<?php

include_once 'View.php';

class CommentFormView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Write comment");
    }

    public function printBody() {
        if ($this->model->reply) {
            $id = $this->model->commentId;
            $commentType = $this->model->commentType;
            echo <<<_END
                <form id='replyComment' name='replyComment' method='post' action='./index.php?page=comment'>
                <input type='hidden' name='type' value='$commentType'/>
                <input type='hidden' name='action' value='replyComment'/>
                <input type='hidden' name='commentId' value='$id'/>
                <label>Title:<input type='text' id='title' name='title' /></label>
                <label>Message:<textarea name='message' rows="6" cols="85"></textarea></label>
                <input class='replyComment' type='submit' name='save' value='Reply'/>
                </form>
_END;
        }

    }

    public function printPageHeader() {
        echo("Write comment");
    }

}