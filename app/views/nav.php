<nav>
    <ul>
        <li><a href="/../../index.php?latest">home</a></li>

        <li><a href="/../../index.php?top-posts">top posts</a></li>

        <li><a href="/../../submit.php">submit</a></li>

        <?php if (isset($_SESSION['user'])) : ?>
            <li><a href="/app/users/logout.php"> Log out</a> </li>
        <?php endif; ?>

        <?php if (!isset($_SESSION['user'])) : ?>
            <li><a href="/../../login.php"> Login</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <li><a href="<?= '/../../settings.php?user=' . $_SESSION['user']['username'];  ?>"><?= $_SESSION['user']['username'] ?></a></li>
        <?php endif; ?>

    </ul>

</nav>