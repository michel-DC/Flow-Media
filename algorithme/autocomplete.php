<?php
if (!isset($_GET['q'])) exit;

$q = urlencode($_GET['q']);
$url = "https://nominatim.openstreetmap.org/search?country=France&format=json&limit=5&city=" . $q;

$options = [
    "http" => [
        "header" => "User-Agent: SAE-MMI-App"
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$data = json_decode($response, true);

$results = [];

if (!empty($data)) {
    foreach ($data as $item) {
        if (isset($item['display_name'])) {
            $results[] = $item['display_name'];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($results);
