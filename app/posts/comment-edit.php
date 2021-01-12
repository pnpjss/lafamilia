<?php
require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');

if (isset($_GET['post-id'])) {
    $postId = $_GET['post-id'];
};
if (isset($_GET['comment-id'])) {
    $commentId = $_GET['comment-id'];
    $comment = fetchComment($pdo, $commentId);
}

if (isset($_POST['comment'])) {
    $commentUpdate = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

    $commentUpdate = commentUpdate($pdo, $commentUpdate, $commentId, $postId);
}

// behöver nog redirect till en annan sida fan:/ bensträckare nu


?>


<main>
    <section>
        <form action="<?= 'comment-edit.php?comment-id=' . $comment['id']  . '&&post-id=' . $postId; ?>" method="post">
            <label for="comment"></label>
            <textarea name="comment" id="" cols="30" rows="10"><?php echo $comment['content'] ?></textarea>
            <button type="submit">Save comment</button>

        </form>

        <form action="<?= 'comment-delete.php?delete-id=' . $comment['id']; ?>" method="post">
            <input type="hidden">
            <button type="submit">Delete comment</button>
        </form>


    </section>
</main>