<?php

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');



$currentEmail = $_SESSION['user']['email'];




if (isset($_POST['currentemail'], $_POST['newemail'])) {
    $inputold = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
    $inputnew = filter_var($_POST['newemail'], FILTER_SANITIZE_EMAIL);

    if ($currentEmail !== $inputold) {
        echo 'Bad information';
    } else if ($currentEmail === $inputold) {
        $query = "SELECT * FROM users where email LIKE :email";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':email', $inputnew, PDO::PARAM_STR);
        $statement->execute();
    }


    // $query = "UPDATE users SET email = :email WHERE username = :username";

    // $statement = $pdo->prepare($query);

    // if (!$statement) {
    //     die(var_dump($pdo->errorInfo()));
    // }

    // $statement->bindParam(':email', $newEmail, PDO::PARAM_STR);
    // $statement->bindParam(':username', $username, PDO::PARAM_STR);
    // $statement->execute();
}


?>
<main>
    <section>

        <h2>
            Change email
        </h2>

        <form action="edit-email.php" method="POST">

            <label for="newemail">Current Email</label>
            <input type="text" name="newemail" id="newemail" placeholder="Curre email">
            <label for="newemail">New Email</label>
            <input type="text" name="newemail" id="newemail" placeholder="New email">

            <button type="submit">submit changes</button>

        </form>
    </section>
</main>