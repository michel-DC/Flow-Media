<?php
require_once '../../includes/auth.php';

// Connexion à la base de données
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Initialiser l'abonnement_id par défaut
$abonnement_id = 1; // Abonnement gratuit par défaut

// Vérifier si l'utilisateur est connecté et récupérer son abonnement
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query_user = "SELECT abonnement_id FROM users WHERE id = $user_id";
    $result_user = mysqli_query($link, $query_user);
    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $user = mysqli_fetch_assoc($result_user);
        $abonnement_id = $user['abonnement_id'];
    }
}

// Récupérer tous les podcasts
$query = "SELECT * FROM podcasts ORDER BY id DESC";
$result = mysqli_query($link, $query);
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
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        body {
            height: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light-bg);
            padding-top: 80px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .podcast-component {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .podcast-component h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 45px;
            color: var(--primary-color);
            text-align: center;
            position: relative;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .podcast-component h1 i {
            font-size: 2rem;
        }

        .podcasts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            padding: 20px 0;
            position: relative;
            z-index: 2;
        }

        .podcast-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .podcast-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .podcast-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .podcast-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .podcast-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 10px;
        }

        .podcast-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 15px 0;
            flex: 1;
        }

        .podcast-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: auto;
        }

        .podcast-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .podcast-link:hover {
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
            transition: background-color 0.2s ease;
        }

        .upgrade-button:hover {
            background-color: var(--secondary-color);
        }

        .bottom-illustrations {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            pointer-events: none;
            z-index: 1;
        }

        .bottom-illustration {
            width: 300px;
            height: auto;
            opacity: 0.8;
            transition: transform 0.3s ease;
        }

        .bottom-illustration.left {
            margin-left: 20px;
        }

        .bottom-illustration.right {
            margin-right: 20px;
        }

        @media (max-width: 768px) {
            .podcast-component h1 {
                font-size: 2rem;
            }

            .podcast-card {
                padding: 15px;
            }

            .bottom-illustrations {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .bottom-illustration {
                width: 160px;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>

    <div class="podcast-component">
        <h1><i class="fas fa-podcast"></i> Nos Podcasts</h1>

        <div class="podcasts-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($podcast = mysqli_fetch_assoc($result)): ?>
                    <div class="podcast-card">
                        <img src="<?= htmlspecialchars($podcast['image_url']) ?>" alt="<?= htmlspecialchars($podcast['titre']) ?>" class="podcast-image">
                        <div class="podcast-content">
                            <h2 class="podcast-title"><?= htmlspecialchars($podcast['titre']) ?></h2>
                            <p class="podcast-description"><?= htmlspecialchars($podcast['description']) ?></p>

                            <div class="podcast-links">
                                <?php if (!empty($podcast['fichier_audio_url'])): ?>
                                    <a href="<?= htmlspecialchars($podcast['fichier_audio_url']) ?>" class="podcast-link" target="_blank">
                                        <i class="fas fa-headphones"></i>
                                        <span>Écouter le podcast</span>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($podcast['youtube_url'])): ?>
                                    <a href="<?= htmlspecialchars($podcast['youtube_url']) ?>" class="podcast-link" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                        <span>Voir sur YouTube</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ($abonnement_id == 1): ?>
                            <div class="premium-overlay">
                                <h3>Contenu Premium</h3>
                                <p>Passez à un abonnement premium pour accéder à tous nos podcasts</p>
                                <a href="../pages/abonnement/" class="upgrade-button">Mettre à niveau</a>
                            </div>
                        <?php endif; ?>
                    </div>
            <?php endwhile;
            } else {
                echo "<p style='text-align: center; width: 100%;'>Aucun podcast disponible pour le moment.</p>";
            }
            ?>
        </div>
    </div>

    <div class="bottom-illustrations">
        <img src="../../assets/images/svg/family-1-12.svg" alt="Family illustration" class="bottom-illustration left">
        <img src="../../assets/images/svg/adventure-95.svg" alt="Adventure illustration" class="bottom-illustration right">
    </div>

    <?php include '../../includes/layout/footer.php' ?>
</body>

</html>