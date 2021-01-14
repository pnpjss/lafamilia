<?php
// funkar
// Fixa datum?! 
require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

if (isset($_POST['username'], $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['pwd'], $_POST['pwdconfirm'])) {

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $firstName = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);
    $pwdConfirm = filter_var($_POST['pwdconfirm'], FILTER_SANITIZE_STRING);

    $username = checkUsername($pdo, $username);
    $email = checkEmail($pdo, $email);
    $pwd = checkPassword($pwd, $pwdConfirm);

    $addUser = addUser($pdo, $username, $email, $pwd, $firstName, $lastName);
}


if (isset($_GET['signup'])) {
    $login = $_GET['signup'];
    if ($login === 'username') {
        $loginMessage = 'username is already in use';
    }
    if ($login === 'email') {
        $loginMessage = 'email is already in use';
    }
    if ($login === 'password') {
        $loginMessage = 'incorrect password';
    }
} else {
    $loginMessage = null;
}

?>

<main>
    <section>
        <form class="register-form-container" action="register.php" method="post">

            <div class="register-form-item username">
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="username.." required>
            </div>
            <div class="register-form-item username">
                <label for="email"></label>
                <input type="text" name="email" id="email" placeholder="email.." required>
            </div>
            <div class="register-form-item username">
                <label for="firstname"></label>
                <input type="text" name="firstname" id="firstname" placeholder="first name..">
            </div>
            <div class="register-form-item username">
                <label for="lastname"></label>
                <input type="text" name="lastname" id="lastname" placeholder="last name..">
            </div>
            <div class="register-form-item username">
                <label for="pwd"></label>
                <input type="password" name="pwd" id="pwd" placeholder="password.." required>
            </div>
            <div class="register-form-item username">
                <label for="pwdconfirm"></label>
                <input type="password" name="pwdconfirm" id="pwdconfirm" placeholder="confirm password.." required>
            </div>
            <div class="register-form-item username">
                <button type="submit">save</button>
            </div>
            <div class="register-form-item Message">
                <b><?= $loginMessage ?></b>
            </div>
        </form>
    </section>
</main>

<?php require __DIR__ . ('/app/views/footer.php');
