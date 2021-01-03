<?php

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');



$avatar = $_SESSION['user']['avatar'];

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

}


// shows avatar if pre-exist and/or updates new avatar without need to relog
// $statement = $pdo->query('SELECT * FROM users WHERE id = :id');
// $statement->bindParam(':id', $userId, PDO::PARAM_STR);
// $user = $statement->fetch(PDO::FETCH_ASSOC);
// $avatar = $user['avatar'];
// $avatar = $_SESSION['user']['avatar'];
// funkar inte


?>

<main><section>
<form action="edit-avatar.php" method="post" enctype="multipart/form-data">
                <label for="avatar">Png file required</label>
                <input type="file" name="avatar" id="avatar" required>
                <button type="submit">Upload</button>


            </form>

            <br><br>

            <img src="<?php echo "/app/images/$avatar" ?>" height="90px" width="90px" alt="">
            </section></main>