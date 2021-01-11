<?php //Abow css fuck that 


$avatarImage = $_SESSION['user']['avatar'];

?>

<nav>
    <ul>
        <li><a href="/../../index.php"> la familia</a></li>

        <li><a href="/../../upvotes.php">Upvoted</a></li>

        <li><a href="/../../submit.php">submit</a></li>

        <?php if (isset($_SESSION['user'])) : ?>
            <li><a href="/app/users/logout.php"> Log out</a> </li>
        <?php endif; ?>

        <?php if (!isset($_SESSION['user'])) : ?>
            <li><a href="/../../login.php"> Login</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <li><a href="/../../settings.php"><?php echo $_SESSION['user']['username'] ?></a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['user']['avatar'])) : ?>
            <li><img src="<?php echo "app/images/$avatarImage" ?>" width="50px" height="50px" alt=""></li>

        <?php endif; ?>

    </ul>

</nav>