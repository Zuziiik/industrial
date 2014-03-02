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
                echo <<<_END
                <form  name='editArea' method='post' action='./index.php?page=edit&item=$itemId'>
                <input type='hidden' name='action' value='editArea'/>
                <label for='title'>Title</label>
                <input id='title' type='text' name='title' value='$title'/>
                <input type='hidden' name='areaId' value='$id'/>
                <textarea name=text rows="4" cols="50" wrap='hard'>$text</textarea>
                <input type='submit' name='save' value='Save'/>
                </form>

_END;
            }
            echo $this->model->msg;
        } else {
            $itemId = $this->model->item->getIdItem();
            $itemName = $this->model->item->getName();
            $details = $this->model->item->getDetails();
            if ($this->model->msg === '') {
                echo <<<_END
                <form  name='edit' method='post' action='./index.php?page=edit&item=$itemId' enctype='multipart/form-data'>
                <input type='hidden' name='action' value='editItem'/>
                <label for='name'>Name</label>
                <input id='name' type='text' name='name' value='$itemName'/>
                <label for='image'>Image</label>
                <input type='file' id='image' name='image' size='14' maxlength='32' />
                <label for='details'>Details</label>
                <textarea name='details' id='details' wrap="hard" rows="4" cols="50">$details</textarea>
                <input type='submit' name='save' value='Save'/>
                </form>

_END;
            }
            echo $this->model->msg;
        }
    }

    public function addItem() {
        $nameCategory = $this->model->categoryName;
        if ($this->model->msg === '') {
            echo <<<_END
                <form  name='edit' method='post' action='./index.php?page=edit' enctype='multipart/form-data'>
                <input type='hidden' name='action' value='addItem'/>
                <input type='hidden' name='categoryId' value='addItem'/>
                <label for='name'>Name</label>
                <input id='name' type='text' name='name' />
                <label for='image'>Image</label>
                <input type='file' id='image' name='image' size='14' maxlength='32' />
                <input type='hidden' name='categoryName' value='$nameCategory'/> 
                <label for='details'>Details</label>
                <textarea name='details' id='details' rows="4" cols="50"></textarea>
                <input type='submit' name='save' value='Save'/>
                </form>
_END;
        }
        echo $this->model->msg;
    }

    public function addArea() {
        if ($this->model->msg === '') {
            $itemId = $this->model->item->getIdItem();
            echo <<<_END
                <form  name='addArea' method='post' action='./index.php?page=edit&item=$itemId'>
                <input type='hidden' name='action' value='addArea'/>
                <label for='title'>Title</label>
                <input id='title' type='text' name='title'/>
                <textarea name='text' rows="4" cols="50"></textarea>
                <input type='submit' name='save' value='Save'/>
                </form>
_END;
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
