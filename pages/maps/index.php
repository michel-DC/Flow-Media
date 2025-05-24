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
        <button id="locate" class="geo-button">
            Se géolocaliser <i class="fas fa-location-arrow"></i>
        </button>
        <div id="map"></div>
    </main>

    <?php include '../../includes/layout/footer.php'; ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
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
            padding: 120px 20px 20px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 50px;
        }

        .map-title {
            color: #853FD4;
            font-size: 3em;
            font-weight: bolder;
            margin-bottom: 50px;
            text-align: center;
        }

        .geo-button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 40px;
            color: white;
            background-color: #3A791F;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.5em;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
            margin-bottom: 30px;
        }

        .geo-button:hover {
            background-color: #388E3C;
        }

        .geo-button i {
            font-size: 1.2em;
        }

        #map {
            width: 100%;
            height: 80vh;
            max-width: 1000px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }


        .leaflet-popup-content a.btn {
            display: inline-block;
            margin-top: 8px;
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .leaflet-popup-content a.btn:hover {
            background-color: #0056b3;
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
                            ${point.lieu} - ${point.date_activite}<br>
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