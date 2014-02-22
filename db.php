<?php

$dbhost = 'localhost';    // Unlikely to require changing
$dbname = 'industrial';       // Modify these...
$dbuser = 'root';   // ...variables according
$dbpass = '';   // ...to your installation
$appname = "Industrial Craft (Experimental) - Wiki"; // ...and preference

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

function queryMysql($query) {
    global $conn;
//   echo "[".$query."]" . "</br>";
    $result = mysql_query($query, $conn) or die(mysql_error());
    return $result;
}

function rowQueryMysql($query) {
    global $conn;
//    echo "[".$query."]" . "</br>";
    $result = mysql_query($query, $conn) or die(mysql_error());
    return mysql_fetch_row($result);
}

function lastId(){
    global $conn;
    return mysql_insert_id($conn);
}