<?php

class UserIcon {

    /** @var int */
    protected $userId;

    /** @var blob */
    protected $image;

    /**
     * @param int  $userId
     * @param blob $image
     */
    function __construct($userId, $image) {
        $this->userId = $userId;
        $this->image = $image;
    }

    /**
     * @param $userId
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

    /**
     * @return blob
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param $image
     */
    public function setImage($image) {
        $this->image = $image;
    }

}
