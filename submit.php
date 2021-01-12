<?php

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');

if (!isset($_SESSION['user'])) {

    redirect('/login.php?login=submit');
}

if (isset($_POST['title'], $_POST['url'], $_POST['description'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    addPost($pdo, $title, $url, $description);
}

// gör så man måste logga in!




?>

<main>
    <section>

        <form class="submit-grid-container" action="submit.php" method="post">
            <div class="submit-items title">
                <label for="title"></label>
                <input type="text" name="title" placeholder="title..">
            </div>
            <div class="submit-items url">
                <label for="url"></label>
                <input type="url" name="url" placeholder="url..">
            </div>
            <div class="submit-items description">
                <label for="description"></label>
                <textarea name="description" id="description" cols="30" rows="6" placeholder="article description.."></textarea>
            </div>
            <div class="submit-items btn">
                <button type="submit">Submit</button>
            </div>
        </form>



    </section>
</main>

<!-- 
Hur sorter vi det här? I vilken mapp? 
Hur ska databasen se ut? Se över vad som behövs
Denna sidan action = threads.php, där finns ingentin än så länge
Fundera över utseende -->