<?php

declare(strict_types=1);


if (!function_exists('redirect')) {
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
};


function getPosts($pdo, $posts)
{
    $statement = $pdo->query('SELECT posts.*, users.username FROM users INNER JOIN posts ON posts.user_id = users.id ORDER BY post_date DESC');
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
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
function commentUpdate($pdo, $commentUpdate, $commentId, $postId)
{


    $statement = $pdo->prepare("UPDATE comments SET content = :content WHERE id = :id");
    $statement->BindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->BindParam(':content', $commentUpdate, PDO::PARAM_STR);
    $statement->execute();

    exit(redirect('/comments.php?id=' . $postId));
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
function likeCheck($pdo, $likePostId, $userId)
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

function getMostLiked($pdo)
{
    // saknar ju username här det suger lite
    $query = "SELECT COUNT(upvotes.post_id) AS votes, posts.*, users.username FROM upvotes
    INNER JOIN posts
    ON posts.id = upvotes.post_id
    INNER JOIN users 
    ON posts.user_id = users.id
    GROUP BY 
    posts.id;";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
};




function changeBio($pdo, $userId, $bio)
{
    $statement = $pdo->prepare("UPDATE users SET biography = :bio WHERE id = :id");
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':id', $userId, PDO::PARAM_STR);
    $statement->execute();
    $_SESSION['user']['biography'] = $bio;
    exit(redirect('/../../settings.php'));
}

function updateAvatar($pdo, $image, $userId)
{

    $imageName = $image['name'];
    $imageTempName = $image['tmp_name'];

    $imageSize = $image['size'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    if ($imageActualExt === 'png' && $imageSize < 1000000) {
        $imageNewName = uniqid('', true) . "." . $imageActualExt;
        $imageDestination = '/images' . $imageNewName;
        move_uploaded_file($imageTempName, $imageDestination);

        $query = "UPDATE users SET avatar = :avatar WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':avatar', $imageNewName, PDO::PARAM_STR);
        $statement->bindParam(':id', $userId, PDO::PARAM_STR);
        $statement->execute();
    }
    exit(redirect('/../settings.php'));
};


function getUserPosts($pdo, $userId)
{
    $statement = $pdo->prepare("SELECT * FROM posts WHERE user_id = :user_id");
    $statement->BindParam(':user_id', $userId, PDO::PARAM_STR);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function deletePost($pdo, $userId, $postId)
{

    $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $statement->BindParam(':id', $postId, PDO::PARAM_STR);
    $statement->execute();

    exit(redirect('/posts.php'));
};

function getRandomKey($keyLength)
{
    $randomKey = '';
    for ($i = 0; $i < $keyLength; $i++) {
        $randomKey .= chr(mt_rand(33, 126));
    }
    return $randomKey;
}
