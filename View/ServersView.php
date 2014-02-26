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
            $id = $server->getIdEditableArea();
            echo("<div class='server'>");
            echo("<span class='title'><h2>$title</h2></span>");
            echo("<span class='message'>$message</span>");
            if ($loggedIn && $admin) {
                echo <<<_END
                <form id='deleteServer' name='deleteServer' method='post' action='./index.php?page=servers'>
                <input type='hidden' name='action' value='deleteServer'/>
                <input type='hidden' name='ServerId' value='$id'/>
                <input class='submit' type='submit' name='deleteServer' value='Delete Server'/>
                </form>
_END;
            }
            $this->model->commentViews[$i]->printBody();
            $i++;

            if ($loggedIn) {
                $type = Comment::SERVER;
                echo <<<_END
                <form id='addComment' name='addComment' method='post' action='./index.php?page=servers'>
                <input type='hidden' name='action' value='addComment'/>
                <input type='hidden' name='targetId' value='$id'/>
                <input type='hidden' name='type' value='$type'/>
                <label id='Ltitle' for='title'>Title:</label>
                <input type='text'  id='title' name='title' />
                <label id='Lmessage' for='message'>Message:</label>
                <textarea id='message' cols='45' rows='4' name='message'></textarea>
                <input class='submit' type='submit' name='addComment' value='Comment'/>
                </form>
_END;
            }
            echo("</div>");
        }

        if ($loggedIn && $admin) {
            echo <<<_END
                <form id='addServer' name='addServer' method='post' action='./index.php?page=servers'>
                <input type='hidden' name='action' value='addServer'/>
                <label id='Ltitle' for='title'>Title:</label>
                <input type='text' id='title' name='title' />
                <textarea id='message' cols='100' rows='6' name='message'></textarea>
                <input class='submit' type='submit' name='addServer' value='Add Server'/>
                </form>
_END;
        }
    }

    public function printPageHeader() {
        echo("Servers");
    }

}