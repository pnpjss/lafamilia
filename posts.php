<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');
$userId = $_SESSION['user']['id'];
$posts = getUserPosts($pdo, $userId);


?>
<main>
    <section>
        <article class="index-container">
            <?php foreach ($posts as $post) : ?>
                <!-- Set key length for post delete. -->
                <?php $keyLength = 15; ?>
                <!-- Generate key  -->
                <?php $randomKey = getRandomKey($keyLength); ?>
                <!-- Add key to session  -->
                <?php $_SESSION['user']['deletekey'] = $randomKey; ?>
                <?php $postId = $post['id']; ?>
                <?php $likeCount = fetchLikes($pdo, $postId); ?>
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
                    <p><?= "by : " . $post['username'] . " - " . $post['post_date']; ?></p>
                    <a href="comments.php?id=<?= $post['id'] ?>">edit</a>
                    <!-- Include key  -->
                    <a href=<?= "/app/posts/postdelete.php?postid=" . $post['id'] . '&&deletekey=' .  $randomKey; ?>>delete</a>
                </div>

                <?php if (isset($_GET['id'])) : ?>
                    <div class="post-edit">


                    </div>

                <?php endif; ?>


            <?php endforeach; ?>
        </article>
    </section>
</main>