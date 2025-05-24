<?php
require_once '../includes/auth.php';
$_SESSION['connecté'] = true;

// Connexion à la base de données
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Récupérer le nombre de développeurs
$query = "SELECT COUNT(*) as total FROM activites";
$result = mysqli_query($link, $query);
$total_activites = mysqli_fetch_assoc($result)['total'];

// Récupérer le nombre d'utilisateurs
$query2 = "SELECT COUNT(*) as total FROM users";
$result2 = mysqli_query($link, $query2);
$total_users = mysqli_fetch_assoc($result2)['total'];

// Récuperer le nombre de réservation
$query5 = "SELECT COUNT(*) as total FROM reservations";
$result5 = mysqli_query($link, $query5);
$total_reservations = mysqli_fetch_assoc($result5)['total'];

// Récuperer le nombre d'admin
$query6 = "SELECT COUNT(*) as total FROM admin";
$result6 = mysqli_query($link, $query6);
$total_admins = mysqli_fetch_assoc($result6)['total'];

// recuperer le nom du dev le plus réservé
// $query8 = "SELECT titre FROM activites ORDER BY nombre_reservation DESC LIMIT 1";
// $result8 = mysqli_query($link, $query8);
// $activite_plus_reserv = mysqli_fetch_assoc($result8)['fullname'];

// recuperer le nom de l'user qui à fait le plus de réservations
$query9 = "SELECT fullname FROM users ORDER BY nombre_reservation DESC LIMIT 1";
$result9 = mysqli_query($link, $query9);
$user_max_reserv = mysqli_fetch_assoc($result9)['fullname'];

// Récupérer l'évolution du nombre de développeurs par jour
// $query3 = "SELECT DATE(date_creation) as date, COUNT(*) as count FROM developpeurs GROUP BY DATE(date_creation)";
// $result3 = mysqli_query($link, $query3);
// $dev_evolution = [];
// while ($row = mysqli_fetch_assoc($result3)) {
//     $dev_evolution[] = $row;
// }

// // Récupérer l'évolution du nombre d'utilisateurs par jour
// $query4 = "SELECT DATE(date_creation) as date, COUNT(*) as count FROM users GROUP BY DATE(date_creation)";
// $result4 = mysqli_query($link, $query4);
// $user_evolution = [];
// while ($row = mysqli_fetch_assoc($result4)) {
//     $user_evolution[] = $row;
// }

// // Récupérer l'évolution du nombre de réservations par jour
// $query7 = "SELECT DATE(date_creation) as date, COUNT(*) as count FROM reservations GROUP BY DATE(date_creation)";
// $result7 = mysqli_query($link, $query7);
// $reservation_evolution = [];
// while ($row = mysqli_fetch_assoc($result7)) {
//     $reservation_evolution[] = $row;
// }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Flow Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../assets/icons/icon-test.svg" type="image/svg+xml">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #2ECC71;
            --secondary-color: #25a25a;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: var(--text-color);
        }

        .dashboard-container {
            width: 95%;
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .dashboard-header h1 {
            margin: 0;
            font-size: 36px;
            color: var(--text-color);
            font-weight: 700;
        }

        .dashboard-header h1 span {
            color: var(--primary-color);
            position: relative;
        }

        .dashboard-header h1 span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--primary-color);
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
            box-shadow: var(--shadow-md);
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 200px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .stat-number {
            font-size: 2.5rem;
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--text-color);
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
            box-shadow: var(--shadow-sm);
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
            .dashboard-container {
                width: 98%;
                padding: 10px;
                margin: 10px auto;
            }

            .dashboard-header {
                padding: 15px;
                margin-bottom: 20px;
            }

            .dashboard-header h1 {
                font-size: 28px;
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
    </style>
</head>

<body>
    <?php include '../includes/layout/sidebar.php'; ?>

    <div id="add-activity-section" style="display: none;"><?php include 'add_activity.php'; ?></div>
    <div id="supp-activity-section" style="display: none;"><?php include 'supp_activity.php'; ?></div>
    <div id="edit-activity-section" style="display: none;"><?php include 'edit_activity.php'; ?></div>
    <div id="see-activity-section" style="display: none;"><?php include 'activity.php'; ?></div>
    <div id="add-podcast-section" style="display: none;"><?php include 'add_podcast.php'; ?></div>
    <div id="supp-podcast-section" style="display: none;"><?php include 'supp_podcast.php'; ?></div>
    <div id="edit-podcast-section" style="display: none;"><?php include 'edit_podcast.php'; ?></div>
    <div id="see-podcast-section" style="display: none;"><?php include 'podcast.php'; ?></div>
    <div id="see-reserv-section" style="display: none;"><?php include 'reservation.php'; ?></div>
    <div id="see-user-section" style="display: none;"><?php include 'manage_user.php'; ?></div>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Tableau de Bord <span>Administrateur</span></h1>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number"><?= $total_activites ?></div>
                <div class="stat-label">Nombre total d'activité 👨‍💻</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $total_users ?></div>
                <div class="stat-label">Utilisateurs inscrits 👤</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $total_admins ?></div>
                <div class="stat-label">Nombre d'administrateurs ✏️</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $total_reservations ?></div>
                <div class="stat-label">Nombre total de reservations 🗓️</div>
            </div>
            <!-- <div class="stat-card">
            <div class="stat-number"><?= $activite_plus_reserv ?></div>
            <div class="stat-label">à été l'activité la plus réservé 👑</div>
        </div> -->
            <div class="stat-card">
                <div class="stat-number"><?= $user_max_reserv ?></div>
                <div class="stat-label">est l'utilisateur qui a le plus réservé 🏆</div>
            </div>
            <div class="stat-card chart-card">
                <canvas id="devEvolutionGraph"></canvas>
                <div class="stat-label">Évolution des activités 👨‍💻</div>
            </div>
            <div class="stat-card chart-card">
                <canvas id="userEvolutionGraph"></canvas>
                <div class="stat-label">Évolution des utilisateurs 👤</div>
            </div>
            <div class="stat-card chart-card">
                <canvas id="reservationEvolutionGraph"></canvas>
                <div class="stat-label">Évolution des réservations 🗓️</div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['erreur']) && $_GET['erreur'] === 'acces_interdit_admin') {
        echo "<div class='message error'>Vous devez être connecté en tant qu'utilisateur pour accéder à cette page, déconnectez-vous d'abord.</div>";
    }
    ?>

    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.dashboard-container, #add-activity-section, #supp-activity-section, #edit-activity-section, #see-activity-section, #add-podcast-section, #supp-podcast-section, #edit-podcast-section, #see-podcast-section, #see-reserv-section, #see-user-section')
                .forEach(section => section.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }

        // Navigation depuis sidebar         
        document.getElementById('add-activity-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('add-activity-section');
        });
        document.getElementById('supp-activity-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('supp-activity-section');
        });
        document.getElementById('edit-activity-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('edit-activity-section');
        });
        document.getElementById('see-activity-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('see-activity-section');
        });
        document.getElementById('add-podcast-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('add-podcast-section');
        });
        document.getElementById('supp-podcast-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('supp-podcast-section');
        });
        document.getElementById('edit-podcast-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('edit-podcast-section');
        });
        document.getElementById('see-podcast-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('see-podcast-section');
        });
        document.getElementById('see-reserv-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('see-reserv-section');
        });
        document.getElementById('manage-user-link').addEventListener('click', function(event) {
            event.preventDefault();
            showSection('see-user-section');
        });

        // Gestion de l'ancre dans l'URL
        window.addEventListener('DOMContentLoaded', function() {
            const anchor = window.location.hash;
            if (anchor && document.querySelector(anchor)) {
                showSection(anchor.substring(1));
            }
        });

        // Configuration des graphiques
        const createChart = (ctx, labels, data, color) => {
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Nombre',
                        data: data,
                        borderColor: color,
                        backgroundColor: color + '20',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: color,
                        pointBorderColor: '#fff',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 13
                            },
                            padding: 10,
                            cornerRadius: 4
                        }
                    }
                }
            });
        };

        // Données et création des graphiques
        // Ensure these variables are correctly populated by your PHP code
        // Currently, they are commented out in the PHP section
        // const devEvolutionData = <?php // json_encode($dev_evolution) 
                                    ?>;
        // const userEvolutionData = <?php // json_encode($user_evolution) 
                                        ?>;
        // const reservationEvolutionData = <?php // json_encode($reservation_evolution) 
                                            ?>;

        // Placeholder data if PHP variables are not available or commented out
        const devEvolutionData = []; // Replace with actual data from PHP
        const userEvolutionData = []; // Replace with actual data from PHP
        const reservationEvolutionData = []; // Replace with actual data from PHP

        const devLabels = devEvolutionData.map(data => data.date);
        const devCounts = devEvolutionData.map(data => data.count);

        const userLabels = userEvolutionData.map(data => data.date);
        const userCounts = userEvolutionData.map(data => data.count);

        const reservationLabels = reservationEvolutionData.map(data => data.date);
        const reservationCounts = reservationEvolutionData.map(data => data.count);

        // Check if canvas elements exist before getting context
        const devCanvas = document.getElementById('devEvolutionGraph');
        const userCanvas = document.getElementById('userEvolutionGraph');
        const reservationCanvas = document.getElementById('reservationEvolutionGraph');

        let devChart, userChart, reservationChart;

        if (devCanvas) {
            const devCtx = devCanvas.getContext('2d');
            devChart = createChart(devCtx, devLabels, devCounts, '#2ECC71');
        }

        if (userCanvas) {
            const userCtx = userCanvas.getContext('2d');
            userChart = createChart(userCtx, userLabels, userCounts, '#ff6e6e');
        }

        if (reservationCanvas) {
            const reservationCtx = reservationCanvas.getContext('2d');
            reservationChart = createChart(reservationCtx, reservationLabels, reservationCounts, '#6eff8a');
        }

        // Gestion du redimensionnement
        window.addEventListener('resize', function() {
            if (devChart) devChart.resize();
            if (userChart) userChart.resize();
            if (reservationChart) reservationChart.resize();
        });

        // Initial display based on hash or default
        // This call is handled by the DOMContentLoaded listener above now
        // showSection(window.location.hash ? window.location.hash.substring(1) : 'dashboard-container');
    </script>

</body>

</html>