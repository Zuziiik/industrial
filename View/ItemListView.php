<?php

include_once 'View.php';

class ItemListView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        
    }

    public function printBody() {
        global $admin;
        global $loggedin;
        echo("<div id='itemList'>");
        foreach ($this->model->categories as $category) {
            echo("<div class='category'>");
            echo("<span class='categoryName'>");
            $nameCategory = $category[0]->getName();
            echo $nameCategory;
            if ($loggedin && $admin) {
                echo<<<_END
                <form name='deleteCategory' method='post' action='./index.php?page=recipes'>
                <input type='hidden' name='categoryDelete' value='$nameCategory'/>
                <input type='submit' name='deleteCategory' value='Delete'/>
                </form>
_END;
            }
            echo("</span>");
            foreach ($category[1] as $item) {
                echo("<div class='item'>");
                $id = $item->getIdItem();
                $name = $item->getName();
                $details = $item->getDetails();
                echo("<div class='picture'><img src='image.php?type=item&id=$id'></div>");
                echo("<div class='itemName'>$name</div>");
                echo("<div class='itemDetails'>$details</div>");
                echo("</div>");
            }
            echo("</div>");
        }
        if ($loggedin && $admin) {
            echo($this->model->error);
            echo<<<_END
            <form name='addCategory' method='post' action='./index.php?page=recipes'>
            <label for='category'>Add category</label>
            <input id='category' type='text' name='categoryName'/>
            <input type='submit' value='Add'/>
            </form>
_END;
        }
        echo("</div>");
    }

    public function printPageHeader() {
        
    }

    public function printTitle() {
        echo("Recipes & Resources");
    }

}
