<?php require_once '../../includes/auth.php' ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowMedia | Carte intéractive</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
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
        <button id="locate_all" class="all-button">Voir toutes les activités</button>
        <div id="map"></div>

        <!-- Nouvelle section des recommandations -->
        <section class="recommendations-section">
            <div class="recommendations-container">
                <button class="nav-arrow nav-arrow-left">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="recommendations-slider">
                    <div class="recommendation-card">
                        <div class="card-image">
                            <img src="https://api.centrepompidou-metz.fr/assets/q70-w1200/b16448a2/architecture_c_jacqueline_trichard_21_centre_pompidou_metz_29072020_2147.jpg" alt="Centre Pompidou de Metz">
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">CENTRE POMPIDOU DE METZ</h3>
                            <p class="card-subtitle">Parvis des Droits de l'Homme, 57020 Metz</p>
                            <p class="card-distance">à 500m</p>
                            <a href="../activite/details.php?id=2"><button class="card-button">Voir plus</button></a>
                        </div>
                    </div>

                    <div class="recommendation-card">
                        <div class="card-image">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0WF4U6ppSCEyaYsI0I2n7_HH1vK141PP_dg&s" alt="Station Arts et Métiers">
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">STATION ARTS ET MÉTIERS</h3>
                            <p class="card-subtitle">Paris 3e</p>
                            <p class="card-distance">à 2km</p>
                            <a href="../activite/details.php?id=9"><button class="card-button">Voir plus</button></a>
                        </div>
                    </div>

                    <div class="recommendation-card">
                        <div class="card-image">
                            <img src="https://www.bordeaux-tourisme.com/sites/bordeaux_tourisme/files/medias/widgets/misc/La%20Cit%C3%A9%20du%20Vin%C2%A9Teddy%20Verneuil%20-%20%40lezbroz.jpg" alt="La Cité du Vin">
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">LA CITÉ DU VIN</h3>
                            <p class="card-subtitle">134 Quai de Bacalan, 33300 Bordeaux</p>
                            <p class="card-distance">à 5km</p>
                            <a href="../activite/details.php?id=14"><button class="card-button">Voir plus</button></a>
                        </div>
                    </div>
                </div>

                <button class="nav-arrow nav-arrow-right">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>
    </main>
    <?php include '../../components/newsletter.php' ?>

    <?php include '../../includes/layout/footer.php'; ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #3a791f;
            --secondary-color: #8ac571;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.2);
            --container-padding: clamp(1.25rem, 5vw, 5rem);
            --section-spacing: clamp(3rem, 8vh, 6rem);
        }

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
            cursor: button;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
            white-space: nowrap;
            margin-bottom: -15px;
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
            border-radius: 60px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 60px;
        }

        /* Style for the "Voir toutes les activités" button */
        .all-button {
            background: none;
            border: none;
            padding: 0;
            font: inherit;
            /* Inherit font styles from parent */
            cursor: pointer;
            color: #a259e6;
            /* Match the desired link color */
            text-decoration: none;
            /* No underline */
            margin-bottom: 30px;
            /* Keep some space below */
            text-align: center;
            display: block;
            /* Make it a block element to center */
            width: fit-content;
            /* Shrink to content width */
            margin-left: auto;
            /* Center the block element */
            margin-right: auto;
            /* Center the block element */
            transition: color 0.3s ease;
        }

        .all-button:hover {
            color: #7b42b6;
            /* Slightly darker color on hover */
        }

        /* Nouvelle section des recommandations */
        .recommendations-section {
            width: 100%;
            max-width: 1000px;
            margin-top: 40px;
        }

        .recommendations-container {
            position: relative;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .recommendations-slider {
            display: flex;
            gap: 30px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 20px 0;
            flex: 1;
        }

        .recommendations-slider::-webkit-scrollbar {
            display: none;
        }

        .recommendation-card {
            background-color: #E7E3D9;
            border-radius: 33px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-width: 280px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .recommendation-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .card-image {
            width: 100%;
            height: 180px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            padding: 25px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 8px;
            font-family: 'Poppins', sans-serif;
        }

        .card-subtitle {
            font-size: 14px;
            color: #666666;
            margin-bottom: 8px;
            font-family: 'Poppins', sans-serif;
            line-height: 1.4;
        }

        .card-distance {
            font-size: 14px;
            color: #3A791F;
            font-weight: 500;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
        }

        .card-button {
            background-color: #FF3131;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .card-button:hover {
            background-color: #e02828;
        }

        .nav-arrow {
            background-color: #f0f0f0;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            flex-shrink: 0;
        }

        .nav-arrow:hover {
            background-color: #e0e0e0;
        }

        .nav-arrow i {
            font-size: 18px;
            color: #666666;
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
            background-color: #3a791f;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: clamp(0.8rem, 2vw, 1rem);
        }

        .leaflet-popup-content a.btn:hover {
            background-color: rgb(56, 100, 37);
        }

        @media (max-width: 768px) {
            .recommendations-container {
                flex-direction: column;
            }

            .nav-arrow {
                display: none;
            }

            .recommendations-slider {
                width: 100%;
                justify-content: flex-start;
            }

            .recommendation-card {
                min-width: 250px;
            }
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

            .recommendation-card {
                min-width: 220px;
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

                    map.eachLayer(layer => {
                        if (layer instanceof L.Marker) {
                            map.removeLayer(layer);
                        }
                    });

                    data.forEach(point => {
                        const marker = L.marker([point.latitude, point.longitude]).addTo(map);
                        marker.bindPopup(`
                            <strong>${point.titre}</strong><br>
                            <strong>Type de lieu: </strong>${point.type_lieu}</br> 
                            <strong>Fait par: </strong>${point.architecte}</br>  
                            <strong>Adresse: </strong>${point.adresse}<br>
                            <a href="/pages/activite/details.php?id=${point.id}" class="btn">J'y vais</a>
                        `);
                    });

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

        document.getElementById('locate_all').addEventListener('click', () => {
            fetch('../../algorithme/localise.php?all=1')
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data.length === 0) {
                        alert("Aucune activité trouvée.");
                        return;
                    }

                    map.eachLayer(layer => {
                        if (layer instanceof L.Marker) {
                            map.removeLayer(layer);
                        }
                    });

                    data.forEach(point => {
                        const marker = L.marker([point.latitude, point.longitude]).addTo(map);
                        marker.bindPopup(`
                           <strong>${point.titre}</strong><br>
                            <strong>Type de lieu: </strong>${point.type_lieu}</br> 
                            <strong>Fait par: </strong>${point.architecte}</br>  
                            <strong>Adresse: </strong>${point.adresse}<br>
                            <a href="/pages/activite/details.php?id=${point.id}" class="btn">J'y vais</a>
                        `);
                    });

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

        // Navigation des recommandations
        document.querySelector('.nav-arrow-left').addEventListener('click', () => {
            const slider = document.querySelector('.recommendations-slider');
            slider.scrollBy({
                left: -300,
                behavior: 'smooth'
            });
        });

        document.querySelector('.nav-arrow-right').addEventListener('click', () => {
            const slider = document.querySelector('.recommendations-slider');
            slider.scrollBy({
                left: 300,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>