<?php

include_once 'View.php';

class TemplateFormView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        if ($this->model->add) {
            echo("Industrial Craft Experimental - Wiki - Add Template");
        } else {
            echo("Industrial Craft Experimental - Wiki - Edit Template");
        }
    }

    public function printNavigation() {
        if ($this->model->add) {
            ?>
            <li><a href='.'>Home</a></li>
            <li>
                <a href='index.php?page=recipeTemplates'>Recipe Templates</a></li>
            <li class="active">Add Template</li><?php
        } else {
            //TODO
        }
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            if ($this->model->add && !$this->model->selectedImage) {
                $this->selectImage();
            }
            if ($this->model->loaded) {
                $this->printTemplate();

            }
            if ($this->model->submitted) {
                $this->confirm();
            }
        } else {
            echo($this->model->error);
        }
    }

    public function printPageHeader() {
        if ($this->model->add) {
            echo("Add Template");
        } else {
            echo("Edit Template");
        }
    }

    private function confirm() {
        $imageName = $this->model->imageName;
        $name = $this->model->name;
        $positions = $this->model->positions;
        $positions = explode(' | ', $positions);
        $size = getimagesize("./pictures/templates/" . $imageName);
        $width = $size[0] * 2;
        $height = $size[1] * 2;
        ?>
        <span class="messageTemplate">Confirm positions of <?php echo($name); ?>`s Template</span>

        <div class="divImageTemplate">
            <img class="imageTemplate" src="./pictures/templates/<?php echo($imageName); ?>"
                 style="width: <?php echo($width); ?>px; height: <?php echo($height); ?>px;">

            <form name='confirm' method='post' action='./index.php?page=templateForm'>
                <input type="hidden" name="name" value="<?php echo($name); ?>" />
                <input type="hidden" name="imageName" value="<?php echo($imageName); ?>" />
                <input type='hidden' name='action' value='submitPositions' />
                <?php
                foreach ($positions as $position) {
                    if ($position != '') {
                        $xy = explode(' , ', $position);
                        $x = ($xy[0] - 14) * 2;
                        $y = ($xy[1] - 14) * 2;
                        ?>
                        <input type="checkbox" name='cords[]' value="<?php echo($position); ?>"
                               checked
                               style="position: absolute; top:<?php echo($y); ?>px; left:<?php echo($x); ?>px; width: 50px; height: 50px;" />

                    <?php
                    }
                }
                ?>
                <button class="submitButton" type="submit" name="confirm">Confirm</button>
            </form>
        </div>
        <form method='post' action='./index.php?page=templateForm'>
            <input type='hidden' name='imageName' value='<?php echo($imageName); ?>' />
            <input type='hidden' name='name' value='<?php echo($this->model->name); ?>' />
            <input type='hidden' name='positions' value='<?php echo($this->model->positions); ?>' />
            <input type='hidden' name='action' value='backFromConfirm' />
            <button class="submitButton" type="submit" name="back">Back</button>
        </form>

    <?php
    }

    private function selectImage() {
        ?>
        <span class="messageTemplate">Upload template picture</span>
        <form name='addTemplatePic' method='post' action='./index.php?page=templateForm'
              enctype='multipart/form-data'>
            <input type='hidden' name='action' value='addTemplate' />

            <div class="myFileUpload btn">
                <span>Browse...</span>
                <input id="myUploadBtn" type="file" name='image' class="upload" />
            </div>
            <input id="myUploadFile" placeholder="No File Selected" disabled="disabled" />
            <script type="text/javascript">
                document.getElementById("myUploadBtn").onchange = function () {
                    document.getElementById("myUploadFile").value = this.value;
                };
            </script>
            <button class="submitButton" type='submit' name='submitPicture'>Submit</button>
        </form>
        <?php

        echo($this->model->error);
    }

    private function printTemplate() {
        $imageName = $this->model->imageName;
        ?>
        <span class="messageTemplate">Select middle cords for items.</span>
        <img id="imgId" src='./pictures/templates/<?php echo($this->model->imageName); ?>' />
        <form name='addTemplatePic' method='post' action='./index.php?page=templateForm'>
            <input type='hidden' name='action' value='submitPositions' />
            <input type="hidden" name="imageName" value="<?php echo($imageName); ?>" />
            <input type="text" name="name" id="title" placeholder="Template Name"
                   value="<?php echo($this->model->name); ?>" />
            <input type="text" size="100" maxlength="300" name="positions" id="positions"
                   value="<?php echo($this->model->positions); ?>" />
            <button class="submitButton" type="submit" name="submitPositions">Submit</button>
        </form>
        Positions:
        <div id="coords"></div>

        <form method='post' action='./index.php?page=templateForm'>
            <input type='hidden' name='imageName' value='<?php echo($imageName); ?>' />
            <input type='hidden' name='action' value='backFromPositions' />
            <button class="submitButton" type="submit" name="back">Back</button>
        </form>

        <script type="text/javascript">

            /*
             Here add the ID of the HTML elements for which to show the mouse coords
             Within quotes, separated by comma.
             E.g.:   ['imgid', 'divid'];
             */
            var elmids = ['imgId'];

            var x, y = 0;       // variables that will contain the coordinates

            // Get X and Y position of the elm (from: vishalsays.wordpress.com)
            function getXYpos(elm) {
                x = elm.offsetLeft;        // set x to elm’s offsetLeft
                y = elm.offsetTop;         // set y to elm’s offsetTop

                elm = elm.offsetParent;    // set elm to its offsetParent

                //use while loop to check if elm is null
                // if not then add current elm’s offsetLeft to x
                //offsetTop to y and set elm to its offsetParent
                while (elm != null) {
                    x = parseInt(x) + parseInt(elm.offsetLeft);
                    y = parseInt(y) + parseInt(elm.offsetTop);
                    elm = elm.offsetParent;
                }

                // returns an object with "xp" (Left), "=yp" (Top) position
                return {'xp': x, 'yp': y};
            }

            // Get X, Y coords, and displays Mouse coordinates
            function getCoords(e) {
                // coursesweb.net/
                var xy_pos = getXYpos(this);

                // if IE
                if (navigator.appVersion.indexOf("MSIE") != -1) {
                    // in IE scrolling page affects mouse coordinates into an element
                    // This gets the page element that will be used to add scrolling value to correct mouse coords
                    var standardBody = (document.compatMode == 'CSS1Compat') ? document.documentElement : document.body;

                    x = event.clientX + standardBody.scrollLeft;
                    y = event.clientY + standardBody.scrollTop;
                }
                else {
                    x = e.pageX;
                    y = e.pageY;
                }

                x = x - xy_pos['xp'];
                y = y - xy_pos['yp'];

                // displays x and y coords in the #coords element
                document.getElementById('coords').innerHTML = 'X= ' + x + ' ,Y= ' + y;


            }

            // register onmousemove, and onclick the each element with ID stored in elmids
            for (var i = 0; i < elmids.length; i++) {
                if (document.getElementById(elmids[i])) {
                    // calls the getCoords() function when mousemove
                    document.getElementById(elmids[i]).onmousemove = getCoords;
                    // execute a function when click
                    document.getElementById(elmids[i]).onclick = function () {
                        document.getElementById('positions').value += ' | ' + x + ' , ' + y;
                    };

                }
            }
        </script>
    <?php
    }

}