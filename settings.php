<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

$user = $_SESSION['user'];
$userId = $_SESSION['user']['id'];

// if (isset($_POST['bio'])) {
//     $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
//     $bio = changeBio($pdo, $userId, $bio);
// }
if (isset($_FILES['avatar'])) {
    $image = $_FILES['avatar'];
    $image = updateAvatar($pdo, $image, $userId);
}

?>

<main>
    <section>

        <div class="settings-grid-container">
            <div class="settings-item info-left">
                <p>user: </p>
                <p>email: </p>
                <p>firstname: </p>
                <p>lastname: </p>

            </div>
            <div class="settings-item info-right">
                <p><?= $user['username'] ?></p>
                <p> <?= $user['email'] ?></p>
                <p> <?= $user['firstname'] ?></p>
                <p> <?= $user['lastname'] ?></p>

            </div>
            <div class="settings-item var-left">
                <div> <a href="/../../user-posts.php">my posts</a></div>
                <div> <a href="/app/users/delete-user.php"> delete user </a></div>
            </div>
            <div class="settings-item avatar">
                <img src="<?= '/app/images/' . $_SESSION['user']['avatar']; ?>" width="75px" height="75px" alt="">
                <form class="settings-item avatar-form" action="/app/settings/edit-avatar.php" method="post" enctype="multipart/form-data">
                    <label for="avatar"></label>
                    <input type="file" name="avatar" id="avatar" required>



                    <button type="submit">Upload</button>
                </form>
            </div>
            <div>aa</div>
            <div>aa</div>
            <div>aa</div>
            <!-- <div class="grid-item4">


                <div class="grid-item5">Bio</div>
                <div class="grid-item6">
                    <form action="settings.php" method="POST">
                        <label for="bio"></label>
                        <textarea name="bio" id="bio" cols="30" rows="6" placeholder="Add some info" maxlength="100"></textarea>
                        <button type="submit">Update bio</button>
                    </form>
                </div>
                <div class="grid-item7">

                </div> -->

        </div>


    </section>
</main>