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
            echo("Add Template");
        } else {
            echo("EditTemplate");
        }
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            if ($this->model->add && !$this->model->selectedImage) {
                ?>
                <span class="messageTemplate">Upload template picture</span>
                <form class="addForm" name='addTemplatePic' method='post' action='./index.php?page=templateForm'
                      enctype='multipart/form-data'>
                    <input type='hidden' name='action' value='addTemplate' />
                    <label for='image'>Image</label>
                    <input type='file' id='image' name='image' size='14' maxlength='32' />
                    <input type='submit' name='submitPicture' value='Submit' />
                </form>
                <?php

                echo($this->model->error);
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
            echo("EditTemplate");
        }
    }

    private function confirm() {
        $imageName = $this->model->imageName;
        $name = $this->model->name;
        $positions = $this->model->positions;
        $cords = explode(' | ', $positions);
        ?>
        <span class="messageTemplate">Confirm cord's of <?php echo $name ?>`s Template</span>
        <form class="addForm" name='confirm' method='post' action='./index.php?page=templateForm'>
            <input type="hidden" name="name" value="<?php echo $name ?>" />
            <input type="hidden" name="imageName" value="<?php echo $imageName ?>" />
            <input type='hidden' name='action' value='submitPositions' />
            <?php
            foreach ($cords as $cord) {
                if ($cord != '') {
                    ?>
                    <input type="checkbox" name='cords[]' value="<?php echo $cord ?>" checked /><?php echo $cord ?></br>
                <?php
                }
            }
            ?>
            <input type="submit" name="confirm" value="Confirm">
        </form>
    <?php
    }

    private function printTemplate() {
        $imageName = $this->model->imageName;
        ?>
        <span class="messageTemplate">Select middle cords for items.</span>
        <img id="imgid" src='./pictures/templates/<?php echo $this->model->imageName ?>' />
        <form class="addForm" name='addTemplatePic' method='post' action='./index.php?page=templateForm'>
            <input type='hidden' name='action' value='submitPositions' />
            <input type="hidden" name="imageName" value="<?php echo $imageName ?>" />
            <input type="text" name="name" id="name" placeholder="Template Name" />
            <input type="text" size="100" maxlength="300" name="positions" id="positions" />
            <input type="submit" name="submitPositions" value="Submit">
        </form>
        <div id="coords">Coords</div>


        <script type="text/javascript">
            /*
             Here add the ID of the HTML elements for which to show the mouse coords
             Within quotes, separated by comma.
             E.g.:   ['imgid', 'divid'];
             */
            var elmids = ['imgid'];

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