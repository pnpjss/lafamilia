<?php

declare(strict_types=1);

require __DIR__ . ('/../autoload.php');


if (isset($_POST['delete-id'])) {
    $comment = $_POST['delete-id'];
}
