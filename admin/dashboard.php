<?php
require_once '../includes/auth.php';
$_SESSION['connecté'] = true;

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Récupérer le nombre d'activités
$query = "SELECT COUNT(*) as total FROM all_activites";
$result = mysqli_query($link, $query);
$total_activites = mysqli_fetch_assoc($result)['total'];

// Récuperer le nombre de réservation
$query5 = "SELECT COUNT(*) as total FROM reservations";
$result5 = mysqli_query($link, $query5);
$total_reservations = mysqli_fetch_assoc($result5)['total'];

// Récuperer le nombre de reservation ce mois 
$query_month = "SELECT COUNT(*) as total FROM reservations WHERE MONTH(date_reservation) = MONTH(CURRENT_DATE()) AND YEAR(date_reservation) = YEAR(CURRENT_DATE())";
$result_month = mysqli_query($link, $query_month);
$reservations_this_month = mysqli_fetch_assoc($result_month)['total'];

$query_ca = "SELECT SUM(a.prix * r.places) as chiffre_affaire 
             FROM activites a 
             JOIN reservations r ON a.id = r.activite_id";
$result_ca = mysqli_query($link, $query_ca);
$chiffre_affaire = mysqli_fetch_assoc($result_ca)['chiffre_affaire'];

$query_max_reserv = "SELECT a.titre, COUNT(r.id) as reservation_count 
                    FROM all_activites a 
                    JOIN reservations r ON a.id = r.activite_id 
                    GROUP BY a.id 
                    ORDER BY reservation_count DESC 
                    LIMIT 1";
$result_max_reserv = mysqli_query($link, $query_max_reserv);
$max_reserv = mysqli_fetch_assoc($result_max_reserv)['titre'] ?? 'Aucune réservation';

$query_lieu = "SELECT SUM(places) as total_places FROM reservations";
$result_lieu = mysqli_query($link, $query_lieu);
$lieu_max_reserv = mysqli_fetch_assoc($result_lieu)['total_places'] ?? 0;



// Récupérer le nombre d'utilisateurs
$query2 = "SELECT COUNT(*) as total FROM users";
$result2 = mysqli_query($link, $query2);
$total_users = mysqli_fetch_assoc($result2)['total'];

// recuperer le nom de l'user qui à fait le plus de réservations
$query9 = "SELECT fullname FROM users ORDER BY nombre_reservation DESC LIMIT 1";
$result9 = mysqli_query($link, $query9);
$user_max_reserv = mysqli_fetch_assoc($result9)['fullname'];

