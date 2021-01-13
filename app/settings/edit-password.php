<?php

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');





if (isset($_POST['oldpwd'], $_POST['newpwd'], $_POST['confirmpwd'])) {

    $userId = $_SESSION['user']['id'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :userId");
    $statement->bindParam(':userId', $userId, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $oldpwd = filter_var($_POST['oldpwd'], FILTER_SANITIZE_STRING);
    $newpwd = filter_var($_POST['newpwd'], FILTER_SANITIZE_STRING);
    $confirmpwd = filter_var($_POST['confirmpwd'], FILTER_SANITIZE_STRING);

    if (password_verify($_POST['oldpwd'], $user['passwd']) && $newpwd === $confirmpwd) {
        $newpwd = password_hash($newpwd, PASSWORD_DEFAULT);
        $statement = $pdo->prepare("UPDATE users SET passwd = :newpwd WHERE id = :userId");
        $statement->bindParam(':userId', $userId, PDO::PARAM_STR);
        $statement->bindParam(':newpwd', $newpwd, PDO::PARAM_STR);
        $statement->execute();
        $message = 'Password has been updated';
    } else {
        $message = 'Bad password';
    }
}

?>
<style>
    .changepassword {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
    }
</style>
<main>
    <section>


        <form class="changepassword" action="edit-password.php" method="POST">
            <label for="oldpwd">Old password</label>
            <input type="password" name="oldpwd" id="oldpwd">
            <br>
            <label for="newpwd">New password</label>
            <input type="password" name="newpwd" id="newpwd">
            <br>
            <label for="confirmpwd">Confirm password</label>
            <input type="password" name="confirmpwd" id="confirmpwd">
            <button type="submit">Submit</button>
            <p><?php echo $message; ?></p>
        </form>


    </section>
</main>