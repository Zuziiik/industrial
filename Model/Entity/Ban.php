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

    /**
     * 
     * @param int $idBan
     * @param int $userId
     * @param string $banStart
     * @param string $banEnd
     */
    function __construct($idBan, $userId, $banStart, $banEnd) {
        $this->idBan = $idBan;
        $this->userId = $userId;
        $this->banStart = $banStart;
        $this->banEnd = $banEnd;
    }

    /**
     * @param $idBan
     */
    public function setIdBan($idBan) {
        $this->idBan = $idBan;
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
    public function getIdBan() {
        return $this->idBan;
    }

    /**
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getBanStart() {
        return $this->banStart;
    }

    /**
     * @return string
     */
    public function getBanEnd() {
        return $this->banEnd;
    }

    /**
     * @param $banStart
     */
    public function setBanStart($banStart) {
        $this->banStart = $banStart;
    }

    /**
     * @param $banEnd
     */
    public function setBanEnd($banEnd) {
        $this->banEnd = $banEnd;
    }

}
