<?php
header('Content-Type: application/json');

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (mysqli_connect_errno()) {
    echo json_encode(['error' => 'Erreur de connexion à la base de données']);
    exit();
}

$query = "SELECT a.*, 
          DATE_FORMAT(a.date_activite, '%d/%m/%Y %H:%i') as date_activite 
          FROM activites a 
          ORDER BY a.date_activite DESC";

$result = mysqli_query($link, $query);
$activities = [];

while ($row = mysqli_fetch_assoc($result)) {
    $activities[] = [
        'id' => $row['id'],
        'titre' => $row['titre'],
        'lieu' => $row['lieu'],
        'date_activite' => $row['date_activite'],
        'latitude' => $row['latitude'],
        'longitude' => $row['longitude']
    ];
}

echo json_encode($activities);
mysqli_close($link);
