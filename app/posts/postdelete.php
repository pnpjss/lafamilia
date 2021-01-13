<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');


$userId = $_SESSION['user']['id'];



if (isset($_GET['postid'], $_GET['deletekey'])) {
    // Check if session key and superglobal GET key match
    if ($_GET['deletekey'] == $_SESSION['user']['deletekey']) {
        // If key matches -> delete
        $postId = $_GET['postid'];
        $postId = deletePost($pdo, $userId, $postId);
    } else {
        exit(redirect('/../../posts.php'));
    }
}
