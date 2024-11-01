<?php
require 'Controller/UserController.php';
require 'Service/UserService.php';
require 'Model/User.php';

// Example usage
$db = new mysqli('127.0.0.1', 'root', '', 'little_lives');
$userService = new UserService($db);
$userController = new UserController($db);

try {
    $request = $_SERVER['REQUEST_URI'];
    // CORS headers
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
    $uris = explode("/", $request);

    switch ($uris[2]) {
        case 'user':
            $user = $userController->getUser($uris[3]);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($user);
            break;
        default:
            header('HTTP/1.1 404 Not Found');
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
