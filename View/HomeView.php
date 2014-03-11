<?php

include_once 'View.php';

class HomeView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printBody() {
        global $admin;
        global $loggedIn;
        if ($admin && $loggedIn) {
            ?>
            <h2>News</h2>
            <form id='addNews' name='addNews' method='post' action='./index.php?page=newsEdit'>
                <input type='hidden' name='action' value='addNews' />
                <input type='submit' name='addNews' value='Add News' />
            </form>
        <?php
        }
        foreach ($this->model->news as $singleNews) {
            $id = (int)$singleNews->getIdEditableArea();
            $title = $singleNews->getTitle();
            $message = $singleNews->getMessage();
            ?><span class='newsTitle'><h3><?php echo $title; ?></h3></span><?php
            ?><span class='newsMessage'><?php echo $message; ?></span><?php
            ?><a class='more' href='./index.php?page=news&id=<?php echo $id; ?>'>More...</a><?php
            if ($admin && $loggedIn) {
                ?>
                <form class='deleteButton' name='deleteNews' method='post' action='./index.php?page=home'>
                    <input type='hidden' name='action' value='deleteNews' />
                    <input type='hidden' name='id' value='<?php echo $id; ?>' />
                    <input type='submit' name='deleteNews' value='Delete' />
                </form>
            <?php
            }
        }
    }

    public function printPageHeader() {
        echo("Industrial Craft - Wiki");
    }

    public function printTitle() {
        echo("Industrial Craft - Wiki");
    }

}

