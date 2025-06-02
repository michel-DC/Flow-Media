<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jsp en vrai</title>
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

        }

        /* Section principale */
        .main-section {
            max-width: 1400px;
            margin: 0 auto;
            margin-top: 120px;
            margin-bottom: 80px;
            padding: 0 20px;
        }

        .top-content {
            display: flex;
            gap: 80px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .palace-image {
            width: 520px;
            height: 380px;
            border-radius: 80px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .title-and-buttons {
            flex: 1;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .title {
            font-size: 42px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 50px;
            line-height: 1.2;
            font-family: 'Poppins', sans-serif;
            text-align: left;
        }

        .place-info {
            margin-bottom: 40px;
        }

        .info-item {
            display: flex;
            margin-bottom: 12px;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
        }

        .info-label {
            font-weight: 600;
            color: #333333;
            min-width: 140px;
        }

        .info-value {
            color: #000000;
            font-weight: 400;
        }

        .buttons-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: flex-start;
            width: 100%;
        }

        .description {
            color: #000000;
            font-size: 20px;
            line-height: 1.6;
            margin-bottom: 12px;
            font-weight: 400;
            font-family: 'Poppins', sans-serif;
            max-width: 520px;
        }

        .voir-plus {
            color: rgb(18, 17, 17);
            text-decoration: underline;
            font-size: 20px;
            font-weight: 400;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            display: none;
        }

        .btn {
            padding: 22px 55px;
            border: none;
            border-radius: 70px;
            font-size: 20px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            min-width: 400px;
            width: 400px;
        }

        .btn-green {
            background-color: #3A791F;
            color: white;
        }

        .btn-green:hover {
            background-color: #2d5f18;
        }

        .btn-red {
            background-color: #FF3131;
            color: white;
        }

        .btn-red:hover {
            background-color: #e02828;
        }

        /* Section des cartes */
        /* Section des cartes */
        .cards-section {
            width: 95%;
            margin: 0 auto;
            padding: 0 20px;
        }

        .cards-container {
            background-color: #F0F0F0;
            border-radius: 40px;
            padding: 60px 40px;
            display: flex;
            justify-content: center;
            gap: 40px;
            width: 100%;
        }

        .card {
            background-color: #C4BAA1;
            border-radius: 20px;
            padding: 30px;
            width: 300px;
            height: 180px;
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            z-index: 5;
        }

        .card-content {
            position: relative;
            z-index: 3;
            flex: 1;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #000000;
            font-family: 'Poppins', sans-serif;
            line-height: 1.2;
            max-width: 140px;
            position: relative;
            z-index: 3;
        }

        .card-blur {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(to top, rgba(196, 186, 161, 0.8), transparent);
            backdrop-filter: blur(3px);
            z-index: 2;
        }

        .card-image {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 90px;
            height: 90px;
            object-fit: contain;
            z-index: 1;
        }

        /* Point d'interrogation vert */
        .question-mark {
            position: absolute;
            bottom: 15px;
            right: 15px;
            width: 30px;
            height: 30px;
            background-color: #3A791F;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            z-index: 4;
        }

        .tooltip-text {
            visibility: hidden;
            width: min(300px, 90vw);
            background-color: #3A791F;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 10px;
            position: absolute;
            z-index: 100;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: clamp(0.8rem, 2vw, 1rem);
            margin-bottom: -5px;
        }

        /* Show tooltip on hover of the parent element */
        .question-mark:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Section des avis */
        .reviews-section {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            margin-top: 80px;
            margin-bottom: 80px;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 80px;
            font-family: 'Poppins', sans-serif;
        }

        .petit-pas {
            color: #FF3131;
        }

        .reviews-container {
            display: flex;
            justify-content: space-between;
            gap: 60px;
        }

        .review-card {
            background-color: #ffffff;
            border-radius: 33px;
            padding: 50px 40px;
            flex: 1;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .reviewer-name {
            font-size: 24px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
        }

        .stars-container {
            margin-bottom: 25px;
            display: flex;
            gap: 5px;
        }

        .star {
            font-size: 24px;
            color: #FFD700;
        }

        .star.empty {
            color: #E0E0E0;
        }

        .review-text {
            font-size: 18px;
            line-height: 1.6;
            color: #000000;
            font-weight: 400;
            font-family: 'Poppins', sans-serif;
        }

        /* Section commentaire */
        .feedback-section {
            max-width: 1000px;
            margin: 80px auto;
            padding: 0 40px;
        }

        .feedback-container {
            background-color: #e0e0e0;
            border-radius: 30px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .feedback-input {
            width: 100%;
            height: 120px;
            padding: 20px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            resize: none;
            outline: none;
        }

        .submit-button {
            align-self: flex-end;
            padding: 15px 40px;
            background-color: #3A791F;
            color: white;
            border: none;
            border-radius: 70px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #2d5f18;
        }

        .newsletter-section {
            background-color: #d4c8b8;
            padding: clamp(1.5rem, 3vh, 2.5rem) 0;
            text-align: center;
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

        @media (max-width: 600px) {
            .newsletter-content {
                flex-direction: column;
                gap: 20px;
            }

            .newsletter-form {
                max-width: 300px;
            }

            .newsletter-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 1200px) {
            .main-section {
                padding: 0 15px;
            }

            .top-content {
                gap: 40px;
            }

            .palace-image {
                width: 450px;
                height: 330px;
            }

            .title {
                font-size: 36px;
            }

            .btn {
                min-width: 350px;
                width: 350px;
            }
        }

        @media (max-width: 992px) {
            .top-content {
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }

            .title-and-buttons {
                align-items: center;
                text-align: center;
                width: 100%;
            }

            .palace-image {
                width: 100%;
                max-width: 600px;
                height: auto;
                aspect-ratio: 4/3;
            }

            .place-info {
                margin: 0 auto 40px;
                width: 100%;
            }

            .info-item {
                justify-content: center;
            }

            .description {
                text-align: center;
                margin: 0 auto;
                max-width: 100%;
            }

            .cards-container {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .card {
                width: calc(50% - 20px);
                min-width: 280px;
            }

            .reviews-container {
                flex-direction: column;
                gap: 30px;
            }

            .review-card {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .main-section {
                margin-top: 60px;
                padding: 0 10px;
            }

            .title {
                font-size: 28px;
                margin-bottom: 20px;
            }

            .info-item {
                font-size: 15px;
                flex-direction: column;
                align-items: center;
                gap: 5px;
                margin-bottom: 15px;
            }

            .info-label {
                min-width: auto;
            }

            .btn {
                min-width: 100%;
                width: 100%;
                padding: 15px 20px;
                font-size: 16px;
            }

            .buttons-container {
                width: 100%;
            }

            .description {
                font-size: 15px;
                line-height: 1.5;
            }

            .cards-container {
                padding: 20px 10px;
            }

            .card {
                width: 100%;
                height: 140px;
                padding: 15px;
            }

            .card-title {
                font-size: 16px;
                max-width: 120px;
            }

            .card-image {
                width: 60px;
                height: 60px;
            }

            .section-title {
                font-size: 24px;
                margin-bottom: 30px;
            }

            .reviewer-name {
                font-size: 18px;
            }

            .review-text {
                font-size: 15px;
            }

            .stars-container {
                margin-bottom: 15px;
            }

            .star {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .main-section {
                margin-top: 50px;
                margin-bottom: 30px;
            }

            .title {
                font-size: 24px;
            }

            .info-item {
                font-size: 14px;
            }

            .btn {
                padding: 12px 15px;
                font-size: 15px;
            }

            .description {
                font-size: 14px;
            }

            .cards-container {
                padding: 15px 10px;
                gap: 15px;
            }

            .card {
                height: 130px;
                padding: 12px;
            }

            .card-title {
                font-size: 15px;
            }

            .card-image {
                width: 50px;
                height: 50px;
            }

            .question-mark {
                width: 25px;
                height: 25px;
                font-size: 14px;
            }

            .tooltip-text {
                width: 250px;
                font-size: 12px;
                padding: 8px;
            }

            .section-title {
                font-size: 22px;
                margin-bottom: 25px;
            }

            .review-card {
                padding: 20px 15px;
            }

            .reviewer-name {
                font-size: 16px;
            }

            .review-text {
                font-size: 14px;
            }

            .feedback-section {
                padding: 0 15px;
                margin: 40px auto;
            }

            .feedback-container {
                padding: 15px;
            }

            .feedback-input {
                height: 90px;
                font-size: 14px;
                padding: 12px;
            }

            .submit-button {
                padding: 10px 25px;
                font-size: 14px;
            }

            .newsletter-section {
                padding: 20px 0;
            }

            .newsletter-title {
                font-size: 18px;
            }

            .newsletter-form {
                max-width: 100%;
            }

            .newsletter-input {
                font-size: 14px;
            }

            .newsletter-button {
                width: 35px;
                height: 35px;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>
    <!-- Section principale -->
    <section class="main-section">
        <div class="top-content">
            <img src="https://woody.cloudly.space/app/uploads/porte-dromardeche/2021/07/thumbs/palais00-640x640.jpg" alt="Le Palais Idéal du Facteur Cheval" class="palace-image">
            <div class="title-and-buttons">
                <h1 class="title">Le Palais Idéal du Facteur Cheval</h1>

                <div class="place-info">
                    <div class="info-item">
                        <span class="info-label">Architecte :</span>
                        <span class="info-value">Ferdinand Cheval</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Adresse :</span>
                        <span class="info-value">8 Rue du Palais, 26390 Hauterives</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Période :</span>
                        <span class="info-value">1879-1912</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Style :</span>
                        <span class="info-value">Architecture naïve</span>
                    </div>
                </div>

                <div class="buttons-container">
                    <a href="#" class="btn btn-green">Visiter le site web</a>
                    <a href="#" class="btn btn-red">Réserver les billets</a>
                </div>
            </div>
        </div>

        <p class="description" data-full-text="Palais construit de ses propres mains par un facteur rural, mêlant avec poésie des inspirations hindoues, des motifs orientaux et des éléments de la nature. Cette œuvre unique au monde, classée Monument Historique, témoigne de l'extraordinaire imagination et de la persévérance de Ferdinand Cheval. Pendant 33 ans, le facteur Cheval a ramassé des pierres lors de ses tournées quotidiennes pour construire ce palais de rêve. L'édifice, haut de 12 mètres et long de 26 mètres, présente une architecture fantastique où se mêlent des influences de différentes cultures et époques. Les façades sont ornées de sculptures représentant des animaux, des personnages mythologiques et des éléments naturels. Chaque détail raconte une histoire, chaque pierre porte la marque de l'imagination débordante de son créateur. Le Palais Idéal est aujourd'hui considéré comme un chef-d'œuvre de l'art brut et attire des visiteurs du monde entier, fascinés par cette construction unique qui défie les conventions architecturales traditionnelles.">
            Palais construit de ses propres mains par un facteur rural, mêlant avec poésie des inspirations hindoues, des motifs orientaux et des éléments de la nature. Cette œuvre unique au monde, classée Monument Historique, témoigne de l'extraordinaire imagination et de la persévérance de Ferdinand Cheval. Pendant 33 ans, le facteur Cheval a ramassé des pierres lors de ses tournées quotidiennes pour construire ce palais de rêve. L'édifice, haut de 12 mètres et long de 26 mètres, présente une architecture fantastique où se mêlent des influences de différentes cultures et époques. Les façades sont ornées de sculptures représentant des animaux, des personnages mythologiques et des éléments naturels. Chaque détail raconte une histoire, chaque pierre porte la marque de l'imagination débordante de son créateur. Le Palais Idéal est aujourd'hui considéré comme un chef-d'œuvre de l'art brut et attire des visiteurs du monde entier, fascinés par cette construction unique qui défie les conventions architecturales traditionnelles.
            <a href="#" class="voir-plus" onclick="toggleDescription(event)">Voir plus</a>
        </p>
    </section>

    <!-- Section des cartes -->
    <section class="cards-section">
        <div class="cards-container">
            <!-- Carte Le fun fact -->
            <div class="card">
                <div class="card-face card-front">
                    <div class="card-content">
                        <h3 class="card-title">Le fun fact</h3>
                    </div>
                    <img src="../../assets/images/details-page/rouge.svg" alt="Fun fact character" class="card-image">
                    <div class="card-blur"></div>
                </div>
            </div>

            <!-- Carte Scannez le QR Code -->
            <div class="card">
                <div class="card-content">
                    <h3 class="card-title">Scannez le QR Code</h3>
                </div>
                <img src="../../assets/images/details-page/cam.svg"" alt=" QR Code icon" class="card-image">
                <div class="card-blur"></div>
                <div class="question-mark">
                    ?
                    <span class="tooltip-text">Scannez le QR code à l'entrée du lieu pour avoir accès au mini-jeu et obtenir des badges.</span>
                </div>
            </div>

            <!-- Carte Obtenir un badge -->
            <div class="card">
                <div class="card-content">
                    <h3 class="card-title">Obtenir un badge</h3>
                </div>
                <img src="../../assets/images/details-page/loupe.svg"" alt=" Badge icon" class="card-image">
                <div class="card-blur"></div>
                <div class="question-mark">?
                    <span class="tooltip-text">Répondez correctement aux questions du mini-jeu après avoir scanné le QR code pour débloquer des badges exclusifs.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section des avis -->
    <section class="reviews-section">
        <h2 class="section-title">Ce qu'en pensent les <span class="petit-pas">Petit Pas</span></h2>

        <div class="reviews-container">
            <!-- Avis Djibril -->
            <div class="review-card">
                <h3 class="reviewer-name">Djibril</h3>
                <div class="stars-container">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star empty">★</span>
                </div>
                <p class="review-text">
                    Trop stylé, le mec a tout fait tout seul, c'est grave impressionnant.
                </p>
            </div>

            <!-- Avis Isaac -->
            <div class="review-card">
                <h3 class="reviewer-name">Isaac</h3>
                <div class="stars-container">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                </div>
                <p class="review-text">
                    Incroyable ! On dirait un décor de film, j'ai adoré chaque détail.
                </p>
            </div>

            <!-- Avis Leonie -->
            <div class="review-card">
                <h3 class="reviewer-name">Leonie</h3>
                <div class="stars-container">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star empty">★</span>
                    <span class="star empty">★</span>
                    <span class="star empty">★</span>
                </div>
                <p class="review-text">
                    C'est original, mais j'ai pas trop compris le délire... cool à voir une fois.
                </p>
            </div>
        </div>
    </section>

    <!-- Section commentaire -->
    <section class="feedback-section">
        <div class="feedback-container">
            <textarea class="feedback-input" placeholder="Donne ton avis..."></textarea>
            <button type="submit" class="submit-button">Envoyer</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const description = document.querySelector('.description');
            const voirPlus = document.querySelector('.voir-plus');
            const fullText = description.getAttribute('data-full-text');
            const charLimit = 200;

            if (fullText.length > charLimit) {
                description.textContent = fullText.substring(0, charLimit) + '...';
                voirPlus.style.display = 'inline';
                description.appendChild(voirPlus);
            }
        });

        function toggleDescription(event) {
            event.preventDefault();
            const description = document.querySelector('.description');
            const link = document.querySelector('.voir-plus');
            const fullText = description.getAttribute('data-full-text');

            if (description.textContent.includes('...')) {
                description.textContent = fullText;
                link.textContent = 'Voir moins';
            } else {
                description.textContent = fullText.substring(0, 200) + '...';
                link.textContent = 'Voir plus';
            }
            description.appendChild(link);
        }
    </script>
</body>

</html>