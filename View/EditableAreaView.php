<?php

include_once 'View.php';

class EditableAreaView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        
    }

    public function printBody() {
        global $loggedin;
        global $admin;
        if (!$loggedin) {
            echo("<div class='error'>You're not logged in.</div>");
        } else {
            if (!$admin) {
                echo("<div class='error'>You must be admin to edit.</div>");
            } else {
                // loggedin and admin
                $this->edit();
            }
        }
    }

    public function edit() {
        if ($this->model->area) {
            //edit one subsection of item 
            $itemId = $this->model->item->getIdItem();
            $title = $this->model->area->getTitle();
            $id = $this->model->area->getIdEditableArea();
            $text = $this->model->area->getText();
            if($this->model->msg===''){
            echo<<<_END
           <form  name='editArea' method='post' action='./index.php?page=edit&item=$itemId'>
                <label for='title'>Title</label>
                <input id='title' type='text' name='title' value='$title'/>
                <input type='hidden' name='areaId' value='$id'/>
                <textarea name=text rows="4" cols="50">$text</textarea>
                <input type='submit' name='editArea' value='Edit'/>
                </form>
_END;
            }
            echo $this->model->msg;
        } else {
            //eddit whole item
        }
    }

    public function printPageHeader() {
        $itemName = $this->model->item->getName();
        echo("Edit " . $itemName);
    }

    public function printTitle() {
        $itemName = $this->model->item->getName();
        echo("Edit " . $itemName);
    }

}
