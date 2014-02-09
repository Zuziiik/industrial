<?php

class AreaEditByUser {

    /** @var int */
    protected $IdAreaEditByUser;

    /** @var int */
    protected $editableAreaId;

    /** @var int */
    protected $userId;

    /** @var boolean */
    protected $allowed;

    /** @var boolean */
    protected $editing;

    /** @var string */
    protected $timeOfStart;
 
    function __construct($IdAreaEditByUser, $editableAreaId, $userId, $allowed, $editing, $timeOfStart) {
        $this->IdAreaEditByUser = $IdAreaEditByUser;
        $this->editableAreaId = $editableAreaId;
        $this->userId = $userId;
        $this->allowed = $allowed;
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

    public function getAllowed() {
        return $this->allowed;
    }

    public function getEditing() {
        return $this->editing;
    }

    public function getTimeOfStart() {
        return $this->timeOfStart;
    }

    public function setAllowed($allowed) {
        $this->allowed = $allowed;
    }

    public function setEditing($editing) {
        $this->editing = $editing;
    }

    public function setTimeOfStart($timeOfStart) {
        $this->timeOfStart = $timeOfStart;
    }

}
