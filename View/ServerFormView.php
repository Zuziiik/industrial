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
                ?>
                <form name='addServer' method='post' action='./index.php?page=editServer'>
                    <input type='hidden' name='action' value='addServer' />
                    <input id='title' type='text' placeholder="Title" name='title' autofocus />
                    <textarea class='addForm' id='message' cols='30' rows='6' name='message'></textarea>
                    <input class='save' type='submit' name='save' value='Save' />
                </form>
            <?php
            }
            if ($this->model->edit) {
                $message = $this->model->server->getMessage();
                $title = $this->model->server->getTitle();
                $id = $this->model->server->getIdEditableArea();
                ?>
                <form name='editServer' method='post' action='./index.php?page=editServer'>
                    <input type='hidden' name='action' value='editServer' />
                    <input type='hidden' name='ServerId' value='<?php echo $id; ?>' />
                    <input id='title' type='text' placeholder="Title" name='title' autofocus
                           value=' <?php echo $title; ?>' />
                    <textarea class='editForm' id='message' cols='30' rows='6'
                              name='message'><?php echo $message; ?></textarea>
                    <input class='save' type='submit' name='save' value='Save' />
                </form>
            <?php
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