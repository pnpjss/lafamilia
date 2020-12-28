<?php
//login fungerar
require __DIR__ . ('/app/views/header.php');

require __DIR__ . ('/app/autoload.php');

require __DIR__ . ('/app/views/nav.php');

require __DIR__ . ('/main.php');

require __DIR__ . ('/app/views/footer.php');

die(var_dump($user));
