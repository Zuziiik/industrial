<?php

include_once dirname(__FILE__) . '/CommentModel.php';
include_once dirname(__FILE__) . '/../Control/CommentControl.php';
include_once dirname(__FILE__) . '/../View/CommentView.php';

class ServersModel {

    public $servers;
    public $commentModels;
    public $commentControls;
    public $commentViews;

    function __construct() {

        $this->servers = NULL;
        $this->commentModels = array();
        $this->commentControls = array();
        $this->commentViews = array();
//        $this->commentModel = new CommentModel();
//        $this->commentControl = new CommentControl($this->commentModel);
//        $this->commentView = new CommentView($this->commentModel);
    }
}