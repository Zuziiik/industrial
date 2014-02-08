<?php

class Comment {

    /** @var int */
    protected $idComment;

    /** @var int */
    protected $editableAdeaId;

    /** @var int */
    protected $userId;

    /** @var string */
    protected $text;

    public function getIdComment() {
        return $this->idComment;
    }

    public function getEditableAdeaId() {
        return $this->editableAdeaId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

}
