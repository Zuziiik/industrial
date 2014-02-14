<?php

session_start();

if(isset($_SESSION['username'])){
    $loggedin=TRUE;
    if($_SESSION['admin']){
        $admin=TRUE;
    }else{
        $admin=FALSE;   
    }
    if($_SESSION['confirmed']){
        $confirmed = TRUE;
    }else{
        $confirmed=FALSE;
    }
    $username=$_SESSION['username'];
}else{
    $loggedin=FALSE;
}

