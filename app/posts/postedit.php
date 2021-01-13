<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
}


if (isset($_POST['title'], $_POST['url'], $_POST['description'], $_GET['postid'])) {

    $title = filter_var($_POST['title'],  FILTER_SANITIZE_STRING);
    $url = filter_var($_POST['url'],  FILTER_SANITIZE_URL);
    $description = filter_var($_POST['description'],  FILTER_SANITIZE_STRING);
    $postId = $_GET['postid'];

    $statement = $pdo->prepare("UPDATE posts SET title = :title, url = :url, description = :description WHERE id = :id");
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':url', $url, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':id', $postId, PDO::PARAM_STR);
    $statement->execute();

    redirect('/../../posts.php');
}
