<?php

class UsersModel {

    public $users;
    public $error;
    public $bans;
    public $banError;

    function __construct() {
        $this->users = NULL;
        $this->bans = NULL;
        $this->error = '';
        $this->banError = '';
    }

}