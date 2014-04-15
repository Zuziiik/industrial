<?php

include_once 'View.php';

class LinksView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Industrial Craft Experimental - Wiki - Links");
    }

    public function printNavigation() {
        ?>
        <li class="active">Links</li> <?php
    }

    public function printBody() {
        global $admin;
        global $loggedIn;
        if ($this->model->fail) {
            echo($this->model->error);
        }
        ?>
        <h2>Resource Packs</h2>
        <?php
        foreach ($this->model->resourcePacks as $resourcePack) {
            $title = $resourcePack->getTitle();
            $message = $resourcePack->getMessage();
            $id = $resourcePack->getIdEditableArea();
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $title; ?></h3>
                </div>
                <div class="panel-body">
                    <a class="link" href='<?php echo($message); ?>'><?php echo($message); ?></a>
                    <?php
                    if ($admin && $loggedIn) {
                        ?>

                        <form id='delete' name='delete' method='post' action='./index.php?page=links'>
                            <input type='hidden' name='LinkId' value='<?php echo($id); ?>' />

                        </form>
                        <form id="editResourcePack" name='editResourcePack' method='post'
                              action='./index.php?page=linksForm'>
                            <input type='hidden' name='action' value='editResourcePack' />
                            <input type='hidden' name='LinkId' value='<?php echo($id); ?>' />

                        </form>
                        <div class="btn-group">
                            <button form="delete" class='btn btn-sm btn-default' type='submit' name='delete'>Delete
                            </button>
                            <button form="editResourcePack" class='btn btn-sm btn-default' type='submit'
                                    name='editResourcePack'>Edit
                            </button>
                        </div>

                    <?php

                    }
                    ?>
                </div>
            </div>
        <?php
        }
        if ($admin && $loggedIn) {
            ?>
            <form id='addResourcePack' name='addResourcePack' method='post' action='./index.php?page=linksForm'>
                <input type='hidden' name='action' value='addResourcePack' />
                <button class='btn btn-default' type='submit' name='addResourcePack'>Add Resource Pack</button>
            </form>
        <?php

        }
        ?>

        <h2>Other Links</h2>
        <?php
        foreach ($this->model->links as $link) {
            $title = $link->getTitle();
            $message = $link->getMessage();
            $id = $link->getIdEditableArea();
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $title; ?></h3>
                </div>
                <div class="panel-body">
                    <a class="link" href='<?php echo($message); ?>'><?php echo($message); ?></a>
                    <?php
                    if ($admin && $loggedIn) {
                        ?>

                        <form id='deleteLink' name='delete' method='post' action='./index.php?page=links'>
                            <input type='hidden' name='LinkId' value='<?php echo($id); ?>' />

                        </form>
                        <form id='editLink' name='editLink' method='post' action='./index.php?page=linksForm'>
                            <input type='hidden' name='action' value='editLink' />
                            <input type='hidden' name='LinkId' value='<?php echo($id); ?>' />

                        </form>
                        <div class="btn-group">
                            <button form="deleteLink" class='btn btn-sm btn-default' type='submit' name='delete'>
                                Delete
                            </button>
                            <button form="editLink" class='btn btn-sm btn-default' type='submit' name='editLink'>Edit
                            </button>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        if ($admin && $loggedIn) {
            ?>
            <form name='addLink' method='post' action='./index.php?page=linksForm'>
                <input type='hidden' name='action' value='addLink' />
                <button class='btn btn-default' type='submit' name='addLink'>Add Link</button>
            </form>
        <?php
        }
    }

    public function printPageHeader() {
        echo("Links");
    }

}