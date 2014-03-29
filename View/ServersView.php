<?php

include_once 'View.php';

class ServersView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Servers");
    }

	public function printNavigation() {
		echo("Servers");
	}

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            ?>
            <form id='addServer' name='addServer' method='post' action='./index.php?page=editServer'>
                <input type='hidden' name='action' value='addServer' />
                <button class="addButton" type='submit' name='addServer'>Add Server</button>
            </form>
        <?php
        }
        $i = 0;
        foreach ($this->model->servers as $server) {
            $title = $server->getTitle();
            $message = $server->getMessage();
            $id = (int)$server->getIdEditableArea();
            echo("<div class='server'>");
            echo("<span class='title'><h2>$title</h2></span>");
            echo("<span class='message'>$message</span>");
            if ($loggedIn && $admin) {
                ?>
                <form id='deleteServer' name='deleteServer' method='post' action='./index.php?page=servers'>
                    <input type='hidden' name='action' value='deleteServer' />
                    <input type='hidden' name='ServerId' value='<?php echo $id; ?>' />
                    <button class='deleteButton' type='submit' name='deleteServer'>Delete</button>
                </form>

                <form id='editServer' name='editServer' method='post' action='./index.php?page=editServer'>
                    <input type='hidden' name='action' value='editServer' />
                    <input type='hidden' name='ServerId' value='<?php echo $id; ?>' />
                    <button class='editButton' type='submit' name='editServer'>Edit</button>
                </form>
            <?php
            }
			$path = base64_encode("<a href='index.php?page=servers'>Servers</a>");
			$this->model->commentViews[$i]->setPath($path);
            $this->model->commentViews[$i]->printBody();
            $i++;

            if ($loggedIn) {
                $type = Comment::SERVER;
                ?>
                <form id='addComment' name='addComment' method='post' action='./index.php?page=comment'>
                    <input type='hidden' name='action' value='addComment' />
					<input type='hidden' name='path' value='<?php echo ($path); ?>' />
                    <input type='hidden' name='targetId' value='<?php echo ($id); ?>' />
                    <input type='hidden' name='type' value='<?php echo ($type); ?>' />
                    <button class='commentButton' type='submit' name='addComment'>Comment</button>
                </form>
            <?php
            }
            echo("</div>");
        }

    }

    public function printPageHeader() {
        echo("Servers");
    }

}