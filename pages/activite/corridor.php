<?php
require_once '../../includes/auth.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$query = "SELECT * FROM activites WHERE id = " . $_GET['id'];
$result = mysqli_query($link, $query);
$activity = mysqli_fetch_assoc($result);

if (!$activity) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Mini-jeux</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
    <style>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            padding: 0;
            margin: 0;
        }

        .navbar {
            margin-bottom: 120px;
        }

        /* Section mini-jeux */
        .minigames-section {
            width: 100%;
            margin: 80px 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .minigames-card {
            background-color: var(--white);
            padding: 0;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            max-width: 1200px;
            width: 90%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .hero-banner {
            background-image: url('https://c.wallhere.com/photos/26/c6/3840x2160_px_Aerial_View_Labyrinth_Maze-1341609.jpg!d');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 300px;
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .hero-text {
            position: relative;
            z-index: 2;
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            max-width: 80%;
            margin: 0 auto;
            line-height: 1.2;
            font-family: 'Poppins', sans-serif;
        }

        .content-section {
            background-color: transparent;
            padding: 40px var(--container-padding);
            border-radius: 0;
            box-shadow: none;
        }

        .content-wrapper {
            max-width: 100%;
            margin: 0 auto 40px;
            display: flex;
            align-items: center;
            gap: 60px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .text-content {
            flex: 1;
            min-width: 200px;
            position: relative;
            background-color: #F9F9F9;
            padding: 20px;
            border-radius: 10px;
            margin-right: 25px;
        }

        .text-content::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -20px;
            transform: translateY(-50%) rotate(45deg);
            width: 20px;
            height: 20px;
            background-color: #F9F9F9;
            box-shadow: 3px -3px 5px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .description-text {
            font-size: 1rem;
            color: #000000;
            line-height: 1.6;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            background-color: transparent;
            padding: 0;
            text-align: left;
        }

        .content-wrapper img {
            width: 200px;
            height: auto;
        }

        .buttons-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .btn {
            padding: 18px 35px;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            min-width: 250px;
        }

        .btn-purple {
            background-color: #9C4DF4;
            color: white;
        }

        .btn-purple:hover {
            background-color: rgb(123, 72, 145);
            transform: translateY(-2px);
        }

        .btn-red {
            background-color: #FF3131;
            color: white;
        }

        .btn-red:hover {
            background-color: rgb(195, 54, 54);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .minigames-section {
                padding: 0;
                margin-top: 80px;
            }

            .minigames-card {
                padding: 0;
                width: 95%;
            }

            .hero-banner {
                height: 200px;
                padding: 15px;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }

            .hero-banner::before {
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }

            .hero-text {
                font-size: 1.5rem;
            }

            .content-section {
                padding: 30px 20px;
            }

            .content-wrapper {
                flex-direction: column;
                gap: 30px;
                text-align: center;
                align-items: center;
            }

            .text-content {
                margin-right: 0;
                margin-bottom: 20px;
                min-width: unset;
                text-align: center;
            }

            .text-content::after {
                content: none;
            }

            .buttons-container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .btn {
                min-width: 200px;
            }
        }

        @media (max-width: 480px) {
            .hero-banner {
                height: 150px;
                padding: 10px;
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }

            .hero-banner::before {
                border-top-left-radius: 20px;
                border-top-right-radius: 20px;
            }

            .hero-text {
                font-size: 1.2rem;
            }

            .content-section {
                padding: 20px 15px;
            }

            .description-text {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 14px;
                padding: 15px 25px;
                min-width: 180px;
            }
        }

        .newsletter-section {
            background-color: #d4c8b8;
            padding: clamp(1.5rem, 3vh, 2.5rem) 0;
            text-align: center;
            margin-top: 60px;
        }

        .newsletter-container {
            max-width: clamp(300px, 50vw, 800px);
            margin: 0 auto;
            padding: 0 clamp(1rem, 2vw, 1.25rem);
        }

        .newsletter-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: clamp(1rem, 2vw, 1.875rem);
            flex-wrap: wrap;
        }

        .newsletter-title {
            font-size: clamp(1.25rem, 2vw, 1.8rem);
            font-weight: 600;
            color: #444;
        }

        .newsletter-form {
            display: flex;
            align-items: center;
            background-color: var(--white);
            border-radius: 1.875rem;
            padding: 0.5rem;
            box-shadow: var(--shadow-sm);
            width: 100%;
            max-width: clamp(250px, 40vw, 400px);
        }

        .newsletter-input {
            flex-grow: 1;
            border: none;
            outline: none;
            padding: clamp(0.5rem, 1vw, 0.625rem) clamp(1rem, 2vw, 1.25rem);
            font-size: clamp(0.875rem, 1.2vw, 1rem);
            border-radius: 1.875rem 0 0 1.875rem;
        }

        .newsletter-input::placeholder {
            color: #aaa;
        }

        .newsletter-button {
            background-color: #ff5757;
            border: none;
            border-radius: 50%;
            width: clamp(2rem, 3vw, 2.5rem);
            height: clamp(2rem, 3vw, 2.5rem);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .newsletter-button i {
            color: var(--white);
            font-size: clamp(0.875rem, 1.2vw, 1.2rem);
            transform: translateX(1px);
        }

        .newsletter-button:hover {
            background-color: #e04a4a;
        }

        footer {
            margin-top: 0;
        }

        .reward-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reward-popup-content {
            background: #fff;
            padding: 40px 30px 30px 30px;
            border-radius: 18px;
            max-width: 98vw;
            width: 600px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.18);
            position: relative;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .reward-popup-close {
            position: absolute;
            top: 12px;
            right: 18px;
            font-size: 2rem;
            color: #333;
            cursor: pointer;
            font-weight: bold;
        }

        .reward-popup-content h2 {
            margin-bottom: 18px;
            font-size: 1.4rem;
            color: #3a791f;
        }

        .reward-popup-content p {
            font-size: 1rem;
            color: #222;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <?php include '../../includes/layout/navbar.php' ?>
    </div>
    <!-- Section mini-jeux -->
    <section class="minigames-section">
        <div class="minigames-card">
            <!-- Bannière hero avec image de fond -->
            <div class="hero-banner">
                <h2 class="hero-text">
                    Gagne des activités gratuites en accumulant des badges grâce aux mini-jeux.
                </h2>
            </div>

            <!-- Section de contenu -->
            <div class="content-section">
                <div class="content-wrapper">
                    <div class="text-content">
                        <p class="description-text">
                            Pour gagner des badges et des récompenses, il faut gagner le mini jeux après avoir visité attentivement le Palais Idéal du Facteur Cheval !
                        </p>
                    </div>

                    <img src="../../assets/images/corridor/vert.svg" alt="Illustration" style="width: 200px; height: auto;">
                </div>

                <div class="buttons-container">
                    <a href="quizz.php?id=<?php echo $activity['id']; ?>" class="btn btn-purple">Jouer dès maintenant</a>
                    <a href="quizz.php" class="btn btn-red">Comment j'obtiens une récompense ?</a>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter-section">
        <div class="newsletter-container">
            <div class="newsletter-content">
                <div class="newsletter-title">Newsletter</div>
                <form method="POST" action="" class="newsletter-form">
                    <input type="email" name="newsletter_email" class="newsletter-input" placeholder="Ton e-mail" required>
                    <button type="submit" name="newsletter_submit" class="newsletter-button">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
    <?php include '../../includes/layout/footer.php' ?>

    <div id="reward-popup" class="reward-popup-overlay" style="display:none;">
        <div class="reward-popup-content">
            <span class="reward-popup-close" onclick="closeRewardPopup()">&times;</span>
            <h2>Comment obtenir une récompense ?</h2>
            <p>
                Pour obtenir une récompense, il te suffit de participer aux mini-jeux après avoir visité le lieu.
                Scanne le QR code sur place, réponds correctement aux questions, et accumule des badges.
                Plus tu as de badges, plus tu as de chances de gagner des activités gratuites !
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.btn-red').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('reward-popup').style.display = 'flex';
            });
        });

        function closeRewardPopup() {
            document.getElementById('reward-popup').style.display = 'none';
        }
    </script>
</body>

</html>