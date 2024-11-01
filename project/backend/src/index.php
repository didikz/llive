<?php
ob_start();
require 'Controller/UserController.php';
require 'Service/UserService.php';
require 'Model/User.php';

// Example usage
$db = new mysqli('host.docker.internal', 'root', '', 'little_lives');
$userService = new UserService($db);
$userController = new UserController($db);

try {
    $request = $_SERVER['REQUEST_URI'];
    $uris = explode("/", $request);

    switch ($uris[2]) {
        case 'user':
            $user = $userController->getUser($uris[3]);
            // CORS headers
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($user);
            break;
        default:
            // CORS headers
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => "not found"]);
            break;
    }
} catch (Exception $e) {
    header("HTTP/1.1 422 Unprocessable Entity");
    // CORS headers
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => $e->getMessage()]);
}
