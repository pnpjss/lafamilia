<?php
//login fungerar
require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
// require __DIR__ . ('/nav.php');


if (isset($_POST['username'], $_POST['pwd'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);


    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);



    if (!$user) {
        echo 'bad login';
    }
    if (password_verify($_POST['pwd'], $user['passwd'])) {

        unset($user['pwd']);
        $_SESSION['user'] = $user;
        redirect('/../../index.php');
    } else {
        echo 'bad login';
    }
}

?>

<p>Welcomers</p>
<br>
<form action="login.php" method="POST">
    <label for="username">username</label>
    <input type="text" name="username" id="username">
    <label for="pwd">password</label>
    <input type="text" name="pwd" id="pwd">
    <button type="submit">Login</button>
</form>

<a href="/../../user-setup.php">Create user</a>