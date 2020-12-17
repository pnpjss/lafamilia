<?php
// lös autoload och session
$pdo = new PDO('sqlite:lafamilia.sqlite');

if (isset($_POST['newemail'])) {
    die(var_dump($_SESSION['user']));
    $newEmail = filter_var($_POST['newemail'], FILTER_SANITIZE_STRING);
    echo $newEmail;



    $statement = $pdo->prepare("UPDATE users SET email = :newemail WHERE id = :id");
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
}


?>

<h1>Edit</h1>



<form action="my-profile.php" method="POST">

    <label for="newemail"></label>
    <input type="text" name="newemail" id="newemail">

    <button type="submit">submit changes</button>

</form>



<?php

// $pdo = new PDO('sqlite:lafamilia.sqlite');

// $statement = $pdo->prepare("SELECT * FROM users WHERE username like :username");
// $statement->bindParam(':username', $username, PDO::PARAM_STR);
// $statement->execute();
// $user = $statement->fetch(PDO::FETCH_ASSOC);
