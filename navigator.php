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
        case 'home':
            $model = new HomeModel();
            $control = new HomeControl($model);
            $view = new HomeView($model);
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
        case 'edit':
            $model = new EditableAreaModel();
            $control = new EditableAreaControl($model);
            $view = new EditableAreaView($model);
            break;
        case 'register':
            $model = new RegisterModel();
            $control = new RegisterControl($model);
            $view = new RegisterView($model);
            break;
        case 'profile':
            $model = new ProfileModel();
            $control = new ProfileControl($model);
            $view = new ProfileView($model);
            break;
        default :
            $model = new NotFoundModel();
            $control = new NotFoundControl($model);
            $view = new NotFoundView($model);
    }
}
