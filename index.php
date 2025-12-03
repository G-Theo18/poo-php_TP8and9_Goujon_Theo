<?php
spl_autoload_register(static function (string $fqcn) {
    $path = __DIR__ . '/src/' . str_replace('\\', '/', $fqcn) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});


use App\Domain\User\User;
use App\Domain\Forum\Message;


$user = new User;
$user->name = 'Greg';

$forumMessage = new Message($user, 'J\'aime les pates.');

var_dump($forumMessage);
