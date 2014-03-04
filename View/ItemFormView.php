<?php

include_once 'View.php';

class ItemFormView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if (!$loggedIn) {
            echo("<div class='error'>You're not logged in.</div>");
        } else {
            if (!$admin) {
                echo("<div class='error'>You must be admin to add or edit.</div>");
            } else {
                // loggedIn and admin
                $this->addOrEdit();
            }
        }
    }

    public function addOrEdit() {
        if (!$this->model->addItem && !$this->model->addArea) {
            $this->edit();
        } else {
            if ($this->model->addArea) {
                $this->addArea();
            } else {
                $this->addItem();
            }
        }
    }

    public function edit() {
        if ($this->model->area) {
            //edit one subsection of item 
            $itemId = $this->model->item->getIdItem();
            $title = $this->model->area->getTitle();
            $id = $this->model->area->getIdEditableArea();
            $text = $this->model->area->getMessage();
            if ($this->model->msg === '') {
                ?>
                <form name='editArea' method='post' action='./index.php?page=edit&item=<?php echo $itemId; ?>'>
                    <input type='hidden' name='action' value='editArea' />
                    <input id='title' type='text' placeholder="Title" name='title' autofocus
                           value='<?php echo $title; ?>' />
                    <input type='hidden' name='areaId' value='<?php echo $id; ?>' />
                    <textarea class='editForm' name=text rows="4" cols="50" wrap='hard'><?php echo $text; ?></textarea>
                    <input class='save' type='submit' name='save' value='Save' />
                </form>

            <?php
            }
            echo $this->model->msg;
        } else {
            $itemId = $this->model->item->getIdItem();
            $itemName = $this->model->item->getName();
            $details = $this->model->item->getDetails();
            if ($this->model->msg === '') {
                ?>
                <form name='edit' method='post' action='./index.php?page=edit&item=<?php echo $itemId; ?>'
                      enctype='multipart/form-data'>
                    <input type='hidden' name='action' value='editItem' />
                    <input id='name' type='text' name='name' placeholder="Name" autofocus
                           value='<?php echo $itemName; ?>' />
                    <label for='image'>Icon</label>
                    <input type='file' id='image' name='image' size='14' maxlength='32' />
                    <textarea class='editForm' name='details' id='details' wrap="hard" placeholder="Details" rows="4"
                              cols="50"><?php echo $details; ?></textarea>
                    <input class='save' type='submit' name='save' value='Save' />
                </form>

            <?php
            }
            echo $this->model->msg;
        }
    }

    public function addItem() {
        $nameCategory = $this->model->categoryName;
        if ($this->model->msg === '') {
            ?>
            <form name='add' method='post' action='./index.php?page=edit' enctype='multipart/form-data'>
                <input type='hidden' name='action' value='addItem' />
                <input type='hidden' name='categoryId' value='addItem' />
                <input id='name' type='text' name='name' placeholder="Name" />
                <label for='image'>Icon</label>
                <input type='file' id='image' name='image' size='14' maxlength='32' />
                <input type='hidden' name='categoryName' value='<?php echo $nameCategory; ?>' />
                <textarea class='addForm' name='details' id='details' rows="4" cols="50">Add details.</textarea>
                <input class='save' type='submit' name='save' value='Save' />
            </form>
        <?php
        }
        echo $this->model->msg;
    }

    public function addArea() {
        if ($this->model->msg === '') {
            $itemId = $this->model->item->getIdItem();
            ?>
            <form name='addArea' method='post' action='./index.php?page=edit&item=<?php echo $itemId; ?>'>
                <input type='hidden' name='action' value='addArea' />
                <input id='title' type='text' placeholder="Title" name='title' autofocus />
                <textarea class='addForm' name='text' rows="4" cols="50"></textarea>
                <input class='save' type='submit' name='save' value='Save' />
            </form>
        <?php
        }
        echo $this->model->msg;
    }

    public function printPageHeader() {
        if ($this->model->addItem) {
            echo("Add item");
        } else {
            if ($this->model->addArea) {
                echo("Add section");
            }
            $itemName = $this->model->item->getName();
            echo("Edit " . $itemName);
        }
    }

    public function printTitle() {
        if ($this->model->addItem) {
            echo("Add item");
        } else {
            if ($this->model->addArea) {
                echo("Add section");
            }
            $itemName = $this->model->item->getName();
            echo("Edit " . $itemName);
        }
    }

}
