<?php
session_start();

// Vider toutes les variables de session
$_SESSION = [];

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header('Location: login-admin.php?message=deconnexion_admin');
exit();
?>
