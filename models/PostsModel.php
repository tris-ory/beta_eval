<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/Db.php';

class PostsModel extends Db
{
    // Normally, all attributes are private and have getters/setters if needed
    private $db;

    public $id;
    public $title;
    public $description;
    public $image;
    public $content;
    public $author;
    public $visible;

    public function __construct()
    {
        $dbh = Db::getInstance();
        $this->db = $dbh->getDb();
    }

    public function createPost(){
        $stmt = $this->db->prepare('INSERT INTO `posts` (`title`, `description`,`image`, `content`, `author`, `visible`)
VALUES (:title, :description, :image, :content, :author, :visible)');
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
        $stmt->bindValue(':author', $this->author, PDO::PARAM_STR);
        $stmt->bindValue(':visible', $this->visible,PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    public function getPosts(){
        $stmt = $this->db->query('SELECT `id`, `title`, `description`, `image`, `content`, `author`, `visible` FROM `posts`');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVisiblePosts(){
        $stmt = $this->db->query('SELECT `id`, `title`, `description`, `image`, `content`, `author`, `visible` FROM `posts` WHERE `visible`');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostById($id){
        $stmt = $this->db->prepare('SELECT `id`, `title`, `description`, `image`, `content`, `author`, `visible` 
            FROM `posts` WHERE `id` = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePost(){
        $stmt = $this->db->prepare('UPDATE `posts` SET
        `title` = :title,
        `description` = :description,
        `image` = :image,
        `content` = :content,
        `author` = :author
        WHERE `id` = :id');
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
        $stmt->bindValue(':author', $this->author, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deletePost(){
        $stmt = $this->db->prepare('DELETE FROM `posts` WHERE `id` = :id');
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}