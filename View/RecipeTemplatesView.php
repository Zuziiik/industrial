<?php

include_once 'View.php';

class RecipeTemplatesView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Industrial Craft Experimental - Wiki - Recipe Templates");
    }

    public function printNavigation() {
        ?>
        <li><a href='.'>Home</a></li>
        <li class="active">Recipe Templates</li><?php
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        ?><h2>Recipe Templates</h2><?php
        if ($loggedIn && $admin) {
            echo($this->model->error);
            ?>
            <form name='addTemplate' class="pull-right" method='post' action='./index.php?page=templateForm'>
                <input type='hidden' name='action' value='addTemplate' />
                <button class="btn btn-default" type='submit' name='addTemplate'>Add Template</button>
            </form>

            <?php
            foreach ($this->model->templates as $template) {
                ?>
                <div class="template">  <?php
                    $imageName = $template->getImageName();
                    $size = getimagesize("./pictures/templates/" . $imageName);
                    $id = $template->getIdRecipeTemplate();
                    $name = $template->getName();
                    $positions = $template->getPositions();
                    $positions = explode(' | ', $positions);
                    ?> <h3><?php echo $name; ?></h3>

                    <div class="divImageTemplate" <?php echo ($size[3]); ?>>
                        <img class="imageTemplate" src="./pictures/templates/<?php echo($imageName); ?>">
                        <?php
                        foreach ($positions as $position) {
                            if ($position != '') {
                                $xy = explode(' , ', $position);
                                $x = $xy[0] - 16;
                                $y = $xy[1] - 16;
                                ?>
                                <div class="templateIconDiv"
                                     style="top:<?php echo($y); ?>px; left:<?php echo($x); ?>px;"></div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <form class="deleteTemplate" name='deleteTemplate' method='post'
                          action='./index.php?page=recipeTemplates'>
                        <input type='hidden' name='action' value='deleteTemplate' />
                        <input type='hidden' name='id' value='<?php echo($id); ?>' />
                        <button class="btn btn-default btn-sm" type='submit' name='deleteTemplate'>Delete</button>
                    </form>
                </div>
            <?php
            }

        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {

    }

}