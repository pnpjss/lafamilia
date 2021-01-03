<?php

declare(strict_types=1);


if (!function_exists('redirect')) {
    function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}
};




function newMail($pdo , $newemail){
    
// kolla om email finns

};
    


