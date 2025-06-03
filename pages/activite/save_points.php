<?php
require_once '../../includes/auth.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['points']) || !isset($_POST['activite_id'])) {
    http_response_code(400);
    exit('Données manquantes');
}

$user_id = $_SESSION['user_id'];
$points = intval($_POST['points']);
$activite_id = intval($_POST['activite_id']);

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Vérifier si l'utilisateur a déjà des points pour cette activité
$check_query = "SELECT * FROM point_user WHERE user_id = $user_id AND activite_id = $activite_id";
$check_result = mysqli_query($link, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // Mettre à jour les points existants
    $query = "UPDATE point_user SET nombre_point = $points WHERE user_id = $user_id AND activite_id = $activite_id";
} else {
    // Insérer de nouveaux points
    $query = "INSERT INTO point_user (user_id, activite_id, nombre_point) VALUES ($user_id, $activite_id, $points)";
}

if (!mysqli_query($link, $query)) {
    http_response_code(500);
    exit('Erreur lors de l\'enregistrement des points');
}

http_response_code(200);
exit('Points enregistrés avec succès'); 