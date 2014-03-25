<?php

include_once 'View.php';

class NewsView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        $title = $this->model->news->getTitle();
        echo $title;
    }

    public function printBody() {
        global $admin;
        global $loggedIn;
        $title = $this->model->news->getTitle();
        $message = $this->model->news->getMessage();
        if ($admin && $loggedIn) {
            $id = (int)$this->model->news->getIdEditableArea();
            ?>
            <form class='editNews' name='editNews' method='post' action='./index.php?page=newsEdit'>
                <input type='hidden' name='action' value='editNews' />
                <input type='hidden' name='id' value='<?php echo $id; ?>' />
                <input type='submit' name='editNews' value='Edit' />
            </form>
        <?php
        }
        ?>

        <h2><?php echo $title; ?></h2>
        <span class='newsMessage'><?php echo $message; ?></span>
    <?php
    }

    public function printPageHeader() {
        $title = $this->model->news->getTitle();
        echo $title;
    }

}