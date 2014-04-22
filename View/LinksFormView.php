<?php

include_once 'View.php';

class LinksFormView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        if ($this->model->type == EditableArea::LINK) {
            $type = 'Link';
        } else {
            $type = 'Resource Pack';
        }

        if ($this->model->add) {
            echo("Industrial Craft Experimental - Wiki - Add " . $type);
        } else {
            echo("Industrial Craft Experimental - Wiki - Edit " . $type);
        }
    }

    public function printBody() {
        global $admin;
        global $loggedIn;
        if ($admin && $loggedIn) {
            if ($this->model->add) {
                $this->add();
            } else {
                $this->edit();
            }
        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {
        if ($this->model->type == EditableArea::LINK) {
            $type = 'Link';
        } else {
            $type = 'Resource Pack';
        }

        if ($this->model->add) {
            echo("Add " . $type);
        } else {
            echo("Edit " . $type);
        }
    }

    public function printNavigation() {
        if ($this->model->type == EditableArea::LINK) {
            $type = 'Link';
        } else {
            $type = 'Resource Pack';
        }

        if ($this->model->add) {
            ?>
            <li><a href='index.php?page=links'>Links</a></li>
            <li class="active">Add <?php echo($type); ?></li><?php
        } else {
            $title = $this->model->link->getTitle();
            ?>
            <li><a href='index.php?page=links'>Links</a></li>
            <li class="active">Edit <?php echo($type . " - " . $title); ?></li><?php

        }
    }

    private function add() {
        if ($this->model->type == EditableArea::LINK) {
            ?>
            <form class="form-horizontal" name='addLink' method='post' action='./index.php?page=linksForm'>
                <input type='hidden' name='action' value='addLink' />

                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="title">Title</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="text" class="form-control" name='title' id="title"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="message">Link</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="text" class="form-control" name='message' id="message"></div>
                </div>
                <div class="form-group">
                    <div
                        class=" col-sm-offset-4 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3">
                        <button class="btn btn-default glyphicon glyphicon-ok" type='submit' name='save'> Save</button>
                    </div>
                </div>
            </form>
        <?php
        } else {
            ?>
            <form class="form-horizontal" name='addResourcePack' method='post' action='./index.php?page=linksForm'>
                <input type='hidden' name='action' value='addResourcePack' />

                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="title">Title</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="text" class="form-control" name='title' id="title"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="message">Link</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="text" class="form-control" name='message' id="message"></div>
                </div>
                <div class="form-group">
                    <div
                        class=" col-sm-offset-4 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3">
                        <button class="btn btn-default glyphicon glyphicon-ok" type='submit' name='save'> Save</button>
                    </div>
                </div>
            </form>
        <?php
        }
    }

    private function edit() {
        $id = (int)$this->model->link->getIdEditableArea();
        $title = $this->model->link->getTitle();
        $message = $this->model->link->getMessage();
        if ($this->model->type == EditableArea::LINK) {
            ?>
            <form class="form-horizontal" name='addLink' method='post' action='./index.php?page=linksForm'>
                <input type='hidden' name='action' value='editLink' />
                <input type='hidden' name='LinkId' value='<?php echo($id); ?>' />

                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="title">Title</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="text" class="form-control" name='title' value='<?php echo($title); ?>' id="title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="message">Link</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="text" class="form-control" name='message' value='<?php echo($message); ?>'
                               id="message"></div>
                </div>
                <div class="form-group">
                    <div
                        class=" col-sm-offset-4 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3">
                        <button class="btn btn-default glyphicon glyphicon-ok" type='submit' name='save'> Save</button>
                    </div>
                </div>
            </form>
        <?php
        } else {
            ?>
            <form class="form-horizontal" name='addResourcePack' method='post' action='./index.php?page=linksForm'>
                <input type='hidden' name='action' value='editResourcePack' />
                <input type='hidden' name='LinkId' value='<?php echo($id); ?>' />

                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="title">Title</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="text" class="form-control" name='title' value='<?php echo($title); ?>' id="title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-md-3 col-lg-3 control-label" for="message">Link</label>

                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <input type="text" class="form-control" name='message' value='<?php echo($message); ?>'
                               id="message"></div>
                </div>
                <div class="form-group">
                    <div
                        class=" col-sm-offset-4 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3">
                        <button class="btn btn-default glyphicon glyphicon-ok" type='submit' name='save'> Save</button>
                    </div>
                </div>
            </form>
        <?php
        }
    }

}