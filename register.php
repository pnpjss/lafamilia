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

?>

<main>
    <section>

        <form action="register.php" method="post">

            <label for="username">username</label>
            <input type="text" name="username" id="username" required>

            <label for="email">email</label>
            <input type="text" name="email" id="email" required>

            <label for="firstname">firstname</label>
            <input type="text" name="firstname" id="firstname">

            <label for="lastname">lastname</label>
            <input type="text" name="lastname" id="lastname">

            <label for="pwd">password</label>
            <input type="password" name="pwd" id="pwd" required>

            <label for="pwdconfirm">password</label>
            <input type="password" name="pwdconfirm" id="pwdconfirm" required>

            <button type="submit">save</button>

        </form>
        <?php

        if (!isset($_GET['signup'])) {
            exit();
        } else {
            $registerCheck = $_GET['signup'];
            if ($registerCheck == 'username') {
                echo 'this username is already taken:/';
            }
            if ($registerCheck == 'password') {
                echo 'password didnt match';
            }
            if ($registerCheck == 'email') {
                echo 'email is already taken';
            }
            if ($registerCheck == 'succes') {
                echo 'User created'; ?>
                <a href="<?php echo '/login.php' ?>">login</a>
        <?php
            }
        }

        ?>
    </section>
</main>

<?php require __DIR__ . ('/app/views/footer.php');
