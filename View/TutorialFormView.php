<?php

class TutorialFormView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        if ($this->model->edit) {
            echo("Edit Tutorial");
        } else {
            echo("Add Tutorial");
        }
    }

    public function printBody() {
        global $admin;
        global $loggedIn;
        if ($admin && $loggedIn) {
            if ($this->model->edit) {
                $id = (int)$this->model->tutorial->getIdEditableArea();
                $title = $this->model->tutorial->getTitle();
                $message = $this->model->tutorial->getMessage();

                echo <<<_END
                <form class='editTutorial'  name='edit' method='post' action='./index.php?page=tutorialEdit&id=$id'>
                <input type='hidden' name='action' value='editTutorial'/>
                <label>Title:<input type='text' name='title' value='$title'/></label>
                <textarea class='EditForm' name='text' id='tutorialText' rows="50" cols="30">$message</textarea>
                <input type='submit' class='save' name='save' value='Save'/>
                </form>

_END;
            } else {
                echo <<<_END

                <form id='addTutorial'  name='addTutorial' method='post' action='./index.php?page=tutorialEdit'>
                <input type='hidden' name='action' value='addTutorial'/>
                <label>Title:<input type='text' name='title' /></label>
                <textarea class='addForm' name='text' id='tutorialText' rows="50" cols="30"></textarea>
                <input type='submit' class='save' name='save' value='Save'/>
                </form>


_END;
            }
        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {
        if ($this->model->edit) {
            echo("Edit Tutorial");
        } else {
            echo("Add Tutorial");
        }
    }

} 