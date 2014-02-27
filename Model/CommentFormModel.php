<?php

class CommentFormModel {

    public $title;
    public $banned;
    public $commentType;
    public $commentId;
    public $reply;
    public $edit;
    public $message;
    public $msg;

    function __construct() {
        $this->banned = FALSE;
        $this->commentType = '';
        $this->reply = FALSE;
        $this->edit = FALSE;
        $this->title = '';
        $this->message = '';
        $this->msg = '';
    }
}