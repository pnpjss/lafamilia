<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

$user = $_SESSION['user'];
$userId = $_SESSION['user']['id'];

if (isset($_POST['bio'])) {

    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $bio = updateBio($pdo, $bio, $userId);
}
if (isset($_FILES['avatar'])) {
    $image = $_FILES['avatar'];
    $image = updateAvatar($pdo, $image, $userId);
}

if (isset($_POST['email'], $_POST['new-email'])) {
    $currentEmail = $_SESSION['user']['email'];
    $email = $_POST['email'];
    $newEmail = $_POST['new-email'];
    $email = updateEmail($pdo, $email, $newEmail, $currentEmail, $userId);
}
if (isset($_POST['password'], $_POST['old-password'])) {
    $newPwd = $_POST['password'];
    $oldPwd = $_POST['old-password'];
    $newPwd = updatePassword($pdo, $oldPwd, $newPwd, $userId);
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
                <div> <a href="/../../posts.php">my posts</a></div>
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
            <p>update email</p>
            <div class="settings-item update-form">
                <form action="/settings.php" method="post">
                    <label for="email">old email</label>
                    <input type="text" name="email" id="email" placeholder="current email..">
                    <label for="new-email">new email</label>
                    <input type="text" name="new-email" id="new-email" placeholder="new email..">
                    <button type="submit">update email</button>
                </form>
            </div>
            <div>update password</div>
            <div class="settings-item update-form">
                <form action="settings.php" method="post">
                    <label for="old-password"></label>
                    <input type="text" name="old-password" id="old-password" placeholder="enter old password">
                    <label for="password"></label>
                    <input type="text" name="password" id="password" placeholder="enter new password">
                    <button type="submit">password</button>
                </form>
            </div>
            <div>change bio</div>
            <div>
                <form action="settings.php" method="POST">
                    <label for="bio"></label>
                    <textarea name="bio" id="bio" cols="30" rows="6" placeholder="<?= $_SESSION['user']['biography']; ?>" maxlength="100"></textarea>
                    <button type="submit">Update bio</button>
                </form>
            </div>


        </div>


    </section>
</main>