<?php

include_once 'header.php';

navigate();

$control->initialize();
$view->initialize();

echo("<!DOCTYPE html>".
     "<header><meta charset='UTF-8'></header>".
     "<header><meta charset='UTF-8'><title>");
    $view->printTitle();
    echo("</title></header><body><h1>");
    $view->printPageHeader();
    echo("</h1>");
    $view->printBody();
    echo("</body></html>");

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