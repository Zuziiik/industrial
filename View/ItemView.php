<?php

include_once 'View.php';

class ItemView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        $itemId = $this->model->item->getIdItem();
        if ($admin && $loggedIn) {
            ?>
            <form name='editItem' method='post' action='./index.php?page=edit&item=<?php echo $itemId; ?>'>
                <input type='hidden' name='action' value='editItem' />
                <input type='submit' name='editItem' value='Edit Item' />
            </form>
        <?php
        }
        foreach ($this->model->editArea as $area) {
            $title = $area->getTitle();

            echo("<div class='itemTextArea'>");
            $this->printSubsectionHeader($title);
            $text = $area->getMessage();
            $date = $area->getDate();
            $this->printTextArea($text, $date);
            $id = $area->getIdEditableArea();
            if ($loggedIn && $admin) {

                ?>
                <div class='buttonsItemEditArea'>
                    <form name='editItem' method='post' action='./index.php?page=edit&item=<?php echo $itemId; ?>'>
                        <input type='hidden' name='action' value='editArea' />
                        <input type='hidden' name='areaId' value='<?php echo $id; ?>' />
                        <input type='submit' name='editArea' value='Edit' />
                    </form>

                    <form name='deleteItemEdit' method='post'
                          action='./index.php?page=item&item=<?php echo $itemId; ?>'>
                        <input type='hidden' name='action' value='delete' />
                        <input type='hidden' name='areaId' value='<?php echo $id; ?>' />
                        <input type='submit' name='delete' value='Delete' />
                    </form>

                    <form name='changeWeight' method='post' action='./index.php?page=item&item=<?php echo $itemId; ?>'>
                        <input type='hidden' name='action' value='moveUp' />
                        <input type='hidden' name='areaId' value='<?php echo $id; ?>' />
                        <input class='imageButton' type='image' name='up' src='pictures/up.jpg' alt='move up' />
                    </form>

                    <form name='changeWeight' method='post' action='./index.php?page=item&item=<?php echo $itemId; ?>'>
                        <input type='hidden' name='action' value='moveDown' />
                        <input type='hidden' name='areaId' value='<?php echo $id; ?>' />
                        <input class='imageButton' type='image' name='down' src='pictures/down.jpg' alt='move down' />
                    </form>
                </div>
            <?php
            }
            echo("</div>");

            echo($this->model->msg);
        }
        if ($loggedIn && $admin) {
            ?>
            <form id='addSection' name='addSection' method='post'
                  action='./index.php?page=edit&item=<?php echo $itemId; ?>'>
                <input type='hidden' name='action' value='addArea' />
                <input type='submit' name='addArea' value='Add section' />
            </form>
        <?php
        }
    }

    public function printPageHeader() {
        $name = $this->model->item->getName();
        if ($name != '') {
            echo($name);
        } else {
            echo("Add Item");
        }
    }

    public function printTextArea($text, $date) {
        echo("<article>" . $text . "</article>" . "<span class='date'>" . $date . "</span>");
    }

    public function printSubsectionHeader($name) {
        echo("<h2>");
        echo($name);
        echo("</h2>");
    }

    public function printTitle() {
        $name = $this->model->item->getName();
        if ($name != '') {
            echo($name);
        } else {
            echo("Add Item");
        }
    }

}
