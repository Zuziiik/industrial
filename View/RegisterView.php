<?php

include_once 'View.php';

class RegisterView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printNavigation() {
        ?>
        <li><a href='.'>Home</a></li>
        <li class="active">Register</li><?php
    }

    public function printBody() {
        global $loggedIn;
        if (!$loggedIn) {
            echo($this->model->error);
            ?>
            <form class="form-horizontal" name='login' method='post' action='./index.php?page=register'>
                <div class="form-group">
                    <label class="col-xs-5 col-sm-3 col-md-2 col-lg-2 control-label" for="username">Username</label>

                    <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-user"></span>
                            <input type="text" class="form-control" name='user' id="username"
                                   value='<?php echo($this->model->user); ?>' autofocus>
                        </div>
                    </div>
                    <?php echo($this->model->errorUser); ?>
                </div>
                <div class="form-group">
                    <label class="col-xs-5 col-sm-3 col-md-2 col-lg-2 control-label" for="mail">Email</label>

                    <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2">
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" name='mail' id="mail"
                                   value='<?php echo($this->model->email); ?>'>
                        </div>
                    </div>
                    <?php echo($this->model->errorEmail . "  " . $this->model->errorEmailFormat); ?>
                </div>
                <div class="form-group">
                    <label class="col-xs-5 col-sm-3 col-md-2 col-lg-2 control-label" for="pass">Password</label>

                    <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2">

                        <input type="password" class="form-control" name='password' id="password"></div>
                    <?php echo($this->model->errorPass); ?>
                </div>
                <div class="form-group">
                    <label class="col-xs-5 col-sm-3 col-md-2 col-lg-2 control-label" for="pass">Repeat Password</label>

                    <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2">
                        <input type="password" class="form-control" name='repeatPassword' id="repeatPassword"></div>
                </div>
                <div class="form-group">
                    <input type='hidden' name='action' value='login' />

                    <div
                        class=" col-xs-offset-5 col-sm-offset-3 col-md-offset-2 col-lg-offset-2 col-xs-5 col-sm-3 col-md-2 col-lg-2">
                        <button type="button" class="btn btn-default glyphicon glyphicon-ok"> Submit
                        </button>
                    </div>
                    <?php echo($this->model->errorUser); ?>
                </div>

            </form>
            <?php
            echo($this->model->msg);
        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {
        echo("Register");
    }

    public function printTitle() {
        echo("Industrial Craft Experimental - Wiki - Register");
    }

}
