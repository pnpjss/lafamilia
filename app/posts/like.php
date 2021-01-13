<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');

if (!isset($_SESSION['user'])) {
    redirect('/../../index.php');
} else {
    $userId = $_SESSION['user']['id'];

    if (isset($_POST['like'])) {
        $likePostId = $_POST['like'];

        $likePostId = addLike($pdo, $likePostId, $userId);
    }
}
