<?php
require_once '../../includes/auth.php';

// Rediriger si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../connexion/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$user_query = "SELECT fullname FROM users WHERE id = $user_id";
$user_result = mysqli_query($link, $user_query);
$user = mysqli_fetch_assoc($user_result);
$user_fullname = $user['fullname'];

// Calculer le total des points de l'utilisateur
$points_query = "SELECT SUM(nombre_point) AS total_points FROM point_user WHERE user_id = $user_id";
$points_result = mysqli_query($link, $points_query);
$total_points = mysqli_fetch_assoc($points_result)['total_points'] ?? 0;

// Définir les badges avec leurs positions sur le parcours (en pourcentage de progression)
$badges = [
    25 => ['name' => 'Pro', 'image' => '../../assets/images/badges/triangle.svg', 'progress' => 33],
    50 => ['name' => 'Maître', 'image' => '../../assets/images/badges/medaille.svg', 'progress' => 66],
    100 => ['name' => 'Légende', 'image' => '../../assets/images/badges/bouclier.svg', 'progress' => 100],
];

// Calculer la progression actuelle de l'utilisateur (0-100%)
function calculateUserProgress($points)
{
    if ($points >= 100) return 100;
    return ($points / 100) * 100;
}

$user_progress = calculateUserProgress($total_points);

?>

