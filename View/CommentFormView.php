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
        $commentTd = $this->model->commentId;
        $title = $this->model->title;
        $commentType = $this->model->commentType;
        if ($this->model->reply) {
            echo <<<_END
                <form id='replyComment' name='replyComment' method='post' action='./index.php?page=comment'>
                <input type='hidden' name='type' value='$commentType'/>
                <input type='hidden' name='action' value='replyComment'/>
                <input type='hidden' name='commentId' value='$commentTd'/>
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
                <input type='hidden' name='commentId' value='$commentTd'/>
                <label>Title:<input type='text' value='$title' name='title' /></label>
                <label>Message:<textarea name='message' rows="6" cols="85">$message</textarea></label>
                <input class='editComment' type='submit' name='save' value='Edit'/>
                </form>
_END;
        }
        if ($this->model->add) {
            $type = $this->model->commentType;
            $targetId = $this->model->targetId;
            echo <<<_END
                <form id='addComment' name='addComment' method='post' action='./index.php?page=comment'>
                <input type='hidden' name='action' value='addComment'/>
                <input type='hidden' name='targetId' value='$targetId'/>
                <input type='hidden' name='type' value='$type'/>
                <label>Title:<input type='text' name='title' /></label>
                <label>Message:<textarea name='message' rows="6" cols="85"></textarea></label>
                <input class='submit' type='submit' name='save' value='Comment'/>
                </form>
_END;
        }
        if (!$this->model->add && !$this->model->edit && !$this->model->reply) {
            echo <<<_END
            <form>
            <input type="button" value="Return to previous page" onClick="javascript:history.go(-2)" />
            </form>
_END;
        }

        echo($this->model->msg);

    }

    public function printPageHeader() {
        echo("Write comment");
    }

}