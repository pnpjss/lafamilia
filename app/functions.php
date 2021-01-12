<?php

declare(strict_types=1);


if (!function_exists('redirect')) {
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
};


function newMail($pdo, $newemail)
{

    // kolla om email finns

};

function addPost($pdo, $title, $url, $description)
{

    $userId = $_SESSION['user']['id'];
    $postDate = date("Y-m-d, H:i");
    $query = "INSERT INTO posts (title, url, description, user_id, post_date) VALUES (:title, :url, :description, :user_id, :post_date)";
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':url', $url, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $statement->bindParam(':post_date', $postDate, PDO::PARAM_STR);
    $statement->execute();


    // fetcha post ID!!
    exit(redirect('/../index.php'));

    // msg
}

function addComment($pdo, $content, $postId)
{

    $userId = $_SESSION['user']['id'];
    $date = date("Y-m-d, H:i");
    $query = "INSERT INTO comments (post_id, user_id, content, date) VALUES (:post_id, :user_id, :content, :date)";
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->bindParam(':date', $date, PDO::PARAM_STR);
    $statement->execute();
}

function fetchPost($pdo, $postId)
{

    $statement = $pdo->query('SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = :id');
    $statement->BindParam(':id', $postId, PDO::PARAM_INT);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
    return $post;
}

function fetchComments($pdo, $postId)
{
    $statement = $pdo->prepare("SELECT * FROM comments WHERE post_id = :postId ORDER BY Comments.post_id DESC");
    $statement->BindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
    $userComments = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $userComments;
}

function fetchComment($pdo, $commentId)
{
    $statement = $pdo->prepare("SELECT * FROM comments WHERE id = :id");
    $statement->BindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->execute();
    $comment = $statement->fetch(PDO::FETCH_ASSOC);
    return $comment;
}
function commentUpdate($pdo, $commentUpdate, $commentId)
{
    $statement = $pdo->prepare("UPDATE comments SET content = :content WHERE id = :commentId");
    $statement->BindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->BindParam(':content', $commentUpdate, PDO::PARAM_STR);
    $statement->execute();
}

function fetchPostedBy($pdo, $commentUserId)
{
    $statement = $pdo->prepare("SELECT username, avatar from users where id = :commentUserId");
    $statement->BindParam(':commentUserId', $commentUserId, PDO::PARAM_INT);
    $statement->execute();
    $postedBy = $statement->fetch(PDO::FETCH_ASSOC);
    return $postedBy;
}






//  REGISTER USER
// String to lower?

function checkUsername($pdo, $username)
{
    $statement = $pdo->prepare("SELECT username FROM users WHERE username = :username");
    $statement->BindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        return $username;
    } else {
        exit(redirect('register.php?signup=username'));
    }
}

function checkPassword($pwd, $pwdConfirm)
{
    if ($pwd !== $pwdConfirm) {
        exit(redirect('register.php?signup=password'));
    } else {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        return $pwd;
    }
}

function checkEmail($pdo, $email)
{
    $statement = $pdo->prepare('SELECT email FROM users WHERE email = :email');
    $statement->BindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        return $email;
    } else {
        exit(redirect('register.php?signup=email'));
    }
}

function addUser($pdo, $username, $email, $pwd, $firstName, $lastName)
{

    $query = "INSERT INTO users (username, email, firstname, lastname, passwd, avatar) VALUES (:username, :email, :firstname, :lastname, :pwd, :avatar)";
    $statement = $pdo->prepare($query);
    $avatar = 'noavatar.png';
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':firstname', $firstName, PDO::PARAM_STR);
    $statement->bindParam(':lastname', $lastName, PDO::PARAM_STR);
    $statement->bindParam(':pwd', $pwd, PDO::PARAM_STR);
    $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
    $statement->execute();

    exit(redirect('register.php?signup=succes'));
}


// funktion som ser att allt är satt
//byt till checkVarExists ?


function addLike($pdo,  $postId, $userId)
{

    $query = "INSERT INTO upvotes (user_id, post_id) VALUES (:user_id, :post_id)";
    $statement = $pdo->prepare($query);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $statement->bindParam(':post_id', $postId, PDO::PARAM_STR);
    $statement->execute();
    exit(redirect('/../index.php'));
}

function deleteLike($pdo, $postId,  $userId)
{
    $query = "DELETE FROM upvotes WHERE user_id = :user_id AND post_id = :post_id";
    $statement = $pdo->prepare($query);

    $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $statement->bindParam(':post_id', $postId, PDO::PARAM_STR);
    $statement->execute();

    exit(redirect('/../index.php'));
}




function fetchLikes($pdo, $postId)
{
    $query = "SELECT COUNT(*) FROM upvotes WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);

    $statement->bindParam(':post_id', $postId, PDO::PARAM_STR);
    $statement->execute();
    $likeCount = $statement->fetch(PDO::FETCH_ASSOC);
    return $likeCount;
}
function checkIfUserIdLikedPost($pdo, $likePostId, $userId)
{
    $query = "SELECT COUNT(*) FROM upvotes WHERE post_id = :post_id AND user_id = :user_id";
    $statement = $pdo->prepare($query);

    $statement->bindParam(':post_id', $likePostId, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $statement->execute();
    $likeCheck = $statement->fetch(PDO::FETCH_ASSOC);
    if ($likeCheck['COUNT(*)'] > 0) {
        $likeCheck = $likeCheck['COUNT(*)'];
        return $likeCheck;
    }
}

function fetchMostLiked($pdo)
{

    $query = "SELECT posts.*, COUNT(*) AS 'likes' FROM posts INNER JOIN upvotes ON upvotes.post_id = posts.id GROUP BY posts.id ORDER BY COUNT(*) DESC";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
};
