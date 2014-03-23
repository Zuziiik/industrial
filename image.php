<?php

include_once 'db.php';
include_once 'util.php';
include_once dirname(__FILE__) . '/Model/Database/ItemIconDAO.php';
include_once dirname(__FILE__) . '/Model/Database/UserIconDAO.php';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = sanitizeString($_GET['type']);
    $id = sanitizeString($_GET['id']);
} else {
    die();
}

switch ($type) {
    case 'item':
        $icon = ItemIconDAO::selectById((int)$id);
        break;
    case 'user':
        $icon = UserIconDAO::selectById((int)$id);
        break;
    default:
        die("type $type does`nt exists");
}

header("Content-type: image/png");
$result = $icon->getImage();
if($result){
    echo "$result";
}else{
    $img = file_get_contents("./pictures/noImage.jpg");
    echo "$img";
}



