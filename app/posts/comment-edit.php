<?php

declare(strict_types=1);
require __DIR__ . ('/../autoload.php');

if (isset($_GET['commentid'], $_POST['content'])) {
    $commentId = $_GET['commentid'];
    $commentContent = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $statement = $pdo->prepare("UPDATE comments SET content = :content WHERE id = :id");
    $statement->BindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->BindParam(':content', $commentContent, PDO::PARAM_STR);
    $statement->execute();
    exit(redirect('/../../index.php'));
}
