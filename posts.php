<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
}

$posts = getUserPosts($pdo, $userId);

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
        <article class="index-container">
            <?php foreach ($posts as $post) : ?>

                <?php $postId = $post['id']; ?>
                <?php $likeCount = getLikes($pdo, $postId); ?>
                <?php $likeCheck = likeCheck($pdo, $postId, $userId); ?>
                <div class="index-title">
                    <h4> <?= $post['title']; ?> </h4>
                </div>
                <div class="index-description">
                    <p><?= $post['description'] ?></p>
                </div>
                <div class="index-url">
                    <a href="<?= $post['url']; ?>"><?= $post['url']; ?></a>
                </div>
                <div class="index-poster-info">
                    <p><?= "by : " . $_SESSION['user']['username'] . " - " . $post['post_date']; ?></p>
                    <a href="<?= '/post-update.php?postid=' . $post['id'] . '&&updatekey=' . "$randomKey"; ?>">edit</a>
                    <!-- Include key  -->
                    <a href="<?= "/app/posts/postdelete.php?postid=" . $post['id'] . '&&updatekey=' .  "$randomKey"; ?>"> delete</a>
                </div>
                <div class="index-poster-likes">

                    <?php if (isset($_SESSION['user'])) : ?>
                        <?php if (isset($likeCheck)) : ?>

                            <form action="/app/posts/dislike.php" method="post">
                                <label for="dislike"></label>
                                <input type="hidden" name="dislike" id="post_id" value="<?= $post['id']; ?>">
                                <button type="submit"><img src="/app/images/dislike.png" height="15px" width="15px" alt=""></button>
                            </form>

                        <?php elseif (!$likeCheck) : ?>
                            <form action="/app/posts/like.php" method="post">
                                <label for="like"></label>
                                <input type="hidden" name="like" id="post_id" value="<?= $post['id'] ?>">
                                <button type="submit"><img src="/app/images/likes.png" height=15px width="15px" alt=""></button>

                            </form>

                        <?php endif; ?>
                    <?php endif; ?>

                    <?= $likeCount['COUNT(*)'] . ' likes ' ?>

                </div>
            <?php endforeach; ?>
        </article>
    </section>
</main>