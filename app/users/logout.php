<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');
require __DIR__ . ('/../views/header.php');

unset($_SESSION['user']);

redirect('/../index.php');
