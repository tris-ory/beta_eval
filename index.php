<?php
$action = 'Index';
$title = 'Page d\'index';

include_once __DIR__.'/config.php';
include_once __DIR__.'/views/helpers/header.php';
include_once __DIR__.'/controllers/PostsController.php';
$ctrl = new PostsController();
$posts = $ctrl->getVisiblePosts();
?>
<h1>Accueil</h1>
<?php foreach($posts as $post): ?>
<article class="rounded">
    <h2><a href="/views/read.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
    <p><?= $post['description'] ?></p>
</article>
<?php
endforeach;
include_once 'views/helpers/footer.php';