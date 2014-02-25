<?php

class Comment {

    const SERVER = 1;
    const NEWS = 2;
    const RE = 3;

    /** @var int */
    protected $idComment;

    /** @var int */
    protected $userId;

    /** @var int */
    protected $targetId;

    /** @var int */
    protected $type;

    /** @var string */
    protected $title;

    /** @var string */
    protected $message;

    /** @var array[Comment] */
    public $comments;

    /**
     * @param int    $idComment
     * @param int    $userId
     * @param int    $targetId
     * @param int    $type
     * @param string $title
     * @param string $message
     */
    function __construct($idComment, $userId, $targetId, $type, $title, $message) {
        $this->idComment = $idComment;
        $this->userId = $userId;
        $this->targetId = $targetId;
        $this->type = $type;
        $this->title = $title;
        $this->message = $message;
        $this->comments = NULL;
    }

    /**
     * @param array[Comment] $comments
     */
    public function setComments($comments) {
        $this->comments = $comments;
    }

    /**
     * @return array[Comment]
     */
    public function getComments() {
        return $this->comments;
    }

    /**
     * @param int $idComment
     */
    public function setIdComment($idComment) {
        $this->idComment = $idComment;
    }

    /**
     * @return int
     */
    public function getIdComment() {
        return $this->idComment;
    }

    /**
     * @param string $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @param int $targetId
     */
    public function setTargetId($targetId) {
        $this->targetId = $targetId;
    }

    /**
     * @return int
     */
    public function getTargetId() {
        return $this->targetId;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param int $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

}
