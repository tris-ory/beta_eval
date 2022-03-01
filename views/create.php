<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../controllers/PostsController.php';
$action = 'Créer';
$title = 'Ajout d\'un article';

if(!empty($_POST)){
    $ctrl = new PostsController();
    $article = $ctrl->validateForm();
    if(!$article){
        $err = $ctrl->getErrors();
    } else {
        header('Location: /views/ok.php');
    }
}

include_once __DIR__.'/helpers/header.php';

include_once __DIR__.'/helpers/form.php';

include_once __DIR__.'/helpers/footer.php';