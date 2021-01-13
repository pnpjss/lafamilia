<?php

require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/nav.php');

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
}

if (isset($_GET['postid'], $_GET['updatekey'])) {
    $editKey = $_GET['updatekey'];

    if ($editKey === $_SESSION['user']['updatekey']) {
        $postId = $_GET['postid'];
        $post = getPost($pdo, $postId);
    } else {
        exit(redirect('/../../posts.php?error=getPost'));
        // write error
    }
}

?>

<main>
    <section>

        <form class="update-form" action="post-update.php" method="post">
            <input type="text" name="title" id="title" placeholder="<?= $post['title'] ?>">
            <input type="url" name="url" id="url" placeholder="<?= $post['url'] ?>">
            <textarea name="update" id="update" cols="30" rows="10"><?= $post['description'] ?></textarea>
            <button type="submit">Update Post</button>
        </form>
    </section>
</main>