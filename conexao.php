<?php
$host = "localhost";
$db   = "marmitaria";
$user = "marmitaria";
$pass = "1707";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}


