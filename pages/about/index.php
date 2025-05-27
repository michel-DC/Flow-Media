<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>À propos | AMF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #e53e3e;
            --secondary-color: #fc8181;
            --accent-color: #ff6b6b;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-color);
            background: var(--light-bg);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            margin-bottom: 100px;
            padding: 0 80px;
            position: relative;
        }

        .about-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://img.lemde.fr/2016/05/26/344.5/0/4134/2067/1342/671/60/0/df35554_16210-vs952y.JPG');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 140px 0 80px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            opacity: 0.3;
            animation: pulse 4s ease-in-out infinite;
        }

        .about-hero-content {
            text-align: center;
            color: var(--white);
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .about-hero-content h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 30px;
            letter-spacing: -1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease forwards;
        }

        .about-subtitle {
            font-size: 1.4rem;
            opacity: 0.95;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease forwards 0.2s;
        }

        section {
            padding: 80px 0;
            position: relative;
            margin-bottom: 50px;
        }

        h2 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 40px;
            letter-spacing: -1px;
            animation: fadeInUp 1s ease forwards;
        }

        .mission-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 40px;
            align-items: center;
            animation: fadeInUp 1s ease forwards 0.4s;
        }

        .mission-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .mission-image {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: transform 0.3s ease;
        }

        .mission-image:hover {
            transform: translateY(-10px);
        }

        .mission-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            animation: fadeInUp 1s ease forwards 0.4s;
        }

        .action-card {
            background: var(--white);
            border-radius: 24px;
            padding: 40px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .action-card:hover {
            transform: translateY(-10px);
        }

        .action-card h3 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
            animation: fadeInUp 1s ease forwards 0.4s;
        }

        .values-card {
            background: var(--white);
            border-radius: 24px;
            padding: 40px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .values-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .values-list {
            list-style-type: none;
            padding: 0;
        }

        .values-list li {
            margin-bottom: 25px;
            padding-left: 40px;
            position: relative;
            font-size: 1.1rem;
        }

        .values-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2rem;
            width: 30px;
            height: 30px;
            background: rgba(58, 121, 31, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            animation: fadeInUp 1s ease forwards 0.4s;
        }

        .team-member {
            background: var(--white);
            border-radius: 24px;
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-10px);
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 4px solid var(--primary-color);
            transition: transform 0.3s ease;
        }

        .team-member:hover img {
            transform: scale(1.05);
        }

        .team-member h3 {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .team-member p {
            color: var(--text-color);
            opacity: 0.8;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s infinite linear;
        }

        .shape-1 {
            top: 10%;
            left: 5%;
            width: 100px;
            height: 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="%233a791f"/></svg>') no-repeat;
            animation-delay: 0s;
        }

        .shape-2 {
            top: 20%;
            right: 10%;
            width: 80px;
            height: 80px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect x="20" y="20" width="60" height="60" fill="%238ac571"/></svg>') no-repeat;
            animation-delay: -5s;
        }

        .shape-3 {
            bottom: 15%;
            left: 15%;
            width: 60px;
            height: 60px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><polygon points="50,20 80,80 20,80" fill="%233a791f"/></svg>') no-repeat;
            animation-delay: -10s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            50% {
                transform: translate(20px, 20px) rotate(180deg);
            }

            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                opacity: 0.1;
            }

            50% {
                opacity: 0.2;
            }

            100% {
                opacity: 0.1;
            }
        }

        @media (max-width: 1200px) {
            .container {
                padding: 0 60px;
            }

            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 40px;
            }

            .mission-grid {
                grid-template-columns: 1fr;
            }

            .action-grid {
                grid-template-columns: 1fr;
            }

            .values-grid {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2.5rem;
            }

            h2 {
                font-size: 2rem;
            }

            .about-hero {
                padding: 80px 0 60px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 25px;
            }

            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.8rem;
            }

            .team-grid {
                grid-template-columns: 1fr;
            }

            .team-member img {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <section class="about-hero">
        <div class="container">
            <div class="about-hero-content">
                <h1>Notre Équipe</h1>
                <p class="about-subtitle">Une équipe passionnée au service des collectivités locales et de la jeunesse</p>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Notre mission</h2>
        <div class="mission-grid">
            <div class="mission-content">
                <p>L'Association des Maires de France (AMF) est la voix des collectivités locales depuis 1907. Représentant plus de 35 000 maires, elle œuvre quotidiennement pour défendre les intérêts des communes et promouvoir le développement local.</p>
                <p>À travers Flow Media, notre agence partenaire, nous avons pour mission de rapprocher les jeunes de 15 à 25 ans de la richesse culturelle de nos territoires. Nous croyons que la culture est un vecteur essentiel de cohésion sociale et d'épanouissement personnel pour les jeunes générations.</p>
            </div>
            <div class="mission-image">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/f5/Logo-amf-bas.png" alt="Logo AMF">
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Notre action</h2>
        <div class="action-grid">
            <div class="action-card">
                <h3>Défense des communes</h3>
                <p>Nous représentons et défendons les intérêts des collectivités locales auprès des institutions nationales et européennes.</p>
            </div>
            <div class="action-card">
                <h3>Promotion culturelle</h3>
                <p>Nous soutenons et valorisons le patrimoine culturel local à travers des initiatives innovantes comme Flow Media.</p>
            </div>
            <div class="action-card">
                <h3>Engagement jeunesse</h3>
                <p>Nous développons des programmes pour impliquer les jeunes dans la vie culturelle et citoyenne de leur territoire.</p>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Nos valeurs</h2>
        <div class="values-grid">
            <div class="values-card">
                <ul class="values-list">
                    <li><strong>Proximité</strong> - Nous sommes au plus près des réalités locales</li>
                    <li><strong>Engagement</strong> - Nous défendons avec conviction les intérêts des communes</li>
                    <li><strong>Innovation</strong> - Nous développons des solutions adaptées aux nouveaux enjeux</li>
                </ul>
            </div>
            <div class="values-card">
                <ul class="values-list">
                    <li><strong>Solidarité</strong> - Nous agissons pour la cohésion entre les territoires</li>
                    <li><strong>Transmission</strong> - Nous œuvrons pour préserver et partager notre héritage culturel</li>
                    <li><strong>Dialogue</strong> - Nous favorisons les échanges entre les générations</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Notre équipe</h2>
        <div class="team-grid">
            <div class="team-member">
                <img src="https://media.lesechos.com/api/v1/images/view/655afa9b607bc30b322e806c/1280x720/0100138871832-web-tete.jpg" alt="David Lisnard">
                <h3>David Lisnard</h3>
                <p>Président de l'AMF</p>
            </div>
            <div class="team-member">
                <img src="https://observatoirevivreensemble.org/sites/default/files/styles/square_large/public/maire_-_sceaux_-_final_0.png?itok=zYp8r9EJ" alt="Philippe Laurent">
                <h3>Philippe Laurent</h3>
                <p>Secrétaire général</p>
            </div>
            <div class="team-member">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/ALaignel.JPG/1200px-ALaignel.JPG" alt="André Laignel">
                <h3>André Laignel</h3>
                <p>Premier vice-président</p>
            </div>
            <div class="team-member">
                <img src="https://media.licdn.com/dms/image/v2/C4E03AQG0uKY31gsIIA/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1618385662641?e=2147483647&v=beta&t=Zm_JOn8PHXQTWE1hczlTvLLiErhXW7XtXi3pkQqCmLw" alt="Emmanuel Constant">
                <h3>Emmanuel Constant</h3>
                <p>Trésorier</p>
            </div>
        </div>
    </section>

    <?php include '../../includes/layout/footer.php' ?>

</body>

</html>