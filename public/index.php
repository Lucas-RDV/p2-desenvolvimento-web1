<?php
require_once '../Router.php';
require_once '../controllers/UserController.php';
require_once '../controllers/VeicleController.php';

function isPage() {
    header("content-type:html");
    return true;
}

$router = new Router();

header("content-type:application/json; charset=UTF-8");

$router = new Router();
$userController = new UserController($pdo);
$veicleController = new VeicleController($pdo);

$router->add('GET', '/users', [$userController, 'list']);
$router->add('GET', '/users/{id}', [$userController, 'getById']);
$router->add('POST', '/users', [$userController, 'create']);
$router->add('DELETE', '/users/{id}', [$userController, 'delete']);
$router->add('PUT', '/users/{id}', [$userController, 'update']);

$router->add('GET', '/veicles', [$veicleController, 'list']);
$router->add('GET', '/veicles/sold', [$veicleController, 'listSold']);
$router->add('GET', '/veicles/notsold', [$veicleController, 'listNotSold']);
$router->add('GET', '/veicles/{id}', [$veicleController, 'getById']);
$router->add('POST', '/veicles', [$veicleController, 'create']);
$router->add('DELETE', '/veicles/{id}', [$veicleController, 'delete']);
$router->add('PUT', '/veicles/{id}', [$veicleController, 'update']);

$router->add('GET', '/', 'isPage');

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[1] . ($pathItems[2] ? "/" . $pathItems[2] : "");

if ($router->dispatch($requestedPath) != true) {
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarMarketPlace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">CarMarketPlace</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="signin.php">Sign Up</a></li>
        </ul>
    </nav>

    <div class="container my-5">
        <div class="row" id="car-container">
        </div>
    </div>
    <script src="js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
