<?php
include_once __DIR__.'/../config.php';
include_once  __DIR__.'/../models/PostsModel.php';

class PostsController
{
    private $errors;
    private $post;

    public function __construct()
    {
        $this->errors = [];
        $this->post = new PostsModel();
    }

    public function deletePost($id){
        $this->post->id = $id;
        return $this->post->deletePost();
    }

    public function setPostId($id){
        $this->post->id = filter_var($id, FILTER_VALIDATE_INT)?$id:null;
    }

    public function getPosts(){
        $result = $this->post->getPosts();
        // With PHP 8.0+ returns always an array, so if error $result is empty. Before, it could be a false value
        if(empty($result)||!$result){
            $this->errors['list'] = 'Nous ne pouvons afficher la liste des articles actuellement.';
        }
        return $result;
    }

    public function getVisiblePosts(){
        $result = $this->post->getVisiblePosts();
        // With PHP 8.0+ returns always an array, so if error $result is empty. Before, it could be a false value
        if(empty($result)||!$result){
            $this->errors['list'] = 'Nous ne pouvons afficher la liste des articles actuellement.';
        }
        return $result;
    }

    public function getPostById($id){
        $result = $this->post->getPostById($id);
        if(!$result){
            $this->errors['get'] = 'Nous ne pouvons récupérer l\'article demandé.';
        }
        return $result;
    }

    public function validateForm(){
        // 1st purge errors
        $this->errors = [];
        if(empty($_POST['title'])){
            $this->errors['title'] = 'Veuillez entrer un titre';
        } else {
            $text = $this->isValidText($_POST['title'], 50);
            if($text){
                $this->post->title = $text;
            } else {
                $this->errors['title'] = 'Veuillez entrer un titre valide';
            }
        }
        if(empty($_POST['description'])){
            $this->errors['description'] = 'Veuillez entrer une descrition';
        } else {
            $text = $this->isValidText($_POST['description'], 255);
            if($text){
                $this->post->description = $text;
            } else {
                $this->errors['description'] = 'Veuillez entrer une description valide';
            }
        }
        if(empty($_POST['image'])){
            $this->errors['image'] = 'Veuillez entrer une image';
        } else {
            $text = $this->isValidText($_POST['image'], 512);
            if($text){
                $this->post->image = $text;
            } else {
                $this->errors['image'] = 'Veuillez entrer une image valide';
            }
        }
        if(empty($_POST['author'])){
            $this->errors['author'] = 'Veuillez entrer un auteur';
        } else {
            $text = $this->isValidText($_POST['author'], 255);
            if($text){
                $this->post->author = $text;
            } else {
                $this->errors['author'] = 'Veuillez entrer un auteur valide';
            }
        }
        if(empty($_POST['content'])){
            $this->errors['content'] = 'Veuillez saisir un texte';
        } else {
            $text = $this->isValidText($_POST['content'], 65535);
            if($text){
                $this->post->content = $text;
            } else {
                $this->errors['content'] = 'Veuillez saisir un texte valide';
            }
        }
        // If checkbox checked, $_POST['visible'] is set, else not
        $this->post->visible=(isset($_POST['visible']));
        if(empty($this->errors)){
            if(isset($_POST['create'])){
                $result = $this->post->createPost();
                if(!$result){
                    $this->errors['create'] = 'Impossible de créer l\'article.';
                }
            } elseif (isset($_POST['update'])){
                $result = $this->post->updatePost();
                if(!$result){
                    $this->errors['update'] = 'Impossible de mettre à jour l\'article.';
                }
            } else {
                $this->errors['create'] = 'Action non définie';
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result;
    }

    public function getErrors(){
        return $this->errors;
    }

    private function isValidText($text, $length){
        $newText = filter_var($text, FILTER_SANITIZE_STRING);
        return strlen($newText) > $length?false:$newText;
    }

}