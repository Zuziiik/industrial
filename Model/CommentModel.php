<?php

class CommentModel {

    public $comments;
    public $type;
    public $targetId;
	public $path;

    function __construct() {
        $this->comments = NULL;
        $this->type = '';
        $this->targetId = NULL;

    }
}