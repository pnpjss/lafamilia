<?php
//login fungera

require __DIR__ . ('/app/views/header.php');

require __DIR__ . ('/app/autoload.php');

require __DIR__ . ('/app/views/nav.php');

require __DIR__ . ('/app/views/footer.php');

$statement = $pdo->query('SELECT posts.*, users.username FROM users INNER JOIN posts ON posts.user_id = users.id ORDER BY post_date DESC');

$userId = $_SESSION['user']['id'];
// FRÅGA VINCENT OM DENNA

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
if (!isset($_SESSION['user']['avatar'])) {
    $avatarImage = '/noavatar.png';
}

?>

<main>

    <section>
        <article class="index-container">
            <?php foreach ($posts as $post) : ?>

                <?php $postId = $post['id']; ?>
                <?php $likeCount = fetchLikes($pdo, $postId); ?>
                <?php $likeCheck = checkIfUserIdLikedPost($pdo, $postId, $userId); ?>
                <div class="index-title">

                    <h4> <?php echo $post['title']; ?> </h4>


                </div>
                <div class="index-description">
                    <p><?php echo $post['description'] ?></p>
                </div>
                <div class="index-url">

                    <a href="<?= $post['url']; ?>"><?php echo $post['url']; ?></a>
                </div>
                <div class="index-poster-info">
                    <p><?= "by : " . $post['username'] . " - " . $post['post_date']; ?></p>

                    <a href="comments.php?id=<?= $post['id'] ?>&title=<?= $post['title'] ?>">comment</a>
                </div>

                <div class="index-poster-likes">


                    <?php if (isset($likeCheck)) : ?>

                        <form action="dislike.php" method="post">
                            <label for="dislike"></label>
                            <input type="hidden" name="dislike" id="post_id" value="<?= $post['id']; ?>">
                            <button type="submit"><img src="dislike.png" height="15px" width="15px" alt=""></button>
                        </form>

                    <?php elseif (!$likeCheck) : ?>
                        <form action="like.php" method="post">
                            <label for="like"></label>
                            <input type="hidden" name="like" id="post_id" value="<?= $post['id'] ?>">
                            <button type="submit"><img src="likes.png" height=15px width="15px" alt=""></button>

                        </form>

                    <?php endif; ?>
                    <?= $likeCount['COUNT(*)'] . ' likes ' ?>

                </div>


            <?php endforeach; ?>
        </article>
    </section>
</main>