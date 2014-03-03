<?php

include_once 'header.php';

navigate();

$control->initialize();
$view->initialize();
echo <<<_END
<!DOCTYPE html>
   <head>
   <meta charset='UTF-8' />
   <script type="text/javascript" src="./tinymce/tinymce.min.js"></script>
   <script type="text/javascript">
    tinymce.init({
    selector: "textarea",
     theme:"modern",
     relative_urls:"false",
    style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
   plugins: [
         "advlist autolink link image lists charmap preview hr pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor jbimages"
   ],
templates: [
        {title: 'Article', description: 'Article with header h3', url: './tinymce/templates/test.html'}
    ]
    });
    </script>
   <link rel='stylesheet' type='text/css' href='css/style.css' title='default' />

   </head>
   <title>
_END;

$view->printTitle();
echo("</title><header>");
include_once 'menu.php';
echo("</header><body><h1>");
$view->printPageHeader();
echo("</h1><section><div id='content'>");
//echo "get: ";
//var_dump($_GET);
//echo "</br>post: ";
//var_dump($_POST);

$view->printBody();
echo("</div></section><footer>");
$view->printFooter();
echo("</footer><br class='clear' /></body></html>");



/*

$test = new UserIcon(1, addslashes(file_get_contents("BronzeChestplate.png")));

UserIconDAO::reset($test);
*/
//var_dump($test);


/*
header("Content-type: image/png");
$result = $test->getImage();
echo "$result";
*/