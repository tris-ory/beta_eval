<?php
if(empty($_GET['id'])){
    header('Location: /index.php');
}
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../controllers/PostsController.php';

$ctrl = new PostsController();
if($ctrl->deletePost($_GET['id'])){
    header('Location: /views/ok.php');
}

require_once __DIR__.'/helpers/header.php';
?>
<h1>Erreur</h1>
<p>Impossible de supprimer l'élément</p>
<?php
require_once __DIR__.'/helpers/footer.php';
