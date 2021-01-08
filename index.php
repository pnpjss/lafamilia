<?php
//login fungerar


require __DIR__ . ('/app/views/header.php');

require __DIR__ . ('/app/autoload.php');

require __DIR__ . ('/app/views/nav.php');

require __DIR__ . ('/app/views/footer.php');

$statement = $pdo->query('SELECT posts.*, users.username FROM users INNER JOIN posts ON posts.user_id = users.id ORDER BY post_date DESC');

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

// SELECT users.*, posts.user_id FROM users INNER JOIN posts ON users.id = posts.user_id;
//hämtar allt från users plus user_id from posts;


// $statement = $pdo->query('SELECT post.post_id, posts.user_id FROM users INNER JOIN user_id ON ');
// $test = $statement->fetch(PDO::FETCH_ASSOC);

// 

?>



<main>

    <section>
        <article class="index-container">
            <?php foreach ($posts as $post) : ?>

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

                    <form action="votes.php">

                    </form>
                    <a href="comments.php?id=<?= $post['id'] ?>&title=<?= $post['title'] ?>">comment</a>

                </div>


            <?php endforeach; ?>
        </article>
    </section>
</main>