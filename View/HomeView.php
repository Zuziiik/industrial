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
            <form class="pull-right" name='addNews' method='post' action='./index.php?page=newsEdit'>
                <input type='hidden' name='action' value='addNews' />
                <button class='btn btn-default' type='submit' name='addNews'>Add news</button>
            </form>
        <?php
        }
        ?>
        <h2>News</h2>
        <?php

        foreach ($this->model->news as $singleNews) {
            $id = (int)$singleNews->getIdEditableArea();
            $title = $singleNews->getTitle();
            $message = $singleNews->getMessage();
            $message = substr($message, 0, 500);
            ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $title; ?></h3>
                    </div>
                    <div class="panel-body"><?php echo $message; ?><?php
                        ?><a class='btn btn-xs btn-default ' href='./index.php?page=news&id=<?php echo $id; ?>'>
                            More &rsaquo;&rsaquo;&rsaquo;</a>
                        <?php
                        if ($admin && $loggedIn) {
                            ?>
                            <form class="pull-right" name='deleteNews' method='post' action='./index.php?page=home'>
                                <input type='hidden' name='action' value='deleteNews' />
                                <input type='hidden' name='id' value='<?php echo $id; ?>' />
                                <button class='btn btn-default' type='submit' name='deleteNews'> Delete</button>
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
        <?php
        }
    }

    public function printNavigation() {
        ?>
        <li class="active">Home</li><?php
    }

    public function printPageHeader() {
    }

    public function printTitle() {
        echo("Industrial Craft Experimental - Wiki");
    }

}

