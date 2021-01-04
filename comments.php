<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

$userId = $_SESSION['user']['id'];
$postId = $_GET['id'];
die(var_dump($user));



if (isset($_POST['comment'])) {
    $content = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    addComment($pdo, $content, $postId);
}

if (isset($_GET['id'])) {


    $post = fetchPost($pdo, $postId);
    $statement = $pdo->prepare("SELECT * FROM comments WHERE post_id = :postId
    ORDER BY Comments.post_id DESC");

    $statement->BindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $userComments = $statement->fetchAll(PDO::FETCH_ASSOC);

    // $statement = $pdo->query('SELECT * FROM comments WHERE post_id = :id');

    // $statement->bindParam(':id', $postId, PDO::PARAM_STR);
    // $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
}

?>

<main>
    <section>




        <form action="comments.php?id=<?= $postId; ?>" method="post">

            <textarea name="comment" id="comment" cols="30" rows="2" placeholder="add comment"></textarea>
            <br><br>
            <button type="text"> Submit comment </button>


        </form>

        <div class="yo">
            <?php foreach ($userComments as $comment) {
                foreach ($comment as $shit) {
                    echo $shit;
                }
            };
            die(var_dump($post));

            ?>
        </div>

    </section>
</main>