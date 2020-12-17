<?php
//login fungerar
require __DIR__ . ('/header.php');

$pdo = new PDO('sqlite:lafamilia.sqlite');

if (isset($_POST['username'], $_POST['passwd'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);


    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo 'bad login';
    }
    if (password_verify($_POST['passwd'], $user['passwd'])) {

        unset($user['passwd']);
        $_SESSION['user'] = $user;

        require __DIR__ . ('/my-profile.php');
    } else {
        echo 'bad login';
    }
}

?>

<p>Welcomers</p>
<br>
<form action="index.php" method="POST">
    <label for="username">username</label>
    <input type="text" name="username" id="username">
    <label for="passwd">password</label>
    <input type="text" name="passwd" id="passwd">
    <button type="submit">Login</button>
</form>