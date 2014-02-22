<?php

include_once 'View.php';

class LoginView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printBody() {
        global $loggedIn;
        echo("<div class='login'>");
        if (!$loggedIn) {

            echo($this->model->error);
            echo("<form name='login' method='post' action='./index.php?page=login'>");
            echo("<table>");
            echo("<tr>");
            echo("<td>");
            echo("<label for='name'>Username</label>");
            echo("</td>");
            echo("<td>");
            echo("<input id='name' name='user' value='");
            $this->model->user;
            echo("' type='text'/>");
            echo("</td>");
            echo("</tr>");
            echo("<tr>");
            echo("<td>");
            echo("<label for='pass'>Password</label>");
            echo("</td>");
            echo("<td>");
            echo("<input id='pass' name='pass' type='password'/>");
            echo("</td>");
            echo("</tr>");
            echo("<tr>");
            echo("<td>");
            echo("<input type='hidden' name='action' value='login'/>");
            echo("</td>");
            echo("<td>");
            echo("<input type='submit' name='submit'/>");
            echo("</td>");
            echo("</tr>");
            echo("</table>");
            echo("</form>");
        } else {
            echo("Please <a href='./index.php?page=login&action=logout'>click here</a> to logout.");
        }
        echo $this->model->msg;
        echo("</div>");
    }

    public function printTitle() {
        echo("Login");
    }

    public function printPageHeader() {
        echo("Login");
    }

}
