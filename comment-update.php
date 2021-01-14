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
        $commentId = $_GET['commentid'];
        $comment = getComment($pdo, $commentId);
    } else {
        exit(redirect('/../../posts.php?error=getPost'));
        // write error
    }
}

?>
<main>
    <section>
        <form class="update-form-user" action="<?= '/app/posts/comment-edit.php?commentid=' . $commentId ?>" method="post">
            <textarea name="content" id="content" cols="30" rows="10"><?= $comment['content']; ?></textarea>
            <button name="submit-post" type="submit">Update Post</button>
        </form>
    </section>
</main>
<?php require __DIR__ . ('/../app/views/nav.php'); ?>