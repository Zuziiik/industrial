<?php

include_once 'View.php';
include_once dirname(__FILE__) . '/../Model/Database/BanDAO.php';

class UsersView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Industrial Craft Experimental - Wiki - List Of Users");
    }

    public function printNavigation() {
        ?>
        <li><a href='.'>Home</a></li>
        <li class="active">List Of Users</li><?php
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            echo($this->model->banError);
            foreach ($this->model->users as $user) {
                $username = $user->getUsername();
                $email = $user->getEmail();
                $create = $user->getCreateTime();
                $login = $user->getlastLogin();
                $id = (int)$user->getIdUser();
                $ban = $this->checkBan($id);
                ?>
                <div class="frame">
                    <div class='userInfo'>Username: <?php echo($username);
                        if ($ban) {
                            ?> -<span class="banned"> BANNED</span> <?php
                        }?> </br>
                        Email: <?php echo($email); ?>  </br>
                        Create Time:  <?php echo($create); ?> </br>
                        Last Login:  <?php echo($login); ?> </br></div>
                    <form class='changeAdmin' name='changeAdmin' method='post' action='.index.php?page=users'>
                        <input type='hidden' name='action' value='changeAdmin' />
                        <input type='hidden' name='id' value='<?php echo($id); ?>' />
                        <?php
                        if ($user->getAdmin()) {
                            ?>
                            <span class='adminStatus'>admin</span>
                            <button class='submitButton' type='submit' name='submit'>Make User</button>
                        <?php
                        } else {
                            ?>
                            <span class='userStatus'>user</span>

                            <button class='submitButton' type='submit' name='submit'>Make Admin</button>
                        <?php
                        }
                        ?>
                    </form>
                    <?php
                    if (!$user->getAdmin()) {
                        ?>
                        <form class='banUser' name='banUser' method='post' action='./index.php?page=users'>
                            <input type='hidden' name='action' value='banUser' />
                            <input type='hidden' name='id' value='<?php echo($id); ?>' />
                            <label for='days'>Days:</label>
                            <input type='text' id='days' name='days' value='3' />
                            <button class='submitButton' type='submit' name='submit'>Ban User</button>
                        </form>
                        <?php

                        if ($ban) {
                            $start = $ban->getBanStart();
                            $end = $ban->getBanEnd();
                            ?>
                            <div class='ban'><?php echo($start); ?> - <?php echo($end); ?>
                            </div>
                            <form class='unbanUser' name='unbanUser' method='post' action='./index.php?page=users'>
                                <input type='hidden' name='action' value='unbanUser' />
                                <input type='hidden' name='id' value='<?php echo($id); ?>' />
                                <button class='submitButton' type='submit' name='submit'>Unban User</button>
                            </form>
                        <?php
                        }
                    }
                    if ($user->getConfirmed()) {
                        ?>
                        <span class='confirmed'>confirmed</span>
                    <?php
                    } else {
                        ?>
                        <span class='unconfirmed'>confirmed</span>
                        <?php
                        $id = $user->getIdUser();
                        ?>

                        <form class='confirm' name='confirm' method='post' action='./index.php?page=users'>
                            <input type='hidden' name='action' value='confirm' />
                            <input type='hidden' name='id' value='<?php echo($id); ?>' />
                            <button class="submitButton" type='submit' name='confirm'>Confirm</button>
                        </form>
                    <?php

                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <h2 id='bans'>All Bans:</h2>
            <div class='bans'>
                <?php
                $this->printBans();
                ?>
            </div>
            <?php
            echo($this->model->error);
        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {
        echo("List Of Users");
    }

    private function printBans() {
        foreach ($this->model->users as $user) {
            if ($user->getAdmin()) {
                continue;
            }
            $name = $user->getUsername();
            ?>
            <div class="userBans">
                <h3><?php echo($name); ?></h3><?php
                foreach ($this->model->bans as $ban) {
                    $userId = $user->getIdUser();
                    $banUserId = $ban->getUserId();
                    if ($userId === $banUserId) {
                        $start = $ban->getBanStart();
                        $end = $ban->getBanEnd();
                        ?>
                        <div class='ban'><?php echo($start); ?> - <?php echo($end); ?></div>
                    <?php
                    }
                }
                ?>
            </div>
        <?php
        }
    }

    private function checkBan($userId) {
        $ban = BanDAO::selectCurrentByUserId($userId);
        if ($ban->getIdBan()) {
            return $ban;
        }
        return NULL;
    }

}