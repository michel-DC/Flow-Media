<?php
$host = 'localhost';
$db   = 'micheldjoumessi_flow-media';
$user = 'micheldjoumessi_flow-media';
$pass = 'michouflow';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
// PDO (PHP Data Objects) est une extension PHP pour accéder aux bases de données de manière sécurisée et uniforme

?>e