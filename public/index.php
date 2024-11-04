<?php
require_once 'Router.php';
require_once '../app/controllers/UsuarioController.php';
require_once '../app/controllers/VeiculoController.php';

$router = new Router();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h3>singup teste</h3>

    <form action="../config/database.php" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <input type="text" name="email" placeholder="E-mail">
        <input type="text" name="cpf" placeholder="CPF">
        <input type="text" name="cidade" placeholder="cidade">
        <button>signup</button>
    </form>

</body>
</html>