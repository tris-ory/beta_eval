<?php
$action = 'List';
$title = 'Liste des articles';

include_once __DIR__.'/../config.php';
include_once __DIR__.'/helpers/header.php';
include_once __DIR__.'/../controllers/PostsController.php';
$ctrl = new PostsController();
$articles = $ctrl->getPosts();
?>
    <h1>Accueil</h1>
<?php foreach ($articles as $article): ?>
    <article>
        <h2><a href="/views/read.php?id=<?= $article['id'] ?>"><?= $article['title'] ?></a></h2>
        <div class="author">By <?= $article['author'] ?></div>
        <img src="/assets/img/<?= $article['image'] ?>" alt="Illustration de l'article" />
        <p class="description"><?= $article['description'] ?></p>
        <div>
            <a class="btn btn-primary mx-2" href="/views/update.php?id=<?=$article['id'] ?>">Mettre à jour</a>
            <a class="btn btn-danger mx-2" href="/views/delete.php?id=<?=$article['id'] ?>">Supprimer</a>
        </div>
    </article>
<?php endforeach; ?>
<?php
include_once 'helpers/footer.php';