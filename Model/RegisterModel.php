<?php

class RegisterModel {
    
    public $error;
    public $user;
    public $email;
    public $errorPass;
    public $errorUser;
    public $errorEmail;
    public $errorEmailFormat;
    public $msg;
            
    function __construct() {
        $this->error = '';
        $this->errorEmail = '';
        $this->errorPass = '';
        $this->errorUser = '';
        $this->errorEmailFormat = '';
        $this->user = '';
        $this->email = '';
        $this->msg = '';
    }

}

