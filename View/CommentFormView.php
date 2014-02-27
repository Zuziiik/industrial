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
        $id = $this->model->commentId;
        $title = $this->model->title;
        $commentType = $this->model->commentType;
        if ($this->model->reply) {
            echo <<<_END
                <form id='replyComment' name='replyComment' method='post' action='./index.php?page=comment'>
                <input type='hidden' name='type' value='$commentType'/>
                <input type='hidden' name='action' value='replyComment'/>
                <input type='hidden' name='commentId' value='$id'/>
                <input type='hidden' name='title' value='$title'/>
                <label>Message:<textarea name='message' rows="6" cols="85"></textarea></label>
                <input class='replyComment' type='submit' name='save' value='Reply'/>
                </form>
_END;
        }
        if ($this->model->edit) {
            $message = $this->model->message;
            echo <<<_END
                <form id='editComment' name='editComment' method='post' action='./index.php?page=comment'>
                <input type='hidden' name='action' value='editComment'/>
                <input type='hidden' name='commentId' value='$id'/>
                <label>Title:<input type='text' value='$title' name='title' /></label>
                <label>Message:<textarea name='message' rows="6" cols="85">$message</textarea></label>
                <input class='editComment' type='submit' name='save' value='Edit'/>
                </form>
_END;
        }

            echo ($this->model->msg);


    }

    public function printPageHeader() {
        echo("Write comment");
    }

}