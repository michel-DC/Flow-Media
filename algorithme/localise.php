<?php
require_once '../includes/db.php';
session_start();

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Récupération des infos utilisateur (position + âge)
$queryUser = $pdo->prepare("SELECT latitude, longitude, age FROM users WHERE id = ?");
$queryUser->execute([$userId]);
$user = $queryUser->fetch();

if (!$user) {
    http_response_code(404);
    echo json_encode(['error' => 'Utilisateur non trouvé']);
    exit;
}

$userLat = $user['latitude'];
$userLon = $user['longitude'];
$userAge = $user['age'];

// Récupération des centres d'intérêt de l'utilisateur
$queryInterets = $pdo->prepare("SELECT interet_id FROM user_interet WHERE user_id = ?");
$queryInterets->execute([$userId]);
$interetIds = $queryInterets->fetchAll(PDO::FETCH_COLUMN);

if (empty($interetIds)) {
    // Aucun centre d'intérêt => retourner uniquement les résultats géographiques + âge
    $interetFilter = "";
} else {
    // Génération de placeholders pour les intérêts
    $placeholders = implode(',', array_fill(0, count($interetIds), '?'));
    $interetFilter = "
        AND a.id IN (
            SELECT activite_id
            FROM activites_interet
            WHERE interet_id IN ($placeholders)
        )
    ";
}

// Construction de la requête
$sql = "
    SELECT a.id, a.titre, a.adresse, a.type_lieu, a.architecte, a.latitude, a.longitude
    FROM all_activites a
    WHERE
        SQRT(
            POW(111.2 * (a.latitude - ?), 2) +
            POW(111.2 * (? - a.longitude) * COS(a.latitude / 57.3), 2)
        ) <= 30
        AND ? BETWEEN a.age_min AND a.age_max
        $interetFilter
";

// Fusion des paramètres (coordonnées + âge + intérêts si présents)
$params = [$userLat, $userLon, $userAge];
if (!empty($interetIds)) {
    $params = array_merge($params, $interetIds);
}

$query = $pdo->prepare($sql);
$query->execute($params);
$activities = $query->fetchAll(PDO::FETCH_ASSOC);

// Endpoint pour récupérer toutes les activités
if (isset($_GET['all'])) {
    $queryAll = $pdo->prepare("SELECT id, titre, adresse, type_lieu, architecte, latitude, longitude FROM all_activites");
    $queryAll->execute();
    $allActivities = $queryAll->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($allActivities);
    exit;
}

// Retour JSON pour la géolocalisation
header('Content-Type: application/json');
echo json_encode($activities);
