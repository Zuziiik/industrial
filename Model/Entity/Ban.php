<?php

class Ban {

    /** @var int */
    protected $idBan;

    /** @var int */
    protected $userId;

    /** @var string */
    protected $from;

    /** @var string */
    protected $to;

    function __construct($idBan, $userId, $from, $to) {
        $this->idBan = $idBan;
        $this->userId = $userId;
        $this->from = $from;
        $this->to = $to;
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

    public function getFrom() {
        return $this->from;
    }

    public function getTo() {
        return $this->to;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function setTo($to) {
        $this->to = $to;
    }

}
