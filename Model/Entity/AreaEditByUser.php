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
     * 
     * @param int $IdAreaEditByUser
     * @param int $editableAreaId
     * @param int $userId
     * @param boolean $editing
     * @param string $timeOfStart
     */
    function __construct($IdAreaEditByUser, $editableAreaId, $userId, $editing, $timeOfStart) {
        $this->IdAreaEditByUser = $IdAreaEditByUser;
        $this->editableAreaId = $editableAreaId;
        $this->userId = $userId;
        $this->editing = $editing;
        $this->timeOfStart = $timeOfStart;
    }

    public function getIdAreaEditByUser() {
        return $this->IdAreaEditByUser;
    }

    public function setIdAreaEditByUser($IdAreaEditByUser) {
        $this->IdAreaEditByUser = $IdAreaEditByUser;
    }

    public function setEditableAreaId($editableAreaId) {
        $this->editableAreaId = $editableAreaId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getEditableAreaId() {

        return $this->editableAreaId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getEditing() {
        return $this->editing;
    }

    public function getTimeOfStart() {
        return $this->timeOfStart;
    }

    public function setEditing($editing) {
        $this->editing = $editing;
    }

    public function setTimeOfStart($timeOfStart) {
        $this->timeOfStart = $timeOfStart;
    }

}
