<?php
require_once '../Router.php';
require_once '../controllers/UserController.php';
require_once '../controllers/VeicleController.php';

$router = new Router();

header("content-type:application/json; charset=UTF-8");

$router = new Router();
$userController = new UserController($pdo);

$router->add('GET', '/users', [$userController, 'list']);
$router->add('GET', '/users/{id}', [$userController, 'getById']);
$router->add('POST', '/users', [$userController, 'create']);
$router->add('DELETE', '/users/{id}', [$userController, 'delete']);
$router->add('PUT', '/users/{id}', [$userController, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[1] . ($pathItems[2] ? "/" . $pathItems[2] : "");
echo $requestedPath;

$router->dispatch($requestedPath);