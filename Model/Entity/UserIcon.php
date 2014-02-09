<?php

class UserIcon {

    /** @var int */
    protected $userId;

    /** @var blog */
    protected $image;

    function __construct($userId, blog $image) {
        $this->userId = $userId;
        $this->image = $image;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage(blog $image) {
        $this->image = $image;
    }

}
