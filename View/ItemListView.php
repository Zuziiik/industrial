<?php

include_once 'View.php';

class ItemListView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        
    }

    public function printBody() {
        echo("<div id='itemList'>");
        foreach ($this->model->categories as $category) {
            echo("<div class='category'>");
            echo("<span class='categoryName'>");
            echo $category[0]->getName();
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
        echo("</div>");
    }

    public function printPageHeader() {
        
    }

    public function printTitle() {
        echo("Recipes & Resources");
    }

}
