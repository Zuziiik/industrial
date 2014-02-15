<?php

foreach (glob("./Model/*.php") as $filename) {
    include_once $filename;
}
foreach (glob("./Control/*.php") as $filename) {
    include_once $filename;
}
foreach (glob("./View/*.php") as $filename) {
    include_once $filename;
}

function navigate() {
    global $model;
    global $control;
    global $view;
    $page = 'login';

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    switch ($page) {
        case 'login':
            $model = new LoginModel();
            $control = new LoginControl($model);
            $view = new LoginView($model);
            break;
        case 'recipes':
            $model = new ItemListModel();
            $control = new ItemListControl($model);
            $view = new ItemListView($model);
            break;
        case 'item':
            $model = new ItemModel();
            $control = new ItemControl($model);
            $view = new ItemView($model);
            break;
        default :
            $model = new NotFoundModel();
            $control = new NotFoundControl($model);
            $view = new NotFoundView($model);
    }
}
