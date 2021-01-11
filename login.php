<?php
//login fungerar
require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');


?>

<main>
    <section>
        <form class="login-grid-container" action="/app/users/login.php" method="POST" autocomplete="off">
            <div class="login-grid image"> <img src="/app/images/noavatar.png" height="75px" width="75px" alt=""></div>
            <div class="item2"> <label for="username"></label><input type="text" name="username" id="username" placeholder="username/email"></div>
            <div class="item3"> <label for="pwd"></label><input type="password" name="pwd" id="pwd" placeholder="password"> </div>
            <div class="item4"> <button type="submit" class="loginbtn">Login</button> </div>
            <div class="item5"> <a href="register.php">register</a> </div>
            <div class="item6">
                <?php if (!isset($_GET['login'])) {
                    exit;
                } else {
                    $loginError = $_GET['login'];
                    if ($loginError == 'username') {
                        die(var_dump('weird login'));
                    }
                }


                ?></div>
        </form>
        </div>
    </section>
</main>

<?php require __DIR__ . ('/app/views/footer.php');
