<?php
// If no article to view, return to homepage
if(empty($_GET['id'])){
    header('Location: /index.php');
}
include_once __DIR__.'/../config.php';
include_once __DIR__.'/helpers/header.php';
include_once __DIR__.'/../controllers/PostsController.php';
$errors = [];
$ctrl = new PostsController();
$article = $ctrl->getPostById($_GET['id']);
if(!$article){
    $errors = $ctrl->getErrors();
    $title = 'Article non lisible';
} else {
    $title = $article['title'];
    $action = 'reading';
}


?>
<h1><?= $article['title'] ?></h1>
<article class="rounded">
    <img src="/assets/img/<?= $article['image'] ?>" alt="Illustration de l'article" />
    <p><?= $article['content'] ?></p>
    <div>
        <a class="btn btn-primary mx-2" href="/views/update.php?id=<?=$_GET['id'] ?>">Mettre à jour</a>
        <a class="btn btn-danger mx-2" href="/views/delete.php?id=<?=$_GET['id'] ?>">Supprimer</a>
    </div>
</article>
<?php
include_once __DIR__.'/helpers/footer.php';
