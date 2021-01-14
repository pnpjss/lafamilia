<?php
//login fungerar
require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

if (isset($_GET['login'])) {
    $signInMessage = $_GET['login'];

    if ($signInMessage === 'username') {
        $message = 'Username was not found';
    }
    if ($signInMessage === 'submit') {
        $message = 'Login or register to submit a new topic';
    }
    if ($signInMessage === 'comment') {
        $message = 'Login to comment on a post';
    }
    if ($signInMessage === 'password') {
        $message = 'Wrong password';
    }
    if ($signInMessage === 'new-user') {
        $message = 'login to get started';
    }
} else {
    $message = null;
}


?>

<main>
    <section>
        <form class="login-grid-container" action="/app/users/login.php" method="POST" autocomplete="off">
            <div class="login-item-image"> <img src="/app/images/noavatar.png" height="75px" width="75px" alt=""></div>
            <div class="login-item-username"> <label for="username"></label><input type="text" name="username" id="username" placeholder="username/email"></div>
            <div class="login-item-password"> <label for="pwd"></label><input type="password" name="pwd" id="pwd" placeholder="password"> </div>
            <div class="login-item"> <button type="submit" class="loginbtn">Login</button> </div>
            <div class="login-item-register"> <a href="register.php">register</a> </div>
            <div class="login-item-signInMessage">
                <b> <?= $message; ?></b>

            </div>
        </form>
        </div>
    </section>
</main>

<?php require __DIR__ . ('/app/views/footer.php');