// Récuperer le nombre d'admin
$query6 = "SELECT COUNT(*) as total FROM admin";
$result6 = mysqli_query($link, $query6);
$total_admins = mysqli_fetch_assoc($result6)['total'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Flow Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../assets/icons/logo.png" type="image/svg+xml">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --soft-black: #1a1a1a;
            --white: #f9f9f9;
            --border: #e2e8f0;
            --background: #ffffff;
            --card-background: #ffffff;
            --hover: #f1f5f9;
            --muted: #64748b;
            --selected-background: #e0e0e0;
            --primary: #3a791f;
            --primary-hover: #4e8c2b;
            --secondary: #e53e3e;
            --secondary-hover: #c53030;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--background);
            color: var(--soft-black);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            min-height: 100vh;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background: var(--card-background);
            border-right: 1px solid var(--border);
            padding: 2rem;
            width: 280px;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            box-sizing: border-box;
        }

        .main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 280px;
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
        }

        .profile-header h2 {
            font-size: 1.25rem;
            margin: 0;
        }

        .profile-header p {
            font-size: 0.875rem;
            color: var(--muted);
            margin: 0;
        }

        .sidebar nav a {
            display: block;
            text-decoration: none;
            color: var(--soft-black);
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 6px;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
        }

        .sidebar nav a:hover {
            background-color: var(--hover);
            color: var(--soft-black);
        }

        .logout-link {
            display: block;
            text-decoration: none;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 6px;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            margin-top: 20px;
        }

        .logout-link:hover {
            background-color: #721c24;
            color: var(--white);
            border-color: #721c24;
        }

        .dashboard-container {
            background: var(--card-background);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 35px;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .dashboard-header h1 {
            margin: 0;
            font-size: 36px;
            color: var(--soft-black);
            font-weight: 700;
        }

        .dashboard-header h1 span {
            color: var(--primary);
            position: relative;
        }

        .dashboard-header h1 span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--primary);
            border-radius: 3px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 200px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .stat-number {
            font-size: 2.5rem;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--soft-black);
            font-weight: 500;
        }

        .chart-card {
            position: relative;
            padding-top: 30px;
            min-height: 350px;
        }

        .message {
            padding: 12px;
            border-radius: 4px;
            margin: 10px auto;
            text-align: center;
            width: 90%;
            max-width: 500px;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            animation: fadeOut 5s forwards;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }

        canvas {
            width: 100% !important;
            height: 250px !important;
            max-height: 300px;
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--border);
                padding: 1rem;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .profile-header {
                flex-direction: row;
                text-align: left;
                align-items: center;
            }

            .profile-avatar {
                width: 60px;
                height: 60px;
            }

            .sidebar nav {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .sidebar nav a {
                flex-grow: 1;
                text-align: center;
                padding: 0.5rem;
            }

            .dashboard-container {
                padding: 1.5rem;
            }

            .stats-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .stat-card {
                padding: 15px;
                min-height: 140px;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-label {
                font-size: 1rem;
            }

            .chart-card {
                min-height: 250px;
            }
        }

        .map-container {
            margin-top: 2rem;
            padding: 1.5rem;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .map-container h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--soft-black);
        }

        .map-container h2 span {
            color: var(--primary);
            position: relative;
        }

        .map-container h2 span::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        #map {
            width: 100%;
            height: 500px;
            border-radius: 8px;
            overflow: hidden;
        }

        .leaflet-popup-content {
            font-size: 0.9rem;
        }

        .leaflet-popup-content a.btn {
            display: inline-block;
            margin-top: 8px;
            padding: 6px 12px;
            background-color: var(--primary);
            color: var(--white);
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: background-color 0.2s;
        }

        .leaflet-popup-content a.btn:hover {
            background-color: var(--primary-hover);
        }
    </style>
</head>

<body>

    <div class="dashboard">
        <aside class="sidebar">
            <div class="profile-header">
                <div class="profile-avatar" style="background-color: var(--border); display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 2rem;">👤</span>
                </div>
                <div>
                    <h2>Administrateur</h2>
                    <p style="color: #155724;">Flowmedia</p>
                </div>
            </div>

            <nav>
                <a href="#dashboard">Dashboard</a>
                <a href="#add-activity-section">Ajouter une activité</a>
                <a href="#supp-activity-section">Supprimer une activité</a>
                <a href="#edit-activity-section">Modifier une activité</a>
                <a href="#add-fun-fact-section">Ajouter un fun fact</a>
                <a href="#add-podcast-section">Ajouter un podcast</a>
                <a href="#supp-podcast-section">Supprimer un podcast</a>
                <a href="#edit-podcast-section">Modifier un podcast</a>
                <a href="#see-activity-section">Voir toutes les activités</a>
                <a href="#see-podcast-section">Voir tous les podcasts</a>
                <a href="#see-reserv-section">Voir toutes les réservations</a>
                <a href="#see-user-section">Gérer Utilisateurs</a>
            </nav>
            <a href="../connexion/logout-admin.php" class="logout-link">Se déconnecter 🔌</a>
        </aside>

        <main class="main-content">
            <div id="add-activity-section" style="display: none;"><?php include 'add_activity.php'; ?></div>
            <div id="supp-activity-section" style="display: none;"><?php include 'supp_activity.php'; ?></div>
            <div id="edit-activity-section" style="display: none;"><?php include 'edit_activity.php'; ?></div>
            <div id="add-fun-fact-section" style="display: none;"><?php include 'add_fun_fact.php'; ?></div>
            <div id="see-activity-section" style="display: none;"><?php include 'activity.php'; ?></div>
            <div id="add-podcast-section" style="display: none;"><?php include 'add_podcast.php'; ?></div>
            <div id="supp-podcast-section" style="display: none;"><?php include 'supp_podcast.php'; ?></div>
            <div id="edit-podcast-section" style="display: none;"><?php include 'edit_podcast.php'; ?></div>
            <div id="see-podcast-section" style="display: none;"><?php include 'podcast.php'; ?></div>
            <div id="see-reserv-section" style="display: none;"><?php include 'reservation.php'; ?></div>
            <div id="see-user-section" style="display: none;"><?php include 'user.php'; ?></div>


            <div class="dashboard-container" id="dashboard">
                <div class="dashboard-header">
                    <h1>Tableau de Bord <span>Administrateur</span></h1>
                </div>

                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-number"><?= $total_activites ?></div>
                        <div class="stat-label">Nombre total d'activités disponinble 🎯</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $total_reservations ?></div>
                        <div class="stat-label">Nombre total de réservations 🗓️</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $reservations_this_month ?></div>
                        <div class="stat-label">Réservations ce mois 📅</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $chiffre_affaire ?>€</div>
                        <div class="stat-label">Chiffre d'affaire total 💰</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $total_users ?></div>
                        <div class="stat-label">Utilisateurs inscrits 👥</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $max_reserv ?></div>
                        <div class="stat-label">Activité la plus réservée 🏆</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $user_max_reserv ?></div>
                        <div class="stat-label">Top réservateur 👑</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $lieu_max_reserv ?></div>
                        <div class="stat-label">Places réservées 🪑</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $total_admins ?></div>
                        <div class="stat-label">Administrateurs 🔐</div>
                    </div>
                </div>

                <div class="map-container">
                    <h2>Carte des <span>Activités</span></h2>
                    <div id="map"></div>
                </div>
            </div>

            <?php
            if (isset($_GET['erreur']) && $_GET['erreur'] === 'acces_interdit_admin') {
                echo "<div class='message error'>Vous devez être connecté en tant qu'utilisateur pour accéder à cette page, déconnectez-vous d'abord.</div>";
            }
            ?>

            <script>
                function showSection(sectionId) {
                    document.querySelectorAll('.dashboard-container, #add-activity-section, #supp-activity-section, #edit-activity-section, #add-fun-fact-section, #see-activity-section, #add-podcast-section, #supp-podcast-section, #edit-podcast-section, #see-podcast-section, #see-reserv-section, #see-user-section, #logout-admin-section')
                        .forEach(section => section.style.display = 'none');
                    document.getElementById(sectionId).style.display = 'block';
                }

                document.querySelectorAll('.sidebar nav a').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();
                        const targetId = this.getAttribute('href').substring(1);
                        showSection(targetId);
                    });
                });
            </script>
        </main>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([46.6031, 1.8883], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        fetch('../algorithme/localise-admin.php')
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data.length === 0) {
                    console.log("Aucune activité trouvée.");
                    return;
                }

                data.forEach(point => {
                    const marker = L.marker([point.latitude, point.longitude]).addTo(map);
                    marker.bindPopup(`
                        <strong>${point.titre}</strong><br>
                        <strong>Lieu: </strong>${point.nom_lieu}</br> 
                        <strong>Adresse: </strong>${point.adresse}<br>
                        <a href="edit_activity.php?id=${point.id}" class="btn">Modifier</a>
                    `);
                });

                if (data.length > 0) {
                    const latLngs = data.map(point => [point.latitude, point.longitude]);
                    const bounds = L.latLngBounds(latLngs);
                    map.fitBounds(bounds);
                }
            })
            .catch(error => {
                console.error("Erreur de chargement des activités:", error);
            });
    </script>
</body>

</html>