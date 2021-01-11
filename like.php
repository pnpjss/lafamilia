<?php

declare(strict_types=1);

require __DIR__ . ('/app/autoload.php');

$userId = $_SESSION['user']['id'];

if (isset($_POST['like'])) {
    $likePostId = $_POST['like'];

    $likePostId = addLike($pdo, $likePostId, $userId);
}
