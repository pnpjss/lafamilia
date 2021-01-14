<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');


if (isset($_GET['postid'], $_GET['updatekey'])) {
    // Check if session key and superglobal GET key match
    if ($_GET['updatekey'] === $_SESSION['user']['updatekey']) {
        // If key matches -> delete
        $postId = $_GET['postid'];
        $postId = deletePost($pdo, $postId);
    } else {
        exit(redirect('/../../posts.php'));
    }
    redirect('/../../posts.php');
}
