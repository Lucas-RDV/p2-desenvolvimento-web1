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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
          <a href="" class="brand-logo">CarMarketPlace</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="">Sass</a></li>
            <li><a href="">Components</a></li>
            <li><a href="">JavaScript</a></li>
          </ul>
        </div>
      </nav>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>