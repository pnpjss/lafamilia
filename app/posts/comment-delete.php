<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');

if (isset($_GET['delete-id'],  $_GET['post-id'])) {
    $commentId = $_GET['delete-id'];
    $postId = $_GET['post-id'];
    $query = "DELETE FROM comments WHERE id = :id";
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $commentId, PDO::PARAM_STR);
    $statement->execute();
    exit(redirect('/../../comments.php?id=' . $postId));
}
