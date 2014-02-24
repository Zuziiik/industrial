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

    /**
     * @param int     $idUser
     * @param string  $username
     * @param string  $password
     * @param string  $salt
     * @param string  $email
     * @param string  $createTime
     * @param boolean $admin
     * @param boolean $confirmed
     * @param string  $lastLogin
     * @param string  $about
     */
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

    /**
     * @param $idUser
     */
    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getIdUser() {
        return $this->idUser;
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getCreateTime() {
        return $this->createTime;
    }

    /**
     * @return bool
     */
    public function getAdmin() {
        return $this->admin;
    }

    /**
     * @return bool
     */
    public function getConfirmed() {
        return $this->confirmed;
    }

    /**
     * @return string
     */
    public function getLastLogin() {
        return $this->lastLogin;
    }

    /**
     * @return string
     */
    public function getAbout() {
        return $this->about;
    }

    /**
     * @param $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @param $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @param $salt
     */
    public function setSalt($salt) {
        $this->salt = $salt;
    }

    /**
     * @param $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param $createTime
     */
    public function setCreateTime($createTime) {
        $this->createTime = $createTime;
    }

    /**
     * @param $admin
     */
    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    /**
     * @param $confirmed
     */
    public function setConfirmed($confirmed) {
        $this->confirmed = $confirmed;
    }

    /**
     * @param $lastLogin
     */
    public function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @param $about
     */
    public function setAbout($about) {
        $this->about = $about;
    }

}
