<?php

include_once 'View.php';

class ItemListView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printNavigation() {
        ?>
        <li class="active">Recipes & Resources</li><?php
    }

    public function printBody() {

        global $admin;
        global $loggedIn;
        echo($this->model->error);
        ?>
        <h2>Recipes & Resources</h2>
        <form method='post' action='./index.php?page=recipes'>
            <input type='hidden' name='action' value='filter' />
            <label>Filter items: <select class="form-control default" name="items">
                    <option selected>Industrial</option>
                    <option>Vanilla</option>
                    <option>All</option>
                </select></label>
            <button class="btn btn-default " type='submit' name='filter'>Filter</button>
        </form>
        <?php
        if ($admin && $loggedIn) {
            ?>
            <form name='addCategory' method='post' action='./index.php?page=recipes'>
                <div class="form-group">
                    <label class="col-xs-5 col-sm-3 col-md-2 col-lg-2 control-label" for="categoryName">Add
                        Category</label>

                    <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2">
                        <input type="text" class="form-control" name='categoryName' id="categoryName"></div>
                </div>
                <button class="btn btn-default" type='submit'>Add</button>
            </form>
        <?php
        }

        echo("<div id='itemList'>");
        foreach ($this->model->categories as $category) {
            ?>
            <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                <table class="table ">

                    <?php
                    $nameCategory = $category[0]->getName();
                    $id = $category[0]->getIdCategory();
                    ?>
                    <caption class="col-5 col-sm-5 col-md-5 col-lg-5 active"><h3><?php echo($nameCategory); ?></h3>
                    </caption>
                    <tr>
                        <th class="field-label col-5 col-sm-5 col-md-5 col-lg-5 active">
                            <label>Icon</label>
                        </th>
                        <th class="field-label col-5 col-sm-5 col-md-5 col-lg-5 active">
                            <label>Name</label>
                        </th>
                        <th class="field-label col-5 col-sm-5 col-md-5 col-lg-5 active">
                            <label>Details</label>
                        </th>
                        <th class="col-5 col-sm-5 col-md-5 col-lg-5">
                            <?php
                            if ($loggedIn && $admin) {
                                ?>
                                <form>
                                    <form name='deleteCategory' method='post' action='./index.php?page=recipes'>
                                        <input type='hidden' name='categoryDelete' value='<?php echo($id); ?>' />
                                        <button class="btn btn-default btn-sm " type='submit' name='deleteCategory'>
                                            Delete
                                            Category
                                        </button>
                                    </form>
                                </form>
                            <?php
                            }
                            ?>
                        </th>
                        <th class="col-5 col-sm-5 col-md-5 col-lg-5">
                            <?php
                            if ($loggedIn && $admin) {
                                ?>
                                <form class="addItem" name='addItem' method='post' action='./index.php?page=edit'>
                                    <input type='hidden' name='action' value='addItem' />
                                    <input type='hidden' name='categoryName' value='<?php echo($nameCategory); ?>' />
                                    <button class="btn btn-default btn-sm" type='submit' name='AddItem'>Add Item
                                    </button>
                                </form>

                            <?php
                            }
                            ?>
                        </th>
                    </tr>
                    <?php

                    foreach ($category[1] as $item) {
                        $id = $item->getIdItem();
                        $name = $item->getName();
                        $details = $item->getDetails();
                        ?>
                        <tr>
                            <td class="col-5 col-sm-5 col-md-5 col-lg-5 ">
                                <img src="image.php?type=item&id=<?php echo($id); ?>" alt="<?php echo($name); ?>'s icon"
                                     class="img-thumbnail" style="width: 3em; height: 3em;">
                            </td>
                            <td class="col-5 col-sm-5 col-md-5 col-lg-5 ">
                                <h4><a class='btn btn-sm btn-default itemButton'
                                       href='./index.php?page=item&item=<?php echo($id); ?>'>
                                        <?php echo($name); ?></a></h4>

                            </td>
                            <td class="col-5 col-sm-5 col-md-5 col-lg-5 ">
                                <?php echo($details); ?>
                            </td>
                            <td class="col-5 col-sm-5 col-md-5 col-lg-5">
                                <?php
                                if ($loggedIn && $admin) {
                                    ?>
                                    <form name='deleteItem' method='post' action='./index.php?page=recipes'>
                                        <input type='hidden' name='action' value='deleteItem' />
                                        <input type='hidden' name='itemId' value='<?php echo($id); ?>' />
                                        <button class="btn btn-sm btn-default" type='submit' name='DeleteItem'>Delete
                                        </button>
                                    </form>
                                <?php
                                }
                                ?>

                            </td>
                            <td class="col-5 col-sm-5 col-md-5 col-lg-5">

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        <?php

        }

        echo("</div>");
    }

    public function printPageHeader() {
    }

    public function printTitle() {
        echo("Industrial Craft Experimental - Wiki - Recipes & Resources");
    }

}
