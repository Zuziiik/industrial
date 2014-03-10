<?php

include_once 'View.php';

class RecipeTemplatesView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        echo("Recipe Templates");
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            ?>
            <form name='addTemplate' method='post' action='./index.php?page=templateForm'>
                <input type='hidden' name='action' value='addTemplate' />
                <input type='submit' name='addTemplate' value='Add Template' />
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
                    $cords = explode(' | ', $positions);
                    ?> <h2><?php echo $name; ?></h2>

                    <div class="divImageTemplate" <?php echo $size[3]; ?>>
                        <img class="imageTemplate" src="./pictures/templates/<?php echo $imageName; ?>">
                        <?php
                        foreach ($cords as $cord) {
                            if ($cord != '') {
                                $xy = explode(' , ', $cord);
                                $x = $xy[0] - 16;
                                $y = $xy[1] - 16;
                                ?>
                                <div class="templateIconDiv"
                                     style="top:<?php echo $y ?>px; left:<?php echo $x ?>px;"></div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <form class="deleteTemplate" name='deleteTemplate' method='post'
                          action='./index.php?page=recipeTemplates'>
                        <input type='hidden' name='action' value='deleteTemplate' />
                        <input type='hidden' name='id' value='<?php echo $id; ?>' />
                        <input type='submit' name='deleteTemplate' value='Delete' />
                    </form>
                </div>
            <?php
            }

        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {
        echo("Recipe Templates");
    }

}