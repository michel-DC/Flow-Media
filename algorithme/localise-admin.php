<?php
header('Content-Type: application/json');

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (mysqli_connect_errno()) {
    echo json_encode(['error' => 'Erreur de connexion à la base de données']);
    exit();
}

$query = "SELECT a.*, 
          a.nom_lieu
          FROM all_activites a ";

$result = mysqli_query($link, $query);
$activities = [];

while ($row = mysqli_fetch_assoc($result)) {
    $activities[] = [
        'id' => $row['id'],
        'titre' => $row['titre'],
        'adresse' => $row['adresse'],
        'latitude' => $row['latitude'],
        'longitude' => $row['longitude'],
        'nom_lieu' => $row['nom_lieu']
    ];
}

echo json_encode($activities);
mysqli_close($link);
