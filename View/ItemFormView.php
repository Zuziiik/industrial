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
        if (!$loggedIn && !$admin) {
            echo($this->model->error);
        } else {
            // loggedIn and admin
            $this->addOrEdit();
        }
    }

    public function printNavigation() {
        if ($this->model->addItem) {
            ?>
            <li><a href='index.php?page=recipes'>Recipes & Resources</a></li>
            <li class="active">Add Item</li><?php
        } else {
            $itemName = $this->model->item->getName();
            $itemId = $this->model->item->getIdItem();
            if ($this->model->addArea) {
                ?>
                <li><a href='index.php?page=recipes'>Recipes & Resources</a></li>
                <li><a
                        href='index.php?page=item&item=<?php echo($itemId); ?>'><?php echo($itemName); ?></a></li>
                <li class="active">add Section</li><?php
            } else {
                ?>
                <li><a href='index.php?page=recipes'>Recipes & Resources</a></li>
                <li><a
                        href='index.php?page=item&item=<?php echo($itemId); ?>'><?php echo($itemName); ?></a></li>
                <li class="active">edit <?php echo($itemName); ?></li><?php
            }
        }
    }

    public function addOrEdit() {
        if (!$this->model->addItem && !$this->model->addArea) {
            $this->edit();
        } else {
            if ($this->model->addArea) {
                ?><h2>Add section</h2><?php
                $this->addArea();
            } else {
                ?><h2>Add item</h2><?php
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
            ?>
            <h2>Edit <?php echo($title); ?></h2>
            <form name='editArea' method='post' action='./index.php?page=edit&item=<?php echo($itemId); ?>'>
                <input type='hidden' name='action' value='editArea' />
                <input id='title' type='text' placeholder="Title" name='title'
                       value='<?php echo $title; ?>' />
                <input type='hidden' name='areaId' value='<?php echo $id; ?>' />
                <textarea class='editForm' name=text rows="4" cols="50" wrap='hard'><?php echo($text); ?> </textarea>
                <button class='btn btn-default' type='submit' name='save'>Save</button>
            </form>

        <?php
        } else {
            $itemId = $this->model->item->getIdItem();
            $itemName = $this->model->item->getName();
            $details = $this->model->item->getDetails();
            $industrial = $this->model->item->getIndustrial();
            ?>
            <h2>Edit <?php echo($itemName); ?></h2>
            <form name='edit' method='post' action='./index.php?page=edit&item=<?php echo($itemId); ?>'
                  enctype='multipart/form-data'>
                <input type='hidden' name='action' value='editItem' />
                <label>Name <input id='title' class="form-control" type='text' name='name'
                                   value='<?php echo($itemName); ?>' /></label>
                <?php
                if ($industrial) {
                    ?>
                    <div id='item-link' class="hidden">
                        <label>Link <input class="form-control" type='text' name='link' autofocus /></label>
                    </div>
                    <label>Industrial Item <input id="item-industrial" type="checkbox" name="industrial"
                                                  checked /></label></br>
                <?php
                } else {
                    ?>
                    <div id='item-link'>
                        <label>Link <input class="form-control" type='text' name='link' autofocus /></label>
                    </div>
                    <label>Industrial Item <input id="item-industrial" type="checkbox" name="industrial" /></label></br>

                <?php
                }
                ?>
                <label>Icon
                    <input name="image" type="file" title="Search..." >
                </label>
                <textarea class='editForm' name='details' id='details' wrap="hard" placeholder="Details" rows="4"
                          cols="50"><?php echo($details); ?></textarea>
                <button class='btn btn-default btn-sm' type='submit' name='save'>Save</button>
                <script>
                    $('#item-industrial').change(function () {
                        if (this.checked) {
                            $('#item-link').addClass('hidden');
                        }
                        else {
                            $('#item-link').removeClass('hidden');
                        }
                    });

                </script>
            </form>

        <?php
        }
    }

    public function addItem() {
        $nameCategory = $this->model->categoryName;
        echo($this->model->linkError);
        ?>
        <form name='add' method='post' action='./index.php?page=edit' enctype='multipart/form-data'>
            <input type='hidden' name='action' value='addItem' />
            <input type='hidden' name='categoryId' value='addItem' />
            <label>Name <input id='title' class="form-control" type='text' name='name' autofocus /></label>
            <input type='hidden' name='categoryName' value='<?php echo($nameCategory); ?>' />

            <div id='item-link'>
                <label>Link <input class="form-control" type='text' name='link' autofocus /></label>
            </div>
            <label>Industrial Item <input id="item-industrial" type="checkbox" name="industrial" /></label></br>
            <label>Icon
                <input name="image" type="file" title="Search..." >
            </label>
            <textarea class='editForm' name='details' id='details' rows="4" cols="50">Add details.</textarea>
            <button class='btn btn-default btn-sm' type='submit' name='save'>Save</button>
            <script>
                $('#item-industrial').change(function () {
                    if (this.checked) {
                        $('#item-link').fadeOut('slow');
                    }
                    else {
                        $('#item-link').fadeIn('slow');
                    }
                });
            </script>
        </form>

    <?php
    }

    public function addArea() {
        $itemId = $this->model->item->getIdItem();
        ?>
        <form name='addArea' method='post' action='./index.php?page=edit&item=<?php echo($itemId); ?>'>
            <input type='hidden' name='action' value='addArea' />
            <input id='title' type='text' placeholder="Title" name='title' autofocus />
            <textarea class='editForm' name='text' rows="4" cols="50"></textarea>
            <button class='btn btn-default' type='submit' name='save'>Save</button>
        </form>
    <?php
    }

    public function printPageHeader() {

    }

    public function printTitle() {
        if ($this->model->addItem) {
            echo("Industrial Craft Experimental - Wiki - Add item");
        } else {
            if ($this->model->addArea) {
                echo("Industrial Craft Experimental - Wiki - Add section");
            }
            $itemName = $this->model->item->getName();
            echo("Industrial Craft Experimental - Wiki - Edit " . $itemName);
        }
    }

}