<style>
    .content {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        position: relative;
    }

    .navbar {
        margin-bottom: 120px;
    }

    .container {
        max-width: 70%;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    h1 {
        font-size: 32px;
        color: #333;
        margin-bottom: 10px;
    }

    p {
        font-size: 18px;
        color: #555;
        margin-bottom: 30px;
    }

    /* Conteneur principal du parcours */
    .progress-path-container {
        position: relative;
        width: 100%;
        max-width: 100%;
        height: 700px;
        margin: 40px auto;
        padding: 40px;
        overflow: hidden;
    }

    /* SVG du parcours sinueux */
    .path-svg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .path-line {
        fill: none;
        stroke: #333;
        stroke-width: 4;
        stroke-dasharray: 15, 10;
        stroke-linecap: round;
    }

    /* Point de départ */
    .start-point {
        position: absolute;
        top: 60px;
        left: 80px;
        width: 20px;
        height: 20px;
        background: #333;
        border-radius: 50%;
        z-index: 3;
        transform: translate(-50%, -50%);
    }

    .start-label {
        position: absolute;
        top: 30px;
        left: 80px;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        transform: translateX(-50%);
        z-index: 3;
    }

    /* Badges sur le parcours */
    .badge-milestone {
        position: absolute;
        width: 80px;
        height: 80px;
        background: #e8e8e8;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 4;
        transform: translate(-50%, -50%) rotate(45deg);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .badge-milestone.achieved {
        background: #4CAF50;
        box-shadow: 0 4px 20px rgba(76, 175, 80, 0.4);
    }

    .badge-milestone img {
        width: 40px;
        height: 40px;
        transform: rotate(-45deg);
        filter: brightness(0.6);
    }

    .badge-milestone.achieved img {
        filter: brightness(1) drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    /* Position des badges */
    .badge-pro {
        top: 140px;
        right: 120px;
    }

    .badge-maitre {
        top: 280px;
        left: 100px;
    }

    .badge-legende {
        top: 420px;
        right: 100px;
    }

    /* Labels des badges */
    .badge-label {
        position: absolute;
        font-size: 12px;
        font-weight: 600;
        color: #333;
        text-align: center;
        z-index: 4;
        white-space: nowrap;
    }

    .badge-label.pro {
        top: 100px;
        right: 120px;
        transform: translateX(50%);
    }

    .badge-label.maitre {
        top: 320px;
        left: 100px;
        transform: translateX(-50%);
    }

    .badge-label.legende {
        top: 460px;
        right: 100px;
        transform: translateX(50%);
    }

    /* Marqueur de position du joueur */
    .player-marker {
        position: absolute;
        width: 30px;
        height: 30px;
        background: #FF3131;
        border: 4px solid #fff;
        border-radius: 50%;
        z-index: 5;
        transform: translate(-50%, -50%);
        box-shadow: 0 4px 15px rgba(255, 49, 49, 0.4);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 49, 49, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 49, 49, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 49, 49, 0);
        }
    }

    /* Styles pour les petits écrans */
    @media (max-width: 1200px) {
        .container {
            max-width: 85%;
        }
    }

    @media (max-width: 768px) {
        .container {
            max-width: 95%;
        }

        h1 {
            font-size: 24px;
        }

        p {
            font-size: 16px;
        }

        .progress-path-container {
            height: 600px;
            padding: 20px;
        }

        .badge-milestone {
            width: 60px;
            height: 60px;
        }

        .badge-milestone img {
            width: 30px;
            height: 30px;
        }

        .player-marker {
            width: 25px;
            height: 25px;
        }

        .badge-label {
            font-size: 10px;
        }
    }

    @media (max-width: 480px) {
        .container {
            max-width: 100%;
        }

        .progress-path-container {
            height: 500px;
            padding: 10px;
        }
    }

    /* Nouveau style pour le barème de points */
    .points-scale {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .scale-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 15px;
        text-align: center;
    }

    .scale-badge {
        width: 80px;
        height: 80px;
        margin-bottom: 10px;
    }

    .scale-name {
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    .scale-points {
        font-size: 12px;
        color: #FF3131;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .scale-item {
            margin: 10px;
        }

        .scale-badge {
            width: 60px;
            height: 60px;
        }

        .scale-name {
            font-size: 12px;
        }

        .scale-points {
            font-size: 11px;
        }
    }
</style>

<div class="content">
    <div class="navbar">
        <?php include '../../includes/layout/navbar.php' ?>
    </div>

    <div class="container">
        <p>Votre total de points : <span style="font-weight: bold;"><?php echo $total_points; ?></span></p>

        <div class="points-scale">
            <div class="scale-item">
                <img src="../../assets/images/quizz/loupe.svg" alt="triangle" class="scale-badge">
                <div class="scale-info">
                    <div class="scale-name">BADGE CURIEUX</div>
                    <div class="scale-points">1pt</div>
                </div>
            </div>

            <div class="scale-item">
                <img src="../../assets/images/quizz/boussole.svg" alt="triangle" class="scale-badge">
                <div class="scale-info">
                    <div class="scale-name">BADGE CURIEUX</div>
                    <div class="scale-points">3pts</div>
                </div>
            </div>

            <div class="scale-item">
                <img src="../../assets/images/badges/maison.svg" alt="triangle" class="scale-badge">
                <div class="scale-info">
                    <div class="scale-name">BADGE CURIEUX</div>
                    <div class="scale-points">5pts</div>
                </div>
            </div>
        </div>

        <!-- Parcours de progression -->
        <div class="progress-path-container">
            <!-- Chemin SVG sinueux -->
            <svg class="path-svg" viewBox="0 0 800 500">
                <path class="path-line" d="M 80,60 Q 200,80 350,140 Q 500,200 150,280 Q 300,360 650,420" />
            </svg>

            <!-- Point de départ -->
            <div class="start-point"></div>
            <div class="start-label">DÉPART</div>

            <!-- Badges -->
            <div class="badge-milestone badge-pro <?php echo $total_points >= 25 ? 'achieved' : ''; ?>">
                <img src="../../assets/images/badges/pro.svg" alt="Badge Pro">
            </div>
            <div class="badge-label pro">
                BADGE PRO<br>
                <span style="color: #FF3131;">25 points</span>
            </div>

            <div class="badge-milestone badge-maitre <?php echo $total_points >= 50 ? 'achieved' : ''; ?>">
                <img src="../../assets/images/badges/maitre.svg" alt="Badge Maître">
            </div>
            <div class="badge-label maitre">
                BADGE MAÎTRE<br>
                <span style="color: #FF3131;">50 points</span>
            </div>

            <div class="badge-milestone badge-legende <?php echo $total_points >= 100 ? 'achieved' : ''; ?>">
                <img src="../../assets/images/badges/legende.svg" alt="Badge Légende">
            </div>
            <div class="badge-label legende">
                BADGE LÉGENDE<br>
                <span style="color: #FF3131;">100 points</span>
            </div>

            <!-- Marqueur du joueur -->
            <div class="player-marker" id="playerMarker"></div>
        </div>

        <p style="margin-top: 40px;">Continuez à jouer pour gagner plus de badges !</p>
    </div>


    <script>
        // Fonction pour calculer la position du joueur sur le parcours
        function updatePlayerPosition() {
            const totalPoints = <?php echo $total_points; ?>;
            const maxPoints = 100;
            const progress = Math.min(totalPoints / maxPoints, 1);

            // Points clés du parcours (coordonnées approximatives)
            const pathPoints = [{
                    x: 80,
                    y: 60
                }, // Départ
                {
                    x: 200,
                    y: 80
                }, // Première courbe
                {
                    x: 350,
                    y: 140
                }, // Badge Pro (25 points)
                {
                    x: 500,
                    y: 200
                }, // Milieu
                {
                    x: 300,
                    y: 240
                }, // Descente
                {
                    x: 150,
                    y: 280
                }, // Badge Maître (50 points)
                {
                    x: 250,
                    y: 320
                }, // Remontée
                {
                    x: 400,
                    y: 360
                }, // Avant dernière courbe
                {
                    x: 650,
                    y: 420
                } // Badge Légende (100 points)
            ];

            // Calcul de la position en fonction du pourcentage de progression
            let targetPoint;
            if (progress === 0) {
                targetPoint = pathPoints[0];
            } else if (progress <= 0.25) {
                // Entre départ et badge Pro
                const localProgress = progress / 0.25;
                const startIdx = 0;
                const endIdx = 2;
                targetPoint = interpolatePoints(pathPoints[startIdx], pathPoints[endIdx], localProgress);
            } else if (progress <= 0.5) {
                // Entre badge Pro et badge Maître
                const localProgress = (progress - 0.25) / 0.25;
                const startIdx = 2;
                const endIdx = 5;
                targetPoint = interpolatePoints(pathPoints[startIdx], pathPoints[endIdx], localProgress);
            } else if (progress <= 1) {
                // Entre badge Maître et badge Légende
                const localProgress = (progress - 0.5) / 0.5;
                const startIdx = 5;
                const endIdx = 8;
                targetPoint = interpolatePoints(pathPoints[startIdx], pathPoints[endIdx], localProgress);
            }

            // Positionner le marqueur
            const marker = document.getElementById('playerMarker');
            marker.style.left = targetPoint.x + 'px';
            marker.style.top = targetPoint.y + 'px';
        }

        // Fonction d'interpolation entre deux points
        function interpolatePoints(start, end, progress) {
            return {
                x: start.x + (end.x - start.x) * progress,
                y: start.y + (end.y - start.y) * progress
            };
        }

        // Initialiser la position du joueur au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            updatePlayerPosition();
        });
    </script>

</div>