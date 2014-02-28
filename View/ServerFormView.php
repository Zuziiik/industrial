<?php

include_once 'View.php';

class ServerFormView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        // TODO: Implement initialize() method.
    }

    public function printTitle() {
        // TODO: Implement printTitle() method.
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            if($this->model->add){
                echo <<<_END
                <form id='addServer' name='addServer' method='post' action='./index.php?page=editServer'>
                <input type='hidden' name='action' value='addServer'/>
                <label id='Ltitle' for='title'>Title:</label>
                <input type='text' id='title' name='title' />
                <textarea id='message' cols='100' rows='6' name='message'></textarea>
                <input class='submit' type='submit' name='save' value='Save'/>
                </form>
_END;
            }
            if($this->model->edit){
                $message = $this->model->server->getMessage();
                $title = $this->model->server->getTitle();
                $id = $this->model->server->getIdEditableArea();
                echo <<<_END
                <form id='editServer' name='editServer' method='post' action='./index.php?page=editServer'>
                <input type='hidden' name='action' value='editServer'/>
                <input type='hidden' name='ServerId' value='$id'/>
                <label id='Ltitle' for='title'>Title:</label>
                <input type='text' id='title' name='title' value='$title' />
                <textarea id='message' cols='100' rows='6' name='message'>$message</textarea>
                <input class='submit' type='submit' name='save' value='Save'/>
                </form>
_END;
            }
        }
    }

    public function printPageHeader() {
        // TODO: Implement printPageHeader() method.
    }

}