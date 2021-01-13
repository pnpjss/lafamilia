<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');

if (!isset($_SESSION['user'])) {
    redirect('/../../index.php');
} else {
    $userId = $_SESSION['user']['id'];

    if (isset($_POST['dislike'])) {
        $postId = $_POST['dislike'];
        deleteLike($pdo, $postId,  $userId);
    }
}
