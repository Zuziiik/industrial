<?php

class AreaEditByUser {

    /** @var int */
    protected $IdAreaEditByUser;

    /** @var int */
    protected $editableAreaId;

    /** @var int */
    protected $userId;

    /** @var boolean */
    protected $editing;

    /** @var string */
    protected $timeOfStart;

    /**
     * @param int     $IdAreaEditByUser
     * @param int     $editableAreaId
     * @param int     $userId
     * @param boolean $editing
     * @param string  $timeOfStart
     */
    function __construct($IdAreaEditByUser, $editableAreaId, $userId, $editing, $timeOfStart) {
        $this->IdAreaEditByUser = $IdAreaEditByUser;
        $this->editableAreaId = $editableAreaId;
        $this->userId = $userId;
        $this->editing = $editing;
        $this->timeOfStart = $timeOfStart;
    }

    /**
     * @return int
     */
    public function getIdAreaEditByUser() {
        return $this->IdAreaEditByUser;
    }

    /**
     * @param $IdAreaEditByUser
     */
    public function setIdAreaEditByUser($IdAreaEditByUser) {
        $this->IdAreaEditByUser = $IdAreaEditByUser;
    }

    /**
     * @param $editableAreaId
     */
    public function setEditableAreaId($editableAreaId) {
        $this->editableAreaId = $editableAreaId;
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
    public function getEditableAreaId() {

        return $this->editableAreaId;
    }

    /**
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @return bool
     */
    public function getEditing() {
        return $this->editing;
    }

    /**
     * @return string
     */
    public function getTimeOfStart() {
        return $this->timeOfStart;
    }

    /**
     * @param $editing
     */
    public function setEditing($editing) {
        $this->editing = $editing;
    }

    /**
     * @param $timeOfStart
     */
    public function setTimeOfStart($timeOfStart) {
        $this->timeOfStart = $timeOfStart;
    }

}
