<?php

include_once 'View.php';

class LoginView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printNavigation() {
        ?>
        <li><a href='.'>Home</a></li>
        <li class="active">Login</li> <?php
    }

    public function printBody() {
        global $loggedIn;
        echo($this->model->error);
        ?>
        <div class='login'>
        <?php
        if (!$loggedIn) {
            ?>
            <form class="form-horizontal" role="form" name='login' method='post' action='./index.php?page=login'>
                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="username">Username</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-user"></span>
                            <input type="text" class="form-control" name='user' id="username"
                                   value='<?php echo($this->model->user); ?>'>
                        </div>
                    </div>
                    <?php echo($this->model->usernameError); ?>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="pass">Password</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="password" class="form-control" name='pass' id="pass"></div>
                    <?php echo($this->model->passwordError); ?>
                </div>
                <div class="form-group">
                    <input type='hidden' name='action' value='login' />

                    <div
                        class=" col-sm-offset-4 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3">
                        <button class="btn btn-default glyphicon glyphicon-ok" type='submit' name='submit'> Submit</button>
                    </div>
                    <?php echo($this->model->fieldsError); ?>
                </div>
            </form>
        <?php
        } else {

        }
        echo("</div>");
    }

    public function printTitle() {
        echo("Industrial Craft Experimental - Wiki - Login");
    }

    public function printPageHeader() {
        echo("Login");
    }

}
