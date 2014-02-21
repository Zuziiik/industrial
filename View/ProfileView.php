<?php

include_once 'View.php';

class ProfileView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        // TODO: Implement initialize() method.
    }

    public function printTitle() {
        echo("Your Profile");
    }

    public function printBody() {
        global $loggedIn;
        global $username;
        if ($loggedIn) {
            $id = $this->model->user->getIdUser();
            $about = $this->model->user->getAbout();
            echo("<div class='picture'><img src='image.php?type=user&id=$id'></div>");
            echo("<div class='about'>$about</div>");
            if ($username == $this->model->username) {
                $this->printMyProfile($id);
            } else {
                $this->printProfile();
            }
        } else {
            echo("You're not logged in.");

        }
    }

    public function printPageHeader() {
        global $loggedIn;
        global $username;
        if ($loggedIn && $username == $this->model->username) {
            echo("Your Profile");
        }

    }

    private function printMyProfile($id) {
        global $username;
        if (!$this->model->edit) {
            echo <<<_END
                <form name='editProfile' method='post' action='./index.php?page=profile&name=$username'>
                <input type='hidden' name='action' value='editProfile'/>
                <input type='submit' name='edit' value='Edit Profile'/>
                </form>
_END;
        } else {
            $about = $this->model->user->getAbout();
            echo <<<_END
                <form  name='editProfile' method='post' action='./index.php?page=profile&name=$username' enctype='multipart/form-data'>
                <input type='hidden' name='action' value='editProfile'/>
                <label for='image'>Image</label>
                <input type='file' id='image' name='image' size='14' maxlength='32' />
                <label for='about'>About</label>
                <textarea name='about' id='about' rows="4" cols="50">$about</textarea>
                <input type='submit' name='save' value='Save Profile'/>
                </form>
_END;
        }
        echo $this->model->msg;
    }

    private function printProfile() {

    }

}