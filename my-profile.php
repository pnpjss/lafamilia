<?php
require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

$user = $_SESSION['user'];
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
        $imageDestination = 'app/images/' . $imageNewName;
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
$avatar = $_SESSION['user']['avatar'];

?>

<main>
    <br> <br> <br><br><br>
    <section class="section profile">

        <!-- <button class="change change-password">Change Password</button>

        <form class="form form-change-pwd" action="my-profile.php" method="POST">
            <label for="newpwd"></label>
            <input class="my-profile-input" type="text" name="newpwd" id="newpwd">
            <button class="my-profile-btn newpwd" type="submit">Submit</button>
        </form> -->

        <form class="myprofile " action="my-profile.php" method="post" enctype="multipart/form-data">
            <label for="avatar">Png file required</label>
            <input type="file" name="avatar" id="avatar" required>
            <button type="submit">Upload</button>


        </form>
        <img src="<?php echo "/app/images/$avatar" ?>" width="50px" height="50px" alt="">
        <a href="index.php"> Return </a>

        <form action="my-profile.php" method="post">
            <label for="bio">Add bio</label>
            <textarea name="bio" id="bio" cols="30" rows="10">
        Add bio?
        </textarea>

        </form>
    </section>
</main>

<script src="myprofile.js"></script>


<?php require __DIR__ . ('/app/views/footer.php'); ?>