<?php

include_once 'View.php';

class ServerFormView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        
    }

    public function printTitle() {
        if ($this->model->edit) {
            echo("Edit Server");
        } else {
            echo("Add Server");
        }
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            if ($this->model->add) {
                echo <<<_END
                <form  name='addServer' method='post' action='./index.php?page=editServer'>
                <input type='hidden' name='action' value='addServer'/>
                <label>Title:<input type='text' name='title' /></label>
                <textarea class='addForm' id='message' cols='30' rows='6' name='message'></textarea>
                <input class='save' type='submit' name='save' value='Save'/>
                </form>
_END;
            }
            if ($this->model->edit) {
                $message = $this->model->server->getMessage();
                $title = $this->model->server->getTitle();
                $id = $this->model->server->getIdEditableArea();
                echo <<<_END
                <form name='editServer' method='post' action='./index.php?page=editServer'>
                <input type='hidden' name='action' value='editServer'/>
                <input type='hidden' name='ServerId' value='$id'/>
                <label>Title:<input type='text' name='title' value='$title' /></label>
                <textarea class='editForm'  id='message' cols='30' rows='6' name='message'>$message</textarea>
                <input class='save' type='submit' name='save' value='Save'/>
                </form>
_END;
            }
        }
    }

    public function printPageHeader() {
        if ($this->model->edit) {
            echo("Edit Server");
        } else {
            echo("Add Server");
        }
    }

}