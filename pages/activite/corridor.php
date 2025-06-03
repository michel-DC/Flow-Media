<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowMadia | Mini-jeux</title>
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

        /* Section mini-jeux */
        .minigames-section {
            max-width: 1200px;
            margin: 80px auto 0;
            margin-top: 80px;
            padding: 0 40px;
        }

        .hero-banner {
            background-image: url('https://media.licdn.com/dms/image/sync/v2/D4E27AQHJl0G_npYoeg/articleshare-shrink_800/articleshare-shrink_800/0/1729090846676?e=2147483647&v=beta&t=vS9Dk6e6sofgp8-wY7X0U1pKx3rMKm2HfXJADXadGTg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 300px;
            border-radius: 40px 40px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 40px 40px 0 0;
        }

        .hero-text {
            color: white;
            font-size: 28px;
            font-weight: 600;
            text-align: center;
            max-width: 600px;
            line-height: 1.3;
            position: relative;
            z-index: 2;
            padding: 0 20px;
            font-family: 'Poppins', sans-serif;
        }

        .content-section {
            background-color: white;
            padding: 60px 50px;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .content-wrapper {
            display: flex;
            align-items: center;
            gap: 60px;
            margin-bottom: 50px;
        }

        .text-content {
            flex: 1;
        }

        .description-text {
            font-size: 20px;
            color: #000000;
            line-height: 1.6;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            background-color: #F9F9F9;
            padding: 20px;
            border-radius: 10px;
        }

        .buttons-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
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
                padding: 0 20px;
            }

            .hero-banner {
                height: 250px;
                border-radius: 30px 30px 0 0;
            }

            .hero-text {
                font-size: 24px;
            }

            .content-section {
                padding: 40px 30px;
                border-radius: 0 0 30px 30px;
            }

            .content-wrapper {
                flex-direction: column;
                gap: 40px;
                text-align: center;
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
                height: 200px;
                border-radius: 20px 20px 0 0;
            }

            .hero-text {
                font-size: 20px;
            }

            .content-section {
                padding: 30px 20px;
                border-radius: 0 0 20px 20px;
            }

            .description-text {
                font-size: 16px;
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
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>
    <!-- Section mini-jeux -->
    <section class="minigames-section">
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
                <a href="#" class="btn btn-purple">Jouer dès maintenant</a>
                <a href="#" class="btn btn-red">Comment j'obtiens une récompense ?</a>
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
</body>

</html>