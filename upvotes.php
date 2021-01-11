<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

$posts = fetchMostLiked($pdo);


?>


<main>

    <section>
        <div class="upvotes-container">
            <?php foreach ($posts as $post) : ?>

                <div class="upvotes-title">

                    <h4> <?php echo $post['title']; ?> </h4>


                </div>
                <div class="upvotes-description">
                    <p><?php echo $post['description'] ?></p>
                </div>
                <div class="upvotes-url">

                    <a href="<?php echo $post['url']; ?>"><?php echo $post['url']; ?></a>
                </div>
                <div class="upvotes-poster-info">
                    <p><?php echo "by : " . $post['username']; ?></p>
                    <a href="upvotes.php?id=<?= $post['id'] ?>&title=<?= $post['title'] ?>">comment</a>

                </div>


            <?php endforeach; ?>
        </div>
    </section>
</main>