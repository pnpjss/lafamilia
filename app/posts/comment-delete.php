<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');

if (isset($_GET['commentid'],  $_GET['updatekey'], $_GET['postid'])) {
    $commentId = $_GET['commentid'];
    $updateKey = $_GET['updatekey'];
    $postId = $_GET['postid'];
    if ($updateKey === $_SESSION['user']['updatekey']) {
        $query = "DELETE FROM comments WHERE id = :id";
        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }
        $statement->bindParam(':id', $commentId, PDO::PARAM_STR);
        $statement->execute();
        exit(redirect('/../../comments.php?id=' . $postId));
    } else {
        exit(redirect('/../../comments.php?id=' . $postId));
    }
}
