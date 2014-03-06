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
            $model = new ItemFormModel();
            $control = new ItemFormControl($model);
            $view = new ItemFormView($model);
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
        case 'users':
            $model = new UsersModel();
            $control = new UsersControl($model);
            $view = new UsersView($model);
            break;
        case 'servers':
            $model = new ServersModel();
            $control = new ServersControl($model);
            $view = new ServersView($model);
            break;
        case 'comment':
            $model = new CommentFormModel();
            $control = new CommentFormControl($model);
            $view = new CommentFormView($model);
            break;
        case 'editServer':
            $model = new ServerFormModel();
            $control = new ServerFormControl($model);
            $view = new ServerFormView($model);
            break;
        case 'tutorialList':
            $model = new TutorialListModel();
            $control = new TutorialListControl($model);
            $view = new TutorialListView($model);
            break;
        case 'tutorial':
            $model = new TutorialModel();
            $control = new TutorialControl($model);
            $view = new TutorialView($model);
            break;
        case 'tutorialEdit':
            $model = new TutorialFormModel();
            $control = new TutorialFormControl($model);
            $view = new TutorialFormView($model);
            break;
        case 'recipeTemplates' :
            $model = new RecipeTemplatesModel();
            $control = new RecipeTemplatesControl($model);
            $view = new RecipeTemplatesView($model);
            break;
        case 'templateForm' :
            $model = new TemplateFormModel();
            $control = new TemplateFormControl($model);
            $view = new TemplateFormView($model);
            break;
        case 'recipe':
            $model = new RecipeFormModel();
            $control = new RecipeFormControl($model);
            $view = new RecipeFormView($model);
            break;
        default :
            $model = new NotFoundModel();
            $control = new NotFoundControl($model);
            $view = new NotFoundView($model);
    }
}
