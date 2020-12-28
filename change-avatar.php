<?php

declare(strict_types=1);

require __DIR__ . ('/autoload.php');

if (isset($_FILES['avatar'])) {

    $avatar = $_FILES['avatar'];
    echo $avatar;
    $id = $_SESSION['user']['id'];
    $query = "UPDATE users SET avatar = :avatar WHERE id = :id";

    $statement = $pdo->prepare($query);
    $statement->bindParam(':avatar', $avatar, PDO::PARAM_LOB);
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();
}
