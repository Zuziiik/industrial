<?php

class Ban {

    /** @var int */
    protected $idBan;

    /** @var int */
    protected $userId;

    /** @var string */
    protected $banStart;

    /** @var string */
    protected $banEnd;

    function __construct($idBan, $userId, $banStart, $banEnd) {
        $this->idBan = $idBan;
        $this->userId = $userId;
        $this->banStart = $banStart;
        $this->banEnd = $banEnd;
    }

    public function setIdBan($idBan) {
        $this->idBan = $idBan;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getIdBan() {
        return $this->idBan;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getBanStart() {
        return $this->banStart;
    }

    public function getBanEnd() {
        return $this->banEnd;
    }

    public function setBanStart($banStart) {
        $this->banStart = $banStart;
    }

    public function setBanEnd($banEnd) {
        $this->banEnd = $banEnd;
    }

}
