<?php

class User {

    /** @var int */
    protected $idUser;

    /** @var string */
    protected $username;

    /** @var string */
    protected $password;

    /** @var string */
    protected $salt;

    /** @var string */
    protected $email;

    /** @var string */
    protected $createTime;

    /** @var boolean */
    protected $admin;

    /** @var boolean */
    protected $confirmed;

    /** @var string */
    protected $lastLogin;

    /** @var string */
    protected $about;

    function __construct($idUser, $username, $password, $salt, $email, $createTime, $admin, $confirmed, $lastLogin, $about) {
        $this->idUser = $idUser;
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->email = $email;
        $this->createTime = $createTime;
        $this->admin = $admin;
        $this->confirmed = $confirmed;
        $this->lastLogin = $lastLogin;
        $this->about = $about;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCreateTime() {
        return $this->createTime;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getConfirmed() {
        return $this->confirmed;
    }

    public function getLastLogin() {
        return $this->lastLogin;
    }

    public function getAbout() {
        return $this->about;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCreateTime($createTime) {
        $this->createTime = $createTime;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function setConfirmed($confirmed) {
        $this->confirmed = $confirmed;
    }

    public function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    public function setAbout($about) {
        $this->about = $about;
    }

}
