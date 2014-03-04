<?php

include_once 'View.php';

class TutorialView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        $title = $this->model->tutorial->getTitle();
        echo($title);
    }

    public function printBody() {
        global $admin;
        global $loggedIn;
        $id = (int)$this->model->tutorial->getIdEditableArea();
        if ($admin && $loggedIn) {
            ?>
            <form id='editTutorial' name='edit' method='post'
                  action='./index.php?page=tutorialEdit&id=<?php echo $id; ?>'>
                <input type='hidden' name='action' value='editTutorial' />
                <input type='submit' name='editTutorial' value='Edit' />
            </form>
        <?php
        }
        $title = $this->model->tutorial->getTitle();
        $message = $this->model->tutorial->getMessage();

        echo("<span class='tutorialTitle'><h2>$title</h2></span>");
        echo("<span class='tutorialMessage'>$message</span>");

        $this->model->commentView->printBody();

        if ($loggedIn) {
            $type = Comment::TUTORIAL;
            ?>
            <form id='addComment' name='addComment' method='post' action='./index.php?page=comment'>
                <input type='hidden' name='action' value='addComment' />
                <input type='hidden' name='targetId' value='<?php echo $id; ?>' />
                <input type='hidden' name='type' value='<?php echo $type; ?>' />
                <input class='submit' type='submit' name='addComment' value='Comment' />
            </form>
        <?php
        }
    }

    public function printPageHeader() {
        $title = $this->model->tutorial->getTitle();
        echo($title);
    }

}