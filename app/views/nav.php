<?php //Abow css fuck that 




$avatarImage = $_SESSION['user']['avatar'];

?>

<nav>
    <ul> 
        

        <li><a href="/../../index.php"> la familia</a></li>
        <!-- <li><a href="/../../index.php">New</a></li> -->
        <li><a href="/../../index.php">Threads</a></li>
        <!-- <li><a href="/../../index.php">Past</a></li>
        <li><a href="/../../index.php">Comments</a></li> -->
        <li><a href="/../../index.php">Ask</a></li>
        <li><a href="/../../index.php">Show</a></li>
        <li><a href="/../../index.php">jobs</a></li>
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

        <!-- <?php if (isset($_SESSION['user'])) : ?>
            <li><img src="<?php echo "app/images/$avatarImage" ?>" width="40px" height="40px" alt=""></li>
        <?php endif; ?>
        detta är en ide men ???
        -->

    </ul>


</nav>

<?php require __DIR__ . ('/footer.php'); ?>