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
            $id = $category[0]->getIdCategory();
            echo $nameCategory;
            if ($loggedin && $admin) {
                echo<<<_END
                <form name='deleteCategory' method='post' action='./index.php?page=recipes'>
                <input type='hidden' name='categoryDelete' value='$id'/>
                <input type='submit' name='deleteCategory' value='Delete category'/>
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
                echo("<div class='itemName'><a href='./index.php?page=item&item=$id'>$name</a></div>");
                echo("<div class='itemDetails'>$details</div>");
                if ($loggedin && $admin) {
                    echo<<<_END
                    <form name='deleteItem' method='post' action='./index.php?page=recipes'>
                    <input type='hidden' name='action' value='deleteItem'/>
                    <input type='hidden' name='itemId' value='$id'/>    
                    <input type='submit' name='DeleteItem' value='Delete item'/>
                    </form>
_END;
                }
                echo("</div>");
                //TODO edit item
            }
            if ($loggedin && $admin) {
                echo<<<_END
            <form name='addItem' method='post' action='./index.php?page=edit'>
            <input type='hidden' name='action' value='addItem'/>
            <input type='hidden' name='categoryName' value='$nameCategory'/>    
            <input type='submit' name='AddItem' value='Add item'/>
            </form>
_END;
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
        echo("Recipes & Resources");
    }

    public function printTitle() {
        echo("Recipes & Resources");
    }

}
