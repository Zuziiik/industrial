<?php

class CommentModel {

    public $comments;
    public $type;
    public $targetId;

    function __construct() {
        $this->comments = NULL;
        $this->type = '';
        $this->targetId = NULL;

    }
}