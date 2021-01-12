<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

$user = $_SESSION['user'];


?>

<main>
    <section>

        <div class="settings-grid">
            <div class="grid-item1">
                <p>user: </p> <br>
                <p>email: </p> <br>

            </div>
            <div class="grid-item2">
                <p><?php echo $user['username'] ?></p> <br>
                <p> <?php echo $user['email'] ?></p> <br>
            </div>
            <div class="grid-item3">
                <p>settings</p>
            </div>
            <div class="grid-item4">
                <a href="/app/settings/edit-avatar.php">edit avatar</a><br>
                <a href="/app/settings/edit-password.php">edit password</a><br>
                <a href="/app/settings/edit-email.php">edit email</a><br>


            </div>
            <div class="grid-item5">Bio</div>
            <div class="grid-item6">
                <form action="/app/settings/edit-bio.php" method="POST">
                    <label for="bio"></label>
                    <textarea name="bio" id="bio" cols="30" rows="6" placeholder="Add some info" maxlength="100"><?php echo $user['biography']; ?></textarea><br>
                    <button type="submit">Update bio</button>
                </form>
            </div>
            <div class="grid-item7">
                <a href="/app/users/delete-user.php"> delete user </a>
                <a href="/app/users/user-posts.php">my posts</a><br>
            </div>

        </div>


    </section>
</main>

<?php require __DIR__ . ('/../views/footer.php'); ?>