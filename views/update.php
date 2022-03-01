<?php
$action = 'nawak';
$title = 'Update de l\'article '.$_GET['id'];
$err = [];
include_once __DIR__.'/../config.php';
include_once __DIR__.'/helpers/header.php';
include_once __DIR__.'/../controllers/PostsController.php';

if(!empty($_POST)){
    $ctrl = new PostsController();
    $ctrl->setPostId($_GET['id']);
    $article = $ctrl->validateForm();
    if(!$article){
        $err = $ctrl->getErrors();
    } else {
        //header('Location: /views/ok.php');
    }
}



$ctrl = new PostsController();
$update = $ctrl->getPostById($_GET['id']);
if(!$update){
    $err = $ctrl->getErrors();
    $err['update'] = 'Lecture de l\'enregistrement impossible';
}


require_once __DIR__.'/helpers/form.php';

require_once __DIR__.'/helpers/footer.php';