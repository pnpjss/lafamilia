<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

$userId = $_SESSION['user']['id'];
$postId = $_GET['id'];




if (isset($_POST['comment'])) {
    $content = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    addComment($pdo, $content, $postId);
}

if (isset($_GET['id'])) {


    $post = fetchPost($pdo, $postId);
    // fetch the post from the superglobal $_GET['id']

    $userComments = fetchComments($pdo, $postId);
    // fetch the comments for the specific post.

    // $commentersUserId = $userComments[];
    // foreach ($userComments as $userComment) {
    //     die(var_dump($userComment['id']));
    //     $postedBy = fetchPostedBy($pdo, $commentUserId);
    // }
    // fetch the commenters username for each comment
}
// select * from comments  
// inner join posts.post_id on comments.post_id,  
// inner join TableC C on A.Column=C.Column

?>

<main>
    <section>

        <div class="comments-grid-container">
            <div class="comments-postitem">
                <div class="postitem1"><?php echo $post['title']; ?></div>

                <div class="postitem2"><?php echo $post['url']; ?></div>
                <div class="postitem3">
                    <?php echo $post['user']; ?>
                    <?php echo $post['post_date']; ?>
                    <!-- <?php print_r($userComments); ?> -->


                </div>
            </div>
            <?php foreach ($userComments as $comment) : ?>
                <div class="user-comments">
                    <b><?php echo $comment['user_id']; ?></b>
                    <?php
                    $commentUserId = $comment['user_id'];
                    $statement = $pdo->prepare("SELECT username from users where id = :commentUserId");
                    $statement->BindParam(':commentUserId', $commentUserId, PDO::PARAM_INT);
                    $statement->execute();
                    $postedBy = $statement->fetch(PDO::FETCH_ASSOC);
                    echo $postedBy['username'];
                    ?>
                </div>

            <?php endforeach; ?>

            <div class="add-comment">
                <form action="comments.php?id=<?= $postId; ?>" method="post">

                    <textarea name="comment" id="comment" cols="30" rows="2" placeholder="add comment"></textarea>
                    <br><br>
                    <button type="text"> Submit comment </button>


                </form>

            </div>


        </div>




    </section>
</main>