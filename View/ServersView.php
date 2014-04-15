<?php

include_once 'View.php';

class ServersView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Industrial Craft Experimental - Wiki - Servers");
    }

    public function printNavigation() {
        ?>
        <li class="active">Servers</li><?php
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            ?>
            <form class="pull-right" name='addServer' method='post' action='./index.php?page=editServer'>
                <input type='hidden' name='action' value='addServer' />
                <button class="btn btn-default" type='submit' name='addServer'>Add Server</button>
            </form>
        <?php
        }
        ?><h2>Servers</h2><?php
        $i = 0;
        foreach ($this->model->servers as $server) {
            $title = $server->getTitle();
            $message = $server->getMessage();
            $id = (int)$server->getIdEditableArea();
            ?>
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $title; ?></h3>
            </div>
            <div class='panel-body'><?php echo($message); ?>
                <?php
                if ($loggedIn && $admin) {
                    ?>

                    <form id="deleteServer" name='deleteServer' method='post' action='./index.php?page=servers'>
                        <input type='hidden' name='action' value='deleteServer' />
                        <input type='hidden' name='ServerId' value='<?php echo($id); ?>' />

                    </form>

                    <form id="editServer" name='editServer' method='post' action='./index.php?page=editServer'>
                        <input type='hidden' name='action' value='editServer' />
                        <input type='hidden' name='ServerId' value='<?php echo($id); ?>' />

                    </form>


                <?php
                }
                ?>

                <?php
                $path = base64_encode("<a href='index.php?page=servers'>Servers</a>");
                $this->model->commentViews[$i]->setPath($path);
                $this->model->commentViews[$i]->printBody();
                $i++;

                if ($loggedIn) {
                    $type = Comment::SERVER;
                    ?>
                    <form id="addComment" name='addComment' method='post' action='./index.php?page=comment'>
                        <input type='hidden' name='action' value='addComment' />
                        <input type='hidden' name='path' value='<?php echo($path); ?>' />
                        <input type='hidden' name='targetId' value='<?php echo($id); ?>' />
                        <input type='hidden' name='type' value='<?php echo($type); ?>' />

                    </form>
                    <div class="btn-group">
                        <?php
                        if ($admin) {
                            ?>
                            <button form="deleteServer" class='btn btn-sm btn-default ' type='submit' name='deleteServer'>
                                Delete
                            </button>
                            <button form="editServer" class='btn btn-sm btn-default' type='submit' name='editServer'>Edit
                            </button>
                        <?php
                        }
                        ?>
                        <button form="addComment" class='btn btn-sm btn-default' type='submit' name='addComment'>Comment
                        </button>
                    </div>
                <?php
                }
                ?> </div>
            </div><?php
        }

    }

    public function printPageHeader() {
    }

}