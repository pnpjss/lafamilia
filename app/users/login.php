<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');


if (isset($_POST['username'], $_POST['pwd'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        exit(redirect('/../../login.php?login=username'));
    }
    if (password_verify($_POST['pwd'], $user['passwd'])) {

        unset($user['passwd']);
        $_SESSION['user'] = $user;
        redirect('/../../index.php');
    } else {
        exit(redirect('/../../login.php?login=password'));
    }
}
