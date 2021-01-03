<?php
//login fungerar
require __DIR__ . ('/app/autoload.php');
require __DIR__ . ('/app/views/header.php');
require __DIR__ . ('/app/views/nav.php');


?>

<main>
<section>

    <form class="login-grid-container" action="/app/users/login.php" method="POST" autocomplete="off">

<div class="item1"> <img src="pic.png" height="75px" width="75px" alt=""></div>
<div class="item2">  <label for="username"></label><input type="text" name="username" id="username" placeholder="username/email" ></div>

<div class="item3">  <label for="pwd"></label><input type="password" name="pwd" id="pwd" placeholder="password"> </div>
<div class="item4"> <button type="submit" class="loginbtn">Login</button> </div>
<div class="item5">  <a href="register.php">register</a> </div>
<div class="item6">  message? </div>
</form>
</div>

<!-- 
<form action="/app/users/login.php" method="POST">


<div class="item1"> <label for="username">username</label></div>
<div class="item2">   <input type="text" name="username" id="username"></div>
<div class="item3"> <label for="pwd">password</label></div>
<div class="item4">  <input type="text" name="pwd" id="pwd"></div>
<div class="item5">  <button type="submit">Login</button></div>
<div class="item6">  <a href="register.php">register</a></div>
</form> -->



<!-- 
<form action="/app/users/login.php" method="POST">
    <label for="username">username</label>
    <input type="text" name="username" id="username">
    <label for="pwd">password</label>
    <input type="text" name="pwd" id="pwd">
    <button type="submit">Login</button>
</form>
<p><?php echo $_SESSION['error']?></p>

</div> -->

</section>
</main>

<?php require __DIR__ . ('/app/views/footer.php');