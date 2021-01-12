<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');


if (isset($_POST['bio'])) {
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $id = $_SESSION['user']['id'];
    $statement = $pdo->prepare("UPDATE users SET biography = :bio WHERE id = :id");
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();
    $_SESSION['user']['biography'] = $bio;

    redirect('/../../settings.php');
}
