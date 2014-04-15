<?php

include_once 'View.php';

class NewsView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printNavigation() {
        $title = $this->model->news->getTitle();
        ?>
        <li><a href='.'>Home</a></li>
        <li class="active">News - <?php echo($title); ?></li><?php
    }

    public function printTitle() {
        $title = $this->model->news->getTitle();
        echo("Industrial Craft Experimental - Wiki - " . $title);
    }

    public function printBody() {
        global $admin;
        global $loggedIn;
        $title = $this->model->news->getTitle();
        $message = $this->model->news->getMessage();

        ?>

        <h2><?php echo($title); ?></h2>

        <div class='newsMessage'><?php echo($message); ?>
            <?php
            if ($admin && $loggedIn) {
                $id = (int)$this->model->news->getIdEditableArea();
                ?>
                <form class='editNews' name='editNews' method='post' action='./index.php?page=newsEdit'>
                    <input type='hidden' name='action' value='editNews' />
                    <input type='hidden' name='id' value='<?php echo($id); ?>' />
                    <button class="submitButton" type='submit' name='editNews'>Edit</button>
                </form>
            <?php
            }
            ?>
        </div>
    <?php
    }

    public function printPageHeader() {

    }

}