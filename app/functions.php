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

    exit(redirect('/../index.php'));
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

function getPost($pdo, $postId)
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

function getComment($pdo, $commentId)
{
    $statement = $pdo->prepare("SELECT * FROM comments WHERE id = :id");
    $statement->BindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->execute();
    $comment = $statement->fetch(PDO::FETCH_ASSOC);
    return $comment;
}

function getPostAuthor($pdo, $commentUserId)
{
    $statement = $pdo->prepare("SELECT username, avatar from users where id = :commentUserId");
    $statement->BindParam(':commentUserId', $commentUserId, PDO::PARAM_INT);
    $statement->execute();
    $commentAuthor = $statement->fetch(PDO::FETCH_ASSOC);
    return $commentAuthor;
}

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

    exit(redirect('/login.php?login=new-user'));
}

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

function addLikeToComment($pdo,  $commentId, $userId, $postId)
{

    $query = "INSERT INTO comment_upvotes (user_id, comment_id) VALUES (:user_id, :comment_id)";
    $statement = $pdo->prepare($query);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $statement->bindParam(':comment_id', $commentId, PDO::PARAM_STR);
    $statement->execute();
    
    exit(redirect("/../comments.php?id=$postId"));
}

function deleteLikeToComment($pdo, $commentId,  $userId, $postId)
{
    $query = "DELETE FROM comment_upvotes WHERE user_id = :user_id AND comment_id = :comment_id";
    $statement = $pdo->prepare($query);

    $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $statement->bindParam(':comment_id', $commentId, PDO::PARAM_STR);
    $statement->execute();

    exit(redirect("/../comments.php?id=$postId"));
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

function getLikes($pdo, $postId)
{
    $query = "SELECT COUNT(*) FROM upvotes WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);

    $statement->bindParam(':post_id', $postId, PDO::PARAM_STR);
    $statement->execute();
    $likeCount = $statement->fetch(PDO::FETCH_ASSOC);
    return $likeCount;
}

function getCommentLikes($pdo, $commentId)
{
    $query = "SELECT COUNT(*) FROM comment_upvotes WHERE comment_id = :comment_id";
    $statement = $pdo->prepare($query);

    $statement->bindParam(':comment_id', $commentId, PDO::PARAM_STR);
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

function commentLikeCheck($pdo, $likeCommentId, $userId)
{
    $query = "SELECT COUNT(*) FROM comment_upvotes WHERE comment_id = :comment_id AND user_id = :user_id";
    $statement = $pdo->prepare($query);

    $statement->bindParam(':comment_id', $likeCommentId, PDO::PARAM_STR);
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

function updateBio($pdo, $bio, $userId,)
{
    $statement = $pdo->prepare("UPDATE users SET biography = :bio WHERE id = :id");
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':id', $userId, PDO::PARAM_STR);
    $statement->execute();
    $_SESSION['user']['biography'] = $bio;
    exit(redirect('/../settings.php'));
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

function deletePost($pdo, $postId)
{

    $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $statement->BindParam(':id', $postId, PDO::PARAM_INT);
    $statement->execute();

    exit(redirect('/../posts.php'));
};

function getRandomKey($keyLength = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomKey = '';
    for ($i = 0; $i < $keyLength; $i++) {
        $randomKey .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomKey;
}


function updateEmail($pdo, $email, $newEmail, $currentEmail, $userId)
{
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $newEmail = filter_var($_POST['new-email'], FILTER_SANITIZE_EMAIL);

    if ($currentEmail !== $email) {
        exit(redirect('settings.php?error=email'));
    } else if ($currentEmail === $email) {
        $query = "UPDATE users SET email = :email WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':email', $newEmail, PDO::PARAM_STR);
        $statement->bindParam(':id', $userId, PDO::PARAM_STR);
        $statement->execute();
        // $_SESSION['user']['email'] = $newEmail;
        redirect('settings.php?success=email');
    }
};

function updatePassword($pdo, $oldPwd, $newPwd, $userId)
{

    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :userId");
    $statement->bindParam(':userId', $userId, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify($oldPwd, $user['passwd'])) {
        $newPwd = password_hash($newPwd, PASSWORD_DEFAULT);
        $statement = $pdo->prepare("UPDATE users SET passwd = :newpwd WHERE id = :userId");
        $statement->bindParam(':userId', $userId, PDO::PARAM_STR);
        $statement->bindParam(':newpwd', $newPwd, PDO::PARAM_STR);
        $statement->execute();
        redirect('/settings.php?success=password');
    } else {
        redirect('/settings.php?error=password');
    }
}

function updatePost($pdo, $title, $url, $description, $postId)
{
    $statement = $pdo->prepare("UPDATE posts SET title = :title, url = :url, description = :description WHERE id = :id");
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':url', $url, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->execute();
}
