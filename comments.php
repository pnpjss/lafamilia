<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

$userId = $_SESSION['user']['id'];
$postId = $_GET['id'];
$count = 0;



if (isset($_POST['comment'])) {
    $content = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    addComment($pdo, $content, $postId);
}

if (isset($_GET['id'])) {


    $post = fetchPost($pdo, $postId);
    // fetch the post from the superglobal $_GET['id']

    $userComments = fetchComments($pdo, $postId);
    // fetch the comments for the specific post.

}







// gör om detta!!!
// gör så att post är 



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
            <div class="comments-items">
                <?php foreach ($userComments as $comment) : ?>
                    <?php
                    $count++;
                    $commentUserId = $comment['user_id'];
                    $postedBy = fetchPostedBy($pdo, $commentUserId); ?>
                    <div class="avatar">

                        <img src="<?php echo "/app/images/" . $postedBy['avatar']; ?>" height="50px" width="50px" alt="">
                    </div>

                    <div class="comment-info">
                        <?php echo '#' . $count; ?>
                        <b><?php echo $postedBy['username']; ?></b>
                        <?php echo $comment['date']; ?>
                        <div class="comment-content">
                            <?php echo $comment['content']; ?>
                        </div>

                    </div>
                    <div class="comment-edit">
                        <?php if ($commentUserId === $_SESSION['user']['id']) : ?>
                            <a href="<?php echo 'edit-comment.php?comment-id=' . $comment['id'] ?>">edit</a>
                        <?php endif; ?>
                    </div>
                    <span class="comment-span"></span>
                <?php endforeach; ?>
                <div class="add-comment">
                    <form action="comments.php?id=<?= $postId; ?>" method="post">

                        <textarea name="comment" id="comment" cols="50" rows="5" placeholder="add comment" maxheight="200" maxlength="200"></textarea>

                        <button type="text"> Submit comment </button>


                    </form>

                </div>
            </div>
        </div>


    </section>
</main>


<!-- 
<main>
    <section>

        <div class="comments-grid-container">

            <div class="comments-postitem">
                <div class="title">
                    <h3><?php echo $post['title']; ?></h3>
                </div>
                <div class="url"><a href="<?php echo $post['url']; ?>"><?php echo $post['url']; ?></a></div>
                <div class="postinfo">
                    <p><?= $post['post_date'] . "posted by: " . $post['username']; ?></p>
                </div>
            </div>


            <?php foreach ($userComments as $comment) : ?>
                <div class="user-comments">
                    <b><?php echo $comment['user_id']; ?></b>
                    <?php$commentUserId = $comment['user_id'];
                    $commentUserId = $comment['user_id'];
                    $postedBy = fetchPostedBy($pdo, $commentUserId);

                    echo $postedBy['username']; ?>
                    <?php $commentersAvatar = $postedBy['avatar']; ?>


                    <img src="<?php echo "/app/images/$commentersAvatar" ?>" width="50px" height="50px" alt="">

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
</main> -->