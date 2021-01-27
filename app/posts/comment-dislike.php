<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');

if (!isset($_SESSION['user'])) {
    redirect('/../../index.php');
} else {
    $userId = $_SESSION['user']['id'];
    $postId = $_POST['post_id'];

    if (isset($_POST['dislike'])) {
        $commentId = $_POST['dislike'];
        deleteLikeToComment($pdo, $commentId,  $userId, $postId);
    }
}