<?php

include_once 'View.php';
include_once dirname(__FILE__) . '/../Model/Database/UserDAO.php';

class CommentView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {

    }

    public function printBody() {
        if ($this->model->comments) {
            foreach ($this->model->comments as $comment) {

                $title = $comment->getTitle();
                $message = $comment->getMessage();
                $userId =(int) $comment->getUserId();
                $user = UserDAO::selectById($userId);
                $username = $user->getUsername();
                echo("<span class = 'commentTitle'>Title: $title</span>");
                echo("<span class='commentUser'> User: $username</span>");
                echo("<span class='commentMessage'> Message: $message</span>");
            }
        }

    }

    public function printPageHeader() {

    }

}