<?php

session_start();

if (isset($_SESSION['username'])) {
    $loggedIn = TRUE;
    if ($_SESSION['admin']) {
        $admin = TRUE;
    } else {
        $admin = FALSE;
    }
    if ($_SESSION['confirmed']) {
        $confirmed = TRUE;
    } else {
        $confirmed = FALSE;
    }
    $username = $_SESSION['username'];
} else {
    $loggedIn = FALSE;
}

