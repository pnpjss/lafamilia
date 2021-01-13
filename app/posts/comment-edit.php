<?php
require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');

if (!$_SESSION['user']) {
    exit(redirect('/../../index.php'));
}

$user = $_SESSION['user'];
if ($_SESSION['user'] === $user) {
    die(var_dump('no session'));
}

if (isset($_GET['post-id'])) {
    $postId = $_GET['post-id'];
    $post = fetchPost($pdo, $postId);
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


        <div class="comments-postitem">
            <div class="title">
                <h1><?php echo $post['title']; ?></h1>
            </div>
            <div class="url"><a href="<?php echo $post['url']; ?>"><?php echo $post['url']; ?></a></div>
            <div class="description">
                <p><?php echo $post['description']; ?></p>
            </div>
            <div class="postinfo">
                <p><?= $post['post_date']; ?></p>
                <b><?= $post['username']; ?></b>
            </div>
        </div>



        <form class="comment-edit-container" action="<?= 'comment-edit.php?comment-id=' . $comment['id']  . '&&post-id=' . $postId; ?>" method="post">
            <label for="comment"></label>
            <textarea name="comment" id="" cols="30" rows="10"><?php echo $comment['content'] ?></textarea>
            <button type="submit">Save comment</button>

        </form>

        <!-- <form action="<?= 'comment-edit.php?delete-id=' . $comment['id']; ?>" method="post">
            <input type="submit">
            <button type="submit">Delete comment</button>
        </form> -->


    </section>
</main>