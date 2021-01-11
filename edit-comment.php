<?php
require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

if (isset($_GET['comment-id'])) {
    $commentId = $_GET['comment-id'];
    $comment = fetchComment($pdo, $commentId);
}

if (isset($_POST['comment'])) {
    $commentUpdate = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

    $commentUpdate = commentUpdate($pdo, $commentUpdate, $commentId);
}

// behöver nog redirect till en annan sida fan:/ bensträckare nu


?>


<main>
    <section>
        <form action="<?php echo 'edit-comment.php?comment-id=' . $comment['id'] ?>" method="post">
            <label for="comment"></label>
            <textarea name="comment" id="" cols="30" rows="10"><?php echo $comment['content'] ?></textarea>
            <button type="submit">Save comment</button>

        </form>


    </section>
</main>