<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

if (!isset($_SESSION['user'])) {

    redirect('/login.php?login=submit');
}

$replyComment = $_GET['id'];
if (isset($_POST['comment'])) {

    
    
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    addCommentReply($pdo ,$comment, $replyComment);
    goToPostByCommentId($pdo, $replyComment);
    
}

?>
<main>
    <section>
        <form class="submit-grid-container" action=" <?='/comment-reply-form.php?id=' . $replyComment ?>" method="post">
            <div class="submit-items title">
                <label for="comment"></label>
                <input type="text" name="comment" id="comment" placeholder="Reply to comment..">
            </div>
            <div class="submit-items btn">
                <button type="submit">Submit</button>
            </div>
        </form>
    </section>
</main>
<?php require __DIR__ . ('/app/views/nav.php'); ?>