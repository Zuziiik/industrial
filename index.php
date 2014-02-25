<?php

include_once 'header.php';

navigate();

$control->initialize();
$view->initialize();

echo("<!DOCTYPE html>" .
    "<head><meta charset='UTF-8'>" .
    "<meta charset='UTF-8'>" .
    "<link rel='stylesheet' type='text/css' href='./css/style.css' title='default'>" .
    "</head><title>");
$view->printTitle();
echo("</title><header>");
include_once 'menu.php';
echo("</header><body><h1>");
$view->printPageHeader();
echo("</h1><section>");
echo "get: ";
var_dump($_GET);
echo "</br>post: ";
var_dump($_POST);
$view->printBody();
echo("</section></body></html>");

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