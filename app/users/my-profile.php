<?php
require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');
require __DIR__ . ('/../views/nav.php');


$avatar = $_SESSION['user']['avatar'];
$bio = $_SESSION['user']['biography'];
$userId = $_SESSION['user']['id'];

if (isset($_FILES['avatar'])) {
    $image = $_FILES['avatar'];
    $imageName = $image['name'];
    $imageTempName = $image['tmp_name'];
    $imageType = $image['type'];
    $imageSize = $image['size'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    if ($imageActualExt === 'png' && $imageSize < 1000000) {
        $imageNewName = uniqid('', true) . "." . $imageActualExt;
        $imageDestination = 'app/images/' . $imageNewName;
        move_uploaded_file($imageTempName, $imageDestination);

        $query = "UPDATE users SET avatar = :avatar WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':avatar', $imageNewName, PDO::PARAM_STR);
        $statement->bindParam(':id', $userId, PDO::PARAM_STR);
        $statement->execute();
    }
}

if (isset($_POST['bio'])) {
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $id = $_SESSION['user']['id'];
    $statement = $pdo->prepare("UPDATE users SET biography = :bio WHERE id = :id");
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();
    $_SESSION['user']['biography'] = $bio;
    

}

if (isset($_POST['newemail']))
{
    $newemail = $_POST['newemail'];
    $newemail = newMail($pdo, $newemail);

}




// shows avatar if pre-exist and/or updates new avatar without need to relog
// $statement = $pdo->query('SELECT * FROM users WHERE id = :id');
// $statement->bindParam(':id', $userId, PDO::PARAM_STR);
// $user = $statement->fetch(PDO::FETCH_ASSOC);
// $avatar = $user['avatar'];
// $avatar = $_SESSION['user']['avatar'];

?>


<style>
.container{
display: flex;
justify-content:top;
align-items:center;
height: 100%;
margin-top:4rem;
width:100%
}
.left{
    align-items:center;
  
    width: 20%;
    flex-direction: column;

}
.right{
    width:70%;
  
    margin-left:1rem;
    align-items:center;
    flex-direction: column;
}
.item{
    width:100%;
    height : 10%;
    border: 1px solid black;
    padding: 1rem;

    /* background-color: white; */
}




</style>


    <div class="container left">
    <div class="item item1"><p>Username: </p></div>
    <div class="item item2"><p>Email: </p></div>
    <div class="item item3"><p>Bio: </p></div>
    <div class="item item4"><a href="change-password.php">Change Password</a></div>
    <div class="item item5"><a href="change-avatar.php">Change avatar</a></div>
    <div class="item item6"><a href="change-email.php">Change email</a></div>
    </div>
    <div class="container right">
    <div class="item item1"><p><?php echo $_SESSION['user']['username']; ?></p></div>
    <div class="item item2"><p><?php echo $_SESSION['user']['email']; ?></p></div>
  
    <div class="item item3"><form action="my-profile.php" method="POST">
    <label for="bio"></label>
    <textarea name="bio" id="bio" cols="30" rows="3" placeholder="<?php echo $bio; ?>"></textarea>
    
    <button type="submit">Update bio</button></form></div>
    
    <div class="item item4"><p>//</p></div>
    <div class="item item5"><img src="/app/images/<?php echo $_SESSION['user']['avatar']; ?>" alt="" height="50px" width="50px"></div>
    <div class="item item6">
    <form action="my-profile.php" method="post">
    
    <label for="newemail">new email</label>
    <input type="text" name="newemail">
    <button type="submit">check email</button>
    </form>
    
    <p><?php echo $newemail ?></p></div>
    
    
        
    </div>



<script src="settings.js"></script>


<?php require __DIR__ . ('/app/views/footer.php'); ?>

        <!-- <ul>
            <li><a href="change-email.php">Change email</a></li>
            <li><a href="change-password.php">Change Password</a></li>
            <li><a href="change-biography.php">Change biography</a></li>
            <li><a href="change-avatar.php">Change avatar</a></li>

        </ul>

            <img src="<?php echo "/app/images/$avatar" ?>" width="50px" height="50px" alt="">
            <a href="index.php"> Return </a>
        </div>
        <form action="my-profile.php" method="post">
            <label for="bio">Add bio</label>
            <textarea name="bio" id="bio" cols="30" rows="10">
        Add bio?
        </textarea>

        </form> -->