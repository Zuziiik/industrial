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
        global $loggedIn;
        if ($loggedIn && $admin) {
            echo($this->model->error);
            ?>
            <form id='addCategory' name='addCategory' method='post' action='./index.php?page=recipes'>
                <label for='category'>Add category</label>
                <input id='category' type='text' name='categoryName' />
                <input type='submit' value='Add' />
            </form>
        <?php
        }
        echo("<div id='itemList'>");
        foreach ($this->model->categories as $category) {
            echo("<div class='category'>");
            echo("<span class='categoryName'>");
            $nameCategory = $category[0]->getName();
            $id = $category[0]->getIdCategory();
            echo $nameCategory;
            if ($loggedIn && $admin) {
                ?>
                <form name='deleteCategory' method='post' action='./index.php?page=recipes'>
                    <input type='hidden' name='categoryDelete' value='<?php echo $id; ?>' />
                    <input type='submit' name='deleteCategory' value='Delete category' />
                </form>
            <?php
            }
            echo("</span>");
            foreach ($category[1] as $item) {
                echo("<div class='item'>");
                $id = $item->getIdItem();
                $name = $item->getName();
                $details = $item->getDetails();
                echo("<img class='itemIcon' src='image.php?type=item&id=$id'>");
                echo("<a class='itemName' href='./index.php?page=item&item=$id'>$name</a>");
                echo("<div class='itemDetails'>$details</div>");
                if ($loggedIn && $admin) {
                    ?>
                    <form class='DeleteItem' name='deleteItem' method='post' action='./index.php?page=recipes'>
                        <input type='hidden' name='action' value='deleteItem' />
                        <input type='hidden' name='itemId' value='<?php echo $id; ?>' />
                        <input type='submit' name='DeleteItem' value='Delete item' />
                    </form>
                <?php
                }
                echo("</div>");

            }
            echo("</div>");
            if ($loggedIn && $admin) {
                ?>
                <form class='AddItem' name='addItem' method='post' action='./index.php?page=edit'>
                    <input type='hidden' name='action' value='addItem' />
                    <input type='hidden' name='categoryName' value='<?php echo $nameCategory; ?>' />
                    <input type='submit' name='AddItem' value='Add item' />
                </form>
            <?php
            }

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
