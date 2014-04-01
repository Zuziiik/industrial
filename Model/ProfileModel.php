<?php

class ProfileModel {

    public $username;
    public $user;
    public $edit;
	public $OldPasswordError;
	public $PasswordsMatchError;
	public $EmptyFieldsError;

    function __construct() {
        $this->edit = FALSE;
        $this->user = NULL;
        $this->username = '';
		$this->OldPasswordError = '';
		$this->PasswordsMatchError = '';
		$this->EmptyFieldsError = '';
    }

}