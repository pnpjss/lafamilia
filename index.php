<?php
//login fungerar


require __DIR__ . ('/app/views/header.php');

require __DIR__ . ('/app/autoload.php');

require __DIR__ . ('/app/views/nav.php');

require __DIR__ . ('/app/views/footer.php');

$statement = $pdo->query('SELECT posts.*, users.username FROM users INNER JOIN posts ON posts.user_id = users.id;');

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

// SELECT users.*, posts.user_id FROM users INNER JOIN posts ON users.id = posts.user_id;
//hämtar allt från users plus user_id from posts;


// $statement = $pdo->query('SELECT post.post_id, posts.user_id FROM users INNER JOIN user_id ON ');
// $test = $statement->fetch(PDO::FETCH_ASSOC);

// 

?>



<main>

    <section>
        <div class="post-container">
            <?php foreach ($posts as $post) : ?>
                <div class="post-item1"><?php echo $post['username'] ?></div>
                <div class="post-item2">
                    <b> <?php echo $post['title']; ?> </b><br>
                    <a href="<?php echo $post['url']; ?>"><?php echo $post['url']; ?></a>
                    <div><a href="comments.php?id=<?= $post['id'] ?>&title=<?= $post['title'] ?>">comment</a></div>
                </div>



            <?php endforeach; ?>
        </div>
    </section>
</main>

<!-- 

<?php foreach ($posts as $post) : ?>
        <?php $title = $post['title'];
        $url = $post['url'];
        $date = $post['post_date'];
        $description = $post['description']; ?>
        <p><?php echo $title ?></p><br>
        <br><br><br>
        <p><?php echo $url ?></p><br>
        <?php endforeach; ?>
    <br> -->