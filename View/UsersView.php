<?php

include_once 'View.php';

class UsersView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        // TODO: Implement initialize() method.
    }

    public function printTitle() {
        echo("List Of Users");
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            foreach ($this->model->users as $user) {
                $username = $user->getUsername();
                $email = $user->getEmail();
                $create = $user->getCreateTime();
                $login = $user->getlastLogin();
                $id = $user->getIdUser();
                echo("<span class='username'>Username: " . $username . "</span>");
                echo("<span class='email'>Email: " . $email . "</span>");
                echo("<span class='create'>Create Time: " . $create . "</span>");
                echo("<span class='create'>Last Login: " . $login . "</span>");
                echo <<<_END
                    <form class='changeAdmin'  name='changeAdmin' method='post' action='./index.php?page=users'>
                    <input type='hidden' name='action' value='changeAdmin'/>
                    <input type='hidden' name='id' value='$id'/>
_END;
                if ($user->getAdmin()) {
                    echo("<span class='admin'>admin</span>");
                    echo("<input type='submit' name='submit' value='Make User'/>");
                } else {
                    echo("<span class='user'>user</span>");

                    echo("<input type='submit' name='submit' value='Make Admin'/>");
                }
                echo("</form>");
                if ($user->getConfirmed()) {
                    echo("<span class='confirmed'>confirmed</span>");
                } else {
                    echo("<span class='unconfirmed'>confirmed</span>");
                    $id = $user->getIdUser();
                    echo <<<_END
                    <form class='confirm'  name='confirm' method='post' action='./index.php?page=users'>
                    <input type='hidden' name='action' value='confirm'/>
                    <input type='hidden' name='id' value='$id'/>
                    <input type='submit' name='confirm' value='Confirm'/>
                    </form>
_END;

                }
            }
        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {
        echo("List Of Users");
    }

}