<?php //Abow css fuck that 


$avatar = $_SESSION['user']['avatar'];

?>

<nav>
    <ul>
        <li><a href="/../../index.php"> la familia</a></li>

        <li><a href="/../../top-posts.php">Upvoted</a></li>

        <li><a href="/../../submit.php">submit</a></li>

        <?php if (isset($_SESSION['user'])) : ?>
            <li><a href="/app/users/logout.php"> Log out</a> </li>
        <?php endif; ?>

        <?php if (!isset($_SESSION['user'])) : ?>
            <li><a href="/../../login.php"> Login</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <li><a href="/../../settings.php"><?= $_SESSION['user']['username'] ?></a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['user']['avatar'])) : ?>
            <li><img src="<?= "app/images/" . $_SESSION['user']['avatar'] ?>" width="35px" height="35px" alt=""></li>

        <?php endif; ?>

    </ul>

</nav>