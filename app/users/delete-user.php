<?php

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');

$userId = $_SESSION['user']['id'];

if (isset($_POST['username'])) {
    $query = "DELETE FROM users WHERE id = :id";
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $userId, PDO::PARAM_STR);
    $statement->execute();

    session_unset();
    exit(redirect('/../../index.php'));
}

?>


<main>
    <section>
        <form action="delete-user.php" method="post">

            <label for="username">input username to delete account</label>
            <input type="text" name="username">

            <br>

            <button type="submit"> Delete for sure. </button>


        </form>
    </section>
</main>