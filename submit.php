<?php 

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');


if(isset($_POST['title'],$_POST['url'], $_POST['description'])){
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    
    addPost($pdo, $title, $url, $description);


}

?>

<main>
<section>

<form action="submit.php" method="post">
<label for="title">Title:</label>
<input type="text" name="title">
<br>
<label for="url">Url:</label>
<input type="url" name="url">
<br>
<label for="description">Description</label>
<textarea name="description" id="description" cols="30" rows="10"></textarea>
<br>
<button type="submit">Submit</button>

</form>

<?php echo $url; ?>

</section>
</main>

<!-- 
Hur sorter vi det här? I vilken mapp? 
Hur ska databasen se ut? Se över vad som behövs
Denna sidan action = threads.php, där finns ingentin än så länge
Fundera över utseende -->