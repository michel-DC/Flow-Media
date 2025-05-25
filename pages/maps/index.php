<?php require_once '../../includes/auth.php' ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowMedia | Carte intéractive</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>

<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <main class="map-container">
        <h1 class="map-title">Découvre les lieux près de chez toi ?</h1>
        <div class="button-container">
            <button id="locate" class="geo-button">
                Se géolocaliser <i class="fas fa-location-arrow"></i>
            </button>
            <div class="info-tooltip">
                <i class="fas fa-question-circle"></i>
                <span class="tooltip-text">Le système vous recommande des activités dans un rayon de 30km, en tenant compte de votre âge et de vos centres d'intérêt.</span>
            </div>
        </div>
        <div id="map"></div>
    </main>

    <?php include '../../includes/layout/footer.php'; ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .map-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: clamp(60px, 10vh, 120px) 20px 20px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 50px;
        }

        .map-title {
            text-align: center;
            color: #a259e6;
            font-size: clamp(1.2rem, 4vw, 2.7rem);
            font-weight: 800;
            margin-bottom: clamp(1rem, 3vh, 2.25rem);
            letter-spacing: -1px;
            padding: 0 15px;
        }

        .button-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            justify-content: center;
            padding: 0 15px;
        }

        .geo-button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: clamp(12px, 3vw, 20px) clamp(20px, 4vw, 40px);
            color: white;
            background-color: #3A791F;
            border: none;
            border-radius: 50px;
            font-size: clamp(1rem, 2.5vw, 1.5em);
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }

        .geo-button:hover {
            background-color: #388E3C;
        }

        .geo-button i {
            font-size: 1.2em;
        }

        #map {
            width: 100%;
            height: clamp(50vh, 70vh, 80vh);
            max-width: 1000px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .info-tooltip {
            position: relative;
            display: inline-block;
        }

        .info-tooltip i {
            font-size: clamp(20px, 4vw, 24px);
            color: #a259e6;
            cursor: help;
        }

        .tooltip-text {
            visibility: hidden;
            width: min(300px, 90vw);
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 10px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: clamp(0.8rem, 2vw, 1rem);
        }

        .info-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        .leaflet-popup-content {
            font-size: clamp(0.8rem, 2vw, 1rem);
        }

        .leaflet-popup-content a.btn {
            display: inline-block;
            margin-top: 8px;
            padding: clamp(4px, 2vw, 6px) clamp(8px, 2vw, 12px);
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: clamp(0.8rem, 2vw, 1rem);
        }

        .leaflet-popup-content a.btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 480px) {
            .button-container {
                flex-direction: column;
                gap: 10px;
            }

            .info-tooltip {
                align-self: flex-end;
                margin-right: 15px;
            }

            .tooltip-text {
                left: auto;
                right: 0;
                transform: none;
            }
        }
    </style>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([46.6031, 1.8883], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        document.getElementById('locate').addEventListener('click', () => {
            fetch('../../algorithme/localise.php')
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data.length === 0) {
                        alert("Aucune activité trouvée à moins de 30 km.");
                        return;
                    }

                    // Clear existing markers if any, before adding new ones
                    map.eachLayer(layer => {
                        if (layer instanceof L.Marker) {
                            map.removeLayer(layer);
                        }
                    });

                    data.forEach(point => {
                        const marker = L.marker([point.latitude, point.longitude]).addTo(map);
                        marker.bindPopup(`
                            <strong>${point.titre}</strong><br>
                            <strong>À: </strong>${point.lieu}</br> 
                            <strong>Le: </strong>${point.date_activite}<br>
                            <a href="/pages/reservation/index.php?activite_id=${point.id}" class="btn">Réserver</a>
                        `);
                    });

                    // Optional: Fit map bounds to the new markers
                    if (data.length > 0) {
                        const latLngs = data.map(point => [point.latitude, point.longitude]);
                        const bounds = L.latLngBounds(latLngs);
                        map.fitBounds(bounds);
                    }
                })
                .catch(error => {
                    alert("Erreur de chargement des activités !");
                    console.error(error);
                });
        });
    </script>
</body>

</html>