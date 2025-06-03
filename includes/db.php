
<?php
$host = 'localhost';
$db   = 'micheldjoumessi_flow-media';
$user = 'micheldjoumessi_flow-media';
$pass = 'michouflow';

try {
    // Création d'une nouvelle connexion PDO à la base de données MySQL
    // avec les paramètres d'hôte, nom de base, utilisateur et mot de passe
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

    // Configuration de PDO pour qu'il lance des exceptions en cas d'erreur
    // Cela permet une meilleure gestion des erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si la connexion échoue, on affiche le message d'erreur et on arrête le script
    die("Erreur de connexion : " . $e->getMessage());
}
?>