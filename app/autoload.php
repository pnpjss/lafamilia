<?php

declare(strict_types=1);

// Start the session engines.
session_start();

// Set the default timezone to coordinated universal time.
date_default_timezone_set('UTC');

// Set the default character encoding to UTF-8.
mb_internal_encoding('UTF-8');



require __DIR__ . '/functions.php';

// Fetch the global configuration array.
$config = require __DIR__ . '/config.php';

// Setup the database connection.
$pdo = new PDO($config['database_path']);
// $pdo = new PDO('sqlite:database/lafamilia.sqlite');


// this one is supposed to be in functions.php ??
function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}
