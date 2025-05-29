<?php
require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$abonnement_id = 1;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query_user = "SELECT abonnement_id FROM users WHERE id = $user_id";
    $result_user = mysqli_query($link, $query_user);
    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $user = mysqli_fetch_assoc($result_user);
        $abonnement_id = $user['abonnement_id'];
    }
}

$query = "SELECT * FROM podcasts ORDER BY id DESC";
$result = mysqli_query($link, $query);


$num_podcasts = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Podcasts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #3a791f;
            --secondary-color: #8ac571;
            --text-color: #333;
            --light-bg: #e6e2d4;
            --white: #ffffff;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page-title {
            color: var(--primary-color);
            text-align: center;
            margin: 150px 0 30px;
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .events-container {
            max-width: 1200px;
            margin: 0 auto 80px;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            flex: 1;
        }

        .event-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            height: fit-content;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .event-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .event-content {
            padding: 20px;
        }

        .event-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .event-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .event-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .event-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .event-link:hover {
            color: var(--secondary-color);
        }

        .premium-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
            z-index: 10;
            border-radius: 15px;
        }

        .premium-overlay h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .premium-overlay p {
            margin-bottom: 20px;
        }

        .upgrade-button {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
        }

        .upgrade-button:hover {
            background-color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                background: var(--white);
                box-shadow: var(--shadow-sm);
            }

            .page-title {
                margin-top: 120px;
            }

            .events-container {
                margin-top: 20px;
            }

            .events-container {
                grid-template-columns: 1fr;
            }
        }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            font-size: clamp(3rem, 8vw, 8rem);
            opacity: 0.15;
            animation: float 20s linear infinite;
            color: var(--primary-color);
            filter: drop-shadow(0 0 10px rgba(58, 121, 31, 0.3));
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
            color: var(--primary-color);
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: -5s;
            color: var(--secondary-color);
        }

        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 15%;
            animation-delay: -10s;
            color: var(--primary-color);
        }

        .floating-element:nth-child(4) {
            bottom: 20%;
            right: 20%;
            animation-delay: -15s;
            color: var(--secondary-color);
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg) scale(1);
            }

            50% {
                transform: translate(30px, 30px) rotate(180deg) scale(1.1);
            }

            100% {
                transform: translate(0, 0) rotate(360deg) scale(1);
            }
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>

    <div class="floating-elements">
        <i class="fas fa-podcast floating-element"></i>
        <i class="fas fa-microphone floating-element"></i>
        <i class="fas fa-headphones floating-element"></i>
        <i class="fas fa-volume-up floating-element"></i>
    </div>

    <h1 class="page-title">
        <i class="fas fa-podcast"></i>
        Nos Podcasts
    </h1>

    <div class="events-container">
        <?php
        // Vérifie s'il y a des podcasts dans la base de données
        if ($num_podcasts > 0) {
            // Réinitialise le pointeur de résultat au début pour pouvoir parcourir les enregistrements
            mysqli_data_seek($result, 0);
            // Boucle à travers chaque enregistrement de podcast
            while ($podcast = mysqli_fetch_assoc($result)) {
        ?>
                <div class="event-card">
                    <?php if (!empty($podcast['image_url'])): ?>
                        <img src="../<?= htmlspecialchars($podcast['image_url']) ?>"
                            alt="<?= htmlspecialchars($podcast['titre']) ?>"
                            class="event-image">
                    <?php else: ?>
                        <div class="event-image" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color)); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
                            <i class="fas fa-podcast"></i>
                        </div>
                    <?php endif; ?>

                    <div class="event-content">
                        <h3 class="event-title"><?= htmlspecialchars($podcast['titre']) ?></h3>
                        <p class="event-description"><?= htmlspecialchars($podcast['description']) ?></p>

                        <div class="event-links">
                            <?php if (!empty($podcast['fichier_audio_url'])): ?>
                                <a href="<?= htmlspecialchars($podcast['fichier_audio_url']) ?>" class="event-link" target="_blank">
                                    <i class="fas fa-headphones"></i>
                                    <span>Écouter le podcast</span>
                                </a>
                                <audio controls>
                                    <source src="../<?= htmlspecialchars($podcast['fichier_audio_url']) ?>" type="audio/ogg">
                                    <source src="horse.mp3" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            <?php endif; ?>

                            <?php if (!empty($podcast['youtube_url'])): ?>
                                <a href="<?= htmlspecialchars($podcast['youtube_url']) ?>" class="event-link" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                    <span>Voir sur YouTube</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($abonnement_id <= 1): ?>
                        <div class="premium-overlay">
                            <h3>Contenu Premium</h3>
                            <p>Passez à un abonnement premium pour accéder à ce podcast</p>
                            <a href="../abonnement/index.php?user_id=<?php echo $user_id; ?>" class="upgrade-button">Mettre à niveau</a>
                        </div>
                    <?php endif; ?>
                </div>
        <?php
            }
        } else {
            echo "<div style='grid-column: 1 / -1; text-align: center; padding: 40px;'>";
            echo "<i class='fas fa-podcast' style='font-size: 3rem; color: #ccc; margin-bottom: 20px;'></i>";
            echo "<p>Aucun podcast disponible pour le moment.</p>";
            echo "</div>";
        }
        ?>
    </div>

    <?php include '../../includes/layout/footer.php' ?>
</body>

</html>