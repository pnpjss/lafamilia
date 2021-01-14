<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
} else {
    redirect('/login.php?login=comment');
}
$postId = $_GET['id'];
$count = 0;

if (isset($_POST['comment'])) {
    $content = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    addComment($pdo, $content, $postId);
}

if (isset($_GET['id'])) {
    $post = getPost($pdo, $postId);
    // fetch the post from the superglobal $_GET['id']
    $userComments = fetchComments($pdo, $postId);
    // fetch the comments for the specific post.

}
// Create key to prohibit anyone from deleting or editing posts
// Should probably use forms with method=post instead
// Set key length
$keyLength = 15;
// Generate and return key
$randomKey = getRandomKey($keyLength);
// Store key in session array
$_SESSION['user']['updatekey'] = $randomKey;
// Not bullet proof..
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
        <div class="comments-items">
            <?php foreach ($userComments as $comment) : ?>
                <?php
                $count++;
                $commentUserId = $comment['user_id'];
                $commentAuthor = getPostAuthor($pdo, $commentUserId);
                ?>
                <div class="avatar">
                    <img src="<?php echo "/app/images/" . $commentAuthor['avatar']; ?>" height="50px" width="50px" alt="">
                </div>
                <div class="comment-info">
                    <?php echo '#' . $count; ?>
                    <b><?php echo $commentAuthor['username']; ?></b>
                    <?php echo $comment['date']; ?>
                    <div class="comment-content">
                        <?php echo $comment['content']; ?>
                    </div>
                </div>
                <div class="comment-edit">
                    <?php if ($commentUserId === $_SESSION['user']['id']) : ?>
                        <a href="<?= '/comment-update.php?commentid=' . $comment['id'] . '&&postid=' . $postId . '&&updatekey=' . $randomKey; ?>">edit</a>
                        <a href="<?= '/app/posts/comment-delete.php?commentid=' . $comment['id'] . '&&postid=' . $post['id'] . '&&updatekey=' . $randomKey; ?>">delete</a>
                    <?php endif; ?>
                </div>
                <span class="comment-span"></span>
            <?php endforeach; ?>
        </div>
        <div class="add-comment">
            <form action="comments.php?id=<?= $postId; ?>" method="post">
                <textarea name="comment" id="comment" cols="50" rows="5" placeholder="add comment" maxheight="200" maxlength="200"></textarea>
                <span class="comment-span"></span>
                <button type="text"> Submit comment </button>
            </form>
        </div>
    </section>
</main>
<?php require __DIR__ . ('/app/views/nav.php'); ?>