<?php

include_once 'View.php';

class ServersView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Servers");
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        $i = 0;
        foreach ($this->model->servers as $server) {
            $title = $server->getTitle();
            $message = $server->getMessage();
            $date = $server->getDate();
            echo("<span class='title'>$title</span>");
            echo("<span class='date'>$date</span>");
            echo("<span class='message'>$message</span>");
            echo("<div class='comment'>");
            $this->model->commentViews[$i]->printBody();
            echo("</div>");
            $i++;
        }
        if ($loggedIn && $admin) {
            echo <<<_END
                <form id='addServer' name='addServer' method='post' action='./index.php?page=servers'>
                <input type='hidden' name='action' value='add'/>
                <label id='Ltitle' for='title'>Title:</label>
                <input type='text' id='title' name='title' />
                <textarea id='message' name='message'></textarea>
                <input id='submit' type='submit' name='addServer' value='Add'/>
                </form>
_END;
        }
    }

    public function printPageHeader() {
        echo("Servers");
    }

}