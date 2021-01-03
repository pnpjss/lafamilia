<?php
// funkar
// Fixa datum?!
require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');


if (isset($_POST['username'], $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['pwd'], $_POST['pwdconfirm'])) {


    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $pw = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);
    $pwdconfirm = filter_var($_POST['pwdconfirm'], FILTER_SANITIZE_STRING);
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $pwdconfirm = password_hash($pwdconfirm, PASSWORD_DEFAULT);

    if ($pw !== $pwconfirm) {
        echo "Password incorrect";
        $error = $_SESSION['error'];
    }



    $query = "INSERT INTO users (username, email, firstname, lastname, passwd) VALUES (:username, :email, :firstname, :lastname, :pwd)";
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $statement->bindParam(':pwd', $pw, PDO::PARAM_STR);
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
    <input type="text" name="username" id="username" required>

    <label for="email">email</label>
    <input type="text" name="email" id="email" required>

    <label for="firstname">firstname</label>
    <input type="text" name="firstname" id="firstname">

    <label for="lastname">firstname</label>
    <input type="text" name="lastname" id="lastname">

    <label for="pwd">password</label>
    <input type="password" name="pwd" id="pwd" required>

    <label for="pwdconfirm">password</label>
    <input type="password" name="pwdconfirm" id="pwdconfirm" required>

    <button type="submit">save</button>

</form>


<?php require __DIR__ . ('/app/views/footer.php');
