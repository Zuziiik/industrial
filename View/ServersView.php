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
        if ($loggedIn && $admin) {
            echo <<<_END
                <form id='addServer' name='addServer' method='post' action='./index.php?page=editServer'>
                <input type='hidden' name='action' value='addServer'/>
                <input class='submit' type='submit' name='addServer' value='Add Server'/>
                </form>
_END;
        }
        $i = 0;
        foreach ($this->model->servers as $server) {
            $title = $server->getTitle();
            $message = $server->getMessage();
            $id = (int)$server->getIdEditableArea();
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

                <form id='editServer' name='editServer' method='post' action='./index.php?page=editServer'>
                <input type='hidden' name='action' value='editServer'/>
                <input type='hidden' name='ServerId' value='$id'/>
                <input class='submit' type='submit' name='editServer' value='Edit Server'/>
                </form>
_END;
            }
            $this->model->commentViews[$i]->printBody();
            $i++;

            if ($loggedIn) {
                $type = Comment::SERVER;
                echo <<<_END
                <form id='addComment' name='addComment' method='post' action='./index.php?page=comment'>
                <input type='hidden' name='action' value='addComment'/>
                <input type='hidden' name='targetId' value='$id'/>
                <input type='hidden' name='type' value='$type'/>
                <input class='submit' type='submit' name='addComment' value='Comment'/>
                </form>
_END;
            }
            echo("</div>");
        }

    }

    public function printPageHeader() {
        echo("Servers");
    }

}