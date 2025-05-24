<?php
require_once '../includes/db.php';

session_start();
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$queryUser = $pdo->prepare("SELECT latitude, longitude FROM users WHERE id = ?");
$queryUser->execute([$userId]);
$user = $queryUser->fetch();

if (!$user) {
    http_response_code(404);
    echo json_encode(['error' => 'Aucun user trouvé']);
    exit;
}

$userLat = $user['latitude'];
$userLon = $user['longitude'];

$query = $pdo->prepare("
    SELECT id, titre, date_activite, lieu, latitude, longitude
    FROM activites
    WHERE SQRT(
        POW(111.2 * (latitude - ?), 2) +
        POW(111.2 * (? - longitude) * COS(latitude / 57.3), 2)
    ) <= 30
");
$query->execute([$userLat, $userLon]);
$activities = $query->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($activities);
