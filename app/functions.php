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
    $postDate = date("F j, Y, g:i a");
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
}

function addComment($pdo, $content, $postId)
{

    $userId = $_SESSION['user']['id'];
    $date = date("F j, Y, g:i a");
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
    $statement = $pdo->query('SELECT * FROM posts WHERE id = :id');
    $statement->BindParam(':id', $postId, PDO::PARAM_INT);
    $statement->execute();
    $post = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $post;
}
