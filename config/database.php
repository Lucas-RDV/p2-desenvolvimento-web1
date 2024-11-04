<?php

$host = 'localhost';
$db='carros_marketplace';
$dbusername = 'root';
$dbpassword = '';

try {
    $pdo = new PDO ("mysql:host=$host;dbname=$db", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}