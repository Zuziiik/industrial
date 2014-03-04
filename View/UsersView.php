<?php

include_once 'View.php';

class UsersView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

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
                ?>
                <form class='changeAdmin' name='changeAdmin' method='post' action='./index.php?page=users'>
                <input type='hidden' name='action' value='changeAdmin' />
                <input type='hidden' name='id' value='<?php echo $id; ?>' />
                <?php
                if ($user->getAdmin()) {
                    echo("<span class='admin'>admin</span>");
                    echo("<input type='submit' name='submit' value='Make User'/>");
                } else {
                    echo("<span class='user'>user</span>");

                    echo("<input type='submit' name='submit' value='Make Admin'/>");
                }
                echo("</form>");
            if (!$user->getAdmin()) {
                ?>
                <form class='banUser' name='banUser' method='post' action='./index.php?page=users'>
                <input type='hidden' name='action' value='banUser' />
                <input type='hidden' name='id' value='<?php echo $id; ?>' />
                <label for='days'>Days:</label>
                <input type='text' id='days' name='days' value='3' />
                <input type='submit' name='banUser' value='Ban User' />

                <?php
                ?>
                <form class='unbanUser' name='unbanUser' method='post' action='./index.php?page=users'>
                <input type='hidden' name='action' value='unbanUser' />
                <input type='hidden' name='id' value='<?php echo $id; ?>' />
                <input type='submit' name='unbanUser' value='Unban User' />

            <?php
            }
                if ($user->getConfirmed()) {
                    echo("<span class='confirmed'>confirmed</span>");
                } else {
                    echo("<span class='unconfirmed'>confirmed</span>");
                    $id = $user->getIdUser();
                    ?>
                    <form class='confirm' name='confirm' method='post' action='./index.php?page=users'>
                        <input type='hidden' name='action' value='confirm' />
                        <input type='hidden' name='id' value='<?php echo $id; ?>' />
                        <input type='submit' name='confirm' value='Confirm' />
                    </form>
                <?php

                }
            }
            echo("<span id='bans'>Bans:</span><div class='bans'>");

            $this->printBans();
            echo("</div>");
            echo($this->model->error);
            echo($this->model->msg);
        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {
        echo("List Of Users");
    }

    private function printBans() {
        foreach ($this->model->users as $user) {
            foreach ($this->model->bans as $ban) {
                $userId = $user->getIdUser();
                $banUserId = $ban->getUserId();
                if ($userId === $banUserId) {
                    $name = $user->getUsername();
                    $start = $ban->getBanStart();
                    $end = $ban->getBanEnd();
                    echo("<div class='ban'>Username: " . $name);
                    echo("</br>Ban Start: " . $start);
                    echo("</br>Ban End: " . $end . "</div>");
                }
            }
        }
    }

}