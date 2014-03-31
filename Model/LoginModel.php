<?php

class LoginModel {

    public $user;
	public $error;
	public $usernameError;
	public $fieldsError;
	public $passwordError;
            
    function __construct() {
        $this->error = '';
        $this->passwordError = '';
        $this->user = '';
  		$this->fieldsError = '';
		$this->usernameError = '';
    }

}
