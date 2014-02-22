<?php

class LoginModel {

    public $error;
    public $msg;
    public $user;
            
    function __construct() {
        $this->msg = '';
        $this->error = '';
        $this->user = '';
  
    }

}
