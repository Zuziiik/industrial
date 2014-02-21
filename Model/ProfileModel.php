<?php

class ProfileModel {

    public $username;
    public $user;
    public $edit;
    public $msg;

    function __construct() {
        $this->edit = FALSE;
        $this->user = NULL;
        $this->username = '';
        $this->msg = '';
    }

}