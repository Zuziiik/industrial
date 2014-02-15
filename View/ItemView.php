<?php

include_once 'View.php';

class ItemView extends View {
    

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        
    }

    public function printBody() {
        global $loggedin;
        if($loggedin){
            echo<<<_END
            <form name='editItem' method='post' action='./index.php?page=item'>
            <input type='hidden' name='action' value='edit'/>
            <input type='submit' name='edit' value='Edit'/>
            </form>
_END;
        }
        $details = $this->model->item->getDetails();
        $this->printSubsectionHeader("Details", 2);
        echo("<div class='itemDetails'>");
        echo($details);
        echo("</div>");
    }

    public function printPageHeader() {
        $name = $this->model->item->getName();
        if ($name != '') {
            echo($name);
        } else {
            echo("Add Item");
        }
    }
    
    public function printSubsectionHeader($name, $weight){
        echo("<h");
        echo($weight);
        echo(">");
        echo($name);
         echo("</h");
        echo($weight);
        echo(">");
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
