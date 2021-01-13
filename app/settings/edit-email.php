<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');

$currentEmail = $_SESSION['user']['email'];

if (isset($_POST['currentemail'], $_POST['newemail'])) {
    $inputold = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
    $inputnew = filter_var($_POST['newemail'], FILTER_SANITIZE_EMAIL);

    if ($currentEmail !== $inputold) {
        exit(redirect('/../../settings.php?error=email'));
    } else if ($currentEmail === $inputold) {
        $query = "SELECT * FROM users where email LIKE :email";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':email', $inputnew, PDO::PARAM_STR);
        $statement->execute();
        redirect('/../../settings.php?success=email');
    }
}
