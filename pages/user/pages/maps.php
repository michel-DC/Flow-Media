<?php

require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Position | Flow Media</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            padding: 80px 0;
        }

        .profile-section {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .profile-container {
            background-color: #ffffff;
            border-radius: 30px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .map-section {
            margin-bottom: 40px;
        }

        .map-title {
            font-size: 24px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 20px;
            text-align: center;
        }

        .map-description {
            font-size: 16px;
            color: #666666;
            margin-bottom: 30px;
            text-align: center;
        }

        #user-map {
            height: 400px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .map-placeholder {
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #F0F0F0;
            border-radius: 15px;
            color: #666666;
            font-style: italic;
            text-align: center;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .profile-section {
                padding: 0 20px;
            }

            .profile-container {
                padding: 30px;
                border-radius: 20px;
            }

            #user-map,
            .map-placeholder {
                height: 300px;
            }
        }
    </style>
</head>

<body>
    <section class="profile-section">
        <div class="profile-container">
            <div class="map-section">
                <h2 class="map-title">Ma Position</h2>
                <p class="map-description">Visualisez votre position actuelle sur la carte</p>

                <?php if (!empty($user['latitude']) && !empty($user['longitude'])): ?>
                    <div id="user-map"></div>
                <?php else: ?>
                    <div class="map-placeholder">
                        Aucune position enregistrée. Mettez à jour votre ville dans les paramètres pour voir votre position sur la carte.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        <?php if (!empty($user['latitude']) && !empty($user['longitude'])): ?>
            document.addEventListener('DOMContentLoaded', function() {
                const map = L.map('user-map').setView([<?php echo $user['latitude']; ?>, <?php echo $user['longitude']; ?>], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                L.marker([<?php echo $user['latitude']; ?>, <?php echo $user['longitude']; ?>])
                    .addTo(map)
                    .bindPopup('<?php echo htmlspecialchars($user['ville']); ?>')
                    .openPopup();
            });
        <?php endif; ?>
    </script>
</body>

</html>