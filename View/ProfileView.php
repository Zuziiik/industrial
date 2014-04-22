<?php

include_once 'View.php';

class ProfileView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        global $loggedIn;
        global $username;
        if ($loggedIn && $username == $this->model->username) {
            echo("Industrial Craft Experimental - Wiki - Your Profile");
        } else {
            echo("Industrial Craft Experimental - Wiki - " . $this->model->username . " Profile");
        }
    }

    public function printNavigation() {
        global $loggedIn;
        global $username;
        if ($loggedIn && $username == $this->model->username) {
            ?>
            <li><a href='.'>Home</a></li>
            <li class="active">Your Profile</li><?php
        } else {
            ?>
            <li><a href='.'>Home</a>
            <li><a href='index.php?page=users'>List Of
                    Users</a></li>
            <li class="active"><?php echo($this->model->username . " Profile"); ?></li><?php
        }
    }

    public function printBody() {
        global $loggedIn;
        if ($loggedIn) {
            $this->printProfile();
        } else {
            echo($this->model->error);

        }
    }

    public function printPageHeader() {

    }

    private function printProfile() {
        global $loggedIn;
        global $username;
        if ($loggedIn && $username == $this->model->username) {
            ?><h2>Your Profile</h2><?php
        } else {
            ?><h2><?php echo($this->model->username); ?> Profile</h2><?php
        }
        global $username;
        if (!$this->model->edit) {
            $id = $this->model->user->getIdUser();
            $about = $this->model->user->getAbout();
            $email = $this->model->user->getEmail();
            ?>
            <img class="img-responsive" alt="<?php echo($username); ?>'s profile picture"
                 src='image.php?type=user&id=<?php echo($id); ?>'>
            <h3>About</h3>
            <?php
            if ($about != '') {
                ?>
                <div class='well'><?php echo($about); ?></div>
            <?php
            }
            ?>
            <span class="text-info">Email: <?php echo($email); ?></span>
            <?php
            if ($username == $this->model->username) {
                ?>
                <form name='editProfile' method='post' action='./index.php?page=profile&name=<?php echo($username); ?>'>
                    <input type='hidden' name='action' value='editProfile' />
                    <button class="btn btn-default" type='submit' name='edit'>Edit Profile</button>
                </form>
            <?php
            }
        } else {
            $about = $this->model->user->getAbout();
            ?>
            <form name='editProfile' method='post' action='./index.php?page=profile&name=<?php echo($username); ?>'
                  enctype='multipart/form-data'>
                <input type='hidden' name='action' value='editProfile' />
                <label>Image
                    <input name="image" type="file" title="Search..." >
                </label>
                <textarea class="editForm" name='about' rows="4" cols="50" wrap="soft"><?php echo($about); ?></textarea>
                <button class="btn btn-default btn-sm" type='submit' name='save'>Save</button>
            </form>

        <?php
        }

        if ($username == $this->model->username && !$this->model->edit) {
            ?>
            <h3>Change Password</h3>
            <form class="form-horizontal" name='changePassword' method='post'
                  action='./index.php?page=profile&name=<?php echo($username); ?>'>
                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="oldPassword">Old Password</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="password" class="form-control" name='oldPassword' id="oldPassword"></div>
                    <?php echo($this->model->OldPasswordError); ?>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="newPassword">New Password</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="password" class="form-control" name='newPassword' id="newPassword"></div>
                    <?php echo($this->model->PasswordsMatchError); ?>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="repeatPassword">Repeat Password</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="password" class="form-control" name='repeatPassword' id="repeatPassword"></div>
                </div>
                <div class="form-group">
                    <div
                        class=" col-sm-offset-4 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3">
                        <button class="btn btn-default glyphicon glyphicon-ok" type='submit' name='changePassword'>
                            Save
                        </button>
                        <?php echo($this->model->EmptyFieldsError); ?>
                    </div>
                </div>
            </form>
        <?php
        }
    }

}