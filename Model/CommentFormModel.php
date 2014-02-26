<?php

class CommentFormModel {

    public $title;
    public $message;
    public $banned;
    public $commentType;
    public $commentId;
    public $reply;

    function __construct() {
        $this->banned = FALSE;
        $this->commentType = '';
        $this->message = '';
        $this->reply = FALSE;
        $this->title = '';
    }
}