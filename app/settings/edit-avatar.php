<?php

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');

$userId = $_SESSION['user']['id'];

if (isset($_FILES['avatar'])) {
    $image = $_FILES['avatar'];
    $imageName = $image['name'];
    $imageTempName = $image['tmp_name'];
    $imageType = $image['type'];
    $imageSize = $image['size'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    if ($imageActualExt === 'png' && $imageSize < 1000000) {
        $imageNewName = uniqid('', true) . "." . $imageActualExt;
        $imageDestination = '../images/' . $imageNewName;
        move_uploaded_file($imageTempName, $imageDestination);

        $query = "UPDATE users SET avatar = :avatar WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':avatar', $imageNewName, PDO::PARAM_STR);
        $statement->bindParam(':id', $userId, PDO::PARAM_STR);
        $statement->execute();
    }
    $_SESSION['user']['avatar'] = $imageNewName;
    exit(redirect('/../../settings.php'));
}
