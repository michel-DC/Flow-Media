<?php
function geocodeCity($city) {
    if (empty($city)) {
        return null;
    }

    $url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($city) . ",France&limit=1";
    
    $options = [
        "http" => [
            "header" => "User-Agent: SAE-MMI-App"
        ]
    ];
    
    $context = stream_context_create($options);
    
    try {
        $response = file_get_contents($url, false, $context);
        if ($response === false) {
            return null;
        }
        
        $data = json_decode($response, true);
        
        if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
            return [
                'latitude' => floatval($data[0]['lat']),
                'longitude' => floatval($data[0]['lon']),
                'raw_response' => json_encode($data[0]),
                'last_updated' => date('Y-m-d H:i:s')
            ];
        }
    } catch (Exception $e) {
        error_log("Geocoding error: " . $e->getMessage());
    }
    
    return null;
} 