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
    $statement->bindParam(':id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $query = "DELETE FROM upvotes WHERE user_id = :id";
    $statement = $pdo->prepare($query);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $query = "DELETE FROM comments WHERE user_id = :id";
    $statement = $pdo->prepare($query);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $query = "DELETE FROM posts WHERE id = :id";
    $statement = $pdo->prepare($query);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $userId, PDO::PARAM_INT);
    $statement->execute();

    session_unset();
    exit(redirect('/../../index.php'));
}
?>
<main>
    <section>
        <form class="update-form-user" action="delete-user.php" method="post">
            <label for="delete">enter username to delete account</label>
            <input type="text" name="username" id="username">
            <button type="submit">delete account</button>
        </form>
    </section>
</main>