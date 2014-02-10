<?php

class UserIcon {

    /** @var int */
    protected $userId;

    /** @var blob */
    protected $image;

    /**
     * 
     * @param int $userId
     * @param blob $image
     */
    function __construct($userId, $image) {
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

    public function setImage($image) {
        $this->image = $image;
    }

}
