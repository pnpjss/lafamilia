<?php 

require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/nav.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/footer.php');

if(isset($_POST['title'],$_POST['url'], $_POST['text'])){
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);


}

?>

<main>
<section>

<form action="threads.php" method="post">
<label for="title">Title:</label>
<input type="text" name="title">
<br>
<label for="url">Url:</label>
<input type="text" name="url">
<br>
<label for="text">Text</label>
<textarea name="text" id="text" cols="30" rows="10"></textarea>
<br>
<button type="submit">Submit</button>

</form>

</section>
</main>

<!-- 
Hur sorter vi det här? I vilken mapp? 
Hur ska databasen se ut? Se över vad som behövs
Denna sidan action = threads.php, där finns ingentin än så länge
Fundera över utseende -->