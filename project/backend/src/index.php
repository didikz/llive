<?php
require 'Controller/UserController.php';
require 'Service/UserService.php';
require 'Model/User.php';

// Example usage
$db = new mysqli('localhost', 'root', '', 'little_lives');
$userService = new UserService($db);
$userController = new UserController($db);

try {
    $user = $userController->getUser(1);
    print_r($user);
} catch (Exception $e) {
    echo $e->getMessage();
}
