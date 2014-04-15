<?php

include_once 'View.php';

class TutorialListView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Industrial Craft Experimental - Wiki - Tutorials");
    }

    public function printNavigation() {
        ?>
        <li class="active">Tutorials</li><?php
    }

    public function printBody() {
        global $admin;
        global $loggedIn;
        if ($admin && $loggedIn) {
            ?>
            <form id='addTutorial' name='addTutorial' method='post' action='./index.php?page=tutorialEdit'>
                <input type='hidden' name='action' value='addTutorial' />
                <button class="submitButton" type='submit' name='addTutorial'>Add Tutorial</button>
            </form>
        <?php
        }
        foreach ($this->model->tutorials as $tutorial) {
            $id = (int)$tutorial->getIdEditableArea();
            $title = $tutorial->getTitle();
            $message = $tutorial->getMessage();
            $message = substr($message, 0, 300);
            ?>
            <div class="frame">
                <h2><?php echo($title); ?></h2>

                <div class='tutorialMessage'><?php echo($message); ?>
                    <a class='more' href='./index.php?page=tutorial&id=<?php echo($id); ?>'>More...</a><?php
                    if ($admin && $loggedIn) {
                        ?>
                        <form name='deleteTutorial' method='post' action='./index.php?page=tutorialList'>
                            <input type='hidden' name='action' value='deleteTutorial' />
                            <input type='hidden' name='id' value='<?php echo($id); ?>' />
                            <button class="submitButton" type='submit' name='deleteTutorial'>Delete</button>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
    }

    public function printPageHeader() {
        echo("Tutorials");
    }

}