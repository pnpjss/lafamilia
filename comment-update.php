<?php

require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/nav.php');

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
}

if (isset($_GET['commentid'], $_GET['updatekey'])) {
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

        <form class="update-form-user" action="/app/posts/postedit.php?postid=<?= $postId ?>" method="post">
            <label for="title"></label>
            <input type="text" name="title" id="title" placeholder="<?= $post['title'] ?>">
            <label for="url"></label>
            <input type="url" name="url" id="url" placeholder="<?= $post['url'] ?>">
            <label for="description"></label>
            <textarea name="description" id="description" cols="30" rows="10"><?= $post['description'] ?></textarea>
            <button type="submit">Update Post</button>
        </form>
    </section>
</main>