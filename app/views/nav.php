<?php //Abow css fuck that 

require __DIR__ . ('/header.php');


$avatarImage = $_SESSION['user']['avatar'];

?>

<nav>
    <ul>
        <li><a href="/../../index.php">Index</a></li>

        <?php if (isset($_SESSION['user'])) : ?>
            <li><a href="app/users/logout.php"> Log out</a> </li>
        <?php endif; ?>

        <?php if (!isset($_SESSION['user'])) : ?>
            <li><a href="app/users/login.php"> Login</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <li><a href="/../../my-profile.php"><?php echo $_SESSION['user']['username'] ?></a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <li><img src="<?php echo "app/images/$avatarImage" ?>" width="40px" height="40px" alt=""></li>
        <?php endif; ?>

    </ul>


</nav>

<?php require __DIR__ . ('/footer.php'); ?>