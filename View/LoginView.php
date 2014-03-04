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
            ?>
            <form name='login' method='post' action='./index.php?page=login'>
                <table>
                    <tr>
                        <td>
                            <label for='name'>Username</label>
                        </td>
                        <td>
                            <input autofocus id='name' name='user' value='<?php echo $this->model->user; ?>' type='text' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for='pass'>Password</label>
                        </td>
                        <td>
                            <input id='pass' name='pass' type='password' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type='hidden' name='action' value='login' />
                        </td>
                        <td>
                            <input type='submit' name='submit' />
                        </td>
                    </tr>
                </table>
                echo("
            </form>
        <?php
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
