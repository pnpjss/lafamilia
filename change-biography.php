<?php
// lös autoload och session
// fetcha session info? hur?
$pdo = new PDO('sqlite:lafamilia.sqlite');



if (isset($_POST['newemail'], $_POST['username'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $newEmail = filter_var($_POST['newemail'], FILTER_SANITIZE_EMAIL);
    echo "$newEmail" . " = new email    ";
    echo "$username" . " = username    ";



    $query = "UPDATE users SET email = :email WHERE username LIKE 'BBB'";

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':email', $newEmail, PDO::PARAM_STR);
    // $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    // $user = $statement->fetch(PDO::FETCH_ASSOC);
}


?>

<h1>Edit</h1>

<br>

<h2>
    To change email, you need to provide the old email, new email and your password
</h2>

<form action="change-email.php" method="POST">

    <label for="newemail"></label>
    <input type="text" name="newemail" id="newemail">
    <label for="username"></label>
    <input type="text" name="username" id="username" placeholder="username">

    <button type="submit">submit changes</button>

</form>