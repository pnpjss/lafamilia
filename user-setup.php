<?php
// funkar
declare(strict_types=1);
session_start();
require __DIR__ . ('/header.php');
$pdo = new PDO('sqlite:lafamilia.sqlite');

if (isset($_POST['username'], $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['passwd'])) {


    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_EMAIL);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_EMAIL);
    $pw = filter_var($_POST['passwd'], FILTER_SANITIZE_EMAIL);
    $pw = password_hash($pw, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, firstname, lastname, passwd) VALUES (:username, :email, :firstname, :lastname, :passwd)";
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $statement->bindParam(':passwd', $pw, PDO::PARAM_STR);
    $statement->execute();
}




$statement = $pdo->query('SELECT * FROM users');

$users = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $user) {
    echo $user['username'];
    echo $user['email'];
    echo $user['firstname'];
    echo $user['lastname'];
    echo $user['passwd'];
?> <br> <?php
    };


        ?>

<form action="user-setup.php" method="post">

    <label for="username">username</label>
    <input type="text" name="username" id="username">

    <label for="email">email</label>
    <input type="text" name="email" id="email">

    <label for="firstname">firstname</label>
    <input type="text" name="firstname" id="firstname">

    <label for="lastname">firstname</label>
    <input type="text" name="lastname" id="lastname">

    <label for="passwd">password</label>
    <input type="password" name="passwd" id="passwd">

    <button type="submit">save</button>

</form>


</body>

</html>