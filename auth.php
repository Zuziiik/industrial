<?php

session_start();

if(isset($_SESSION['username'])){
    $loggedin=TRUE;
    if($_SESSION['admin']){
        $admin=TRUE;
    }else{
        $admin=FALSE;   
    }
}else{
    $loggedin=FALSE;
}

