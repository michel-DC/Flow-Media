<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domaines Culturels | Flow Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        
        :root {
            --soft-black: #1a1a1a;
            --white: #f9f9f9;
        }
        
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            color: var(--soft-black);
            background: var(--white);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        section {
            padding: 5rem 0;
        }
        
        h1, h2, h3 {
            font-weight: 600;
        }
        
        h1 {
            font-size: 3rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
        }
        
        .domaine-section {
            margin-bottom: 4rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        
        .domaine-content {
            display: flex;
            gap: 3rem;
            align-items: center;
        }
        
        .domaine-image {
            width: 400px;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .domaine-text {
            flex: 1;
        }
        
        @media (max-width: 768px) {
            .domaine-content {
                flex-direction: column;
            }
            
            .domaine-image {
                width: 100%;
            }
            
            h1 {
                font-size: 2.5rem;
            }
            
            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <section class="container">
        <h1>Nos Domaines Culturels</h1>
        <p style="text-align: center; margin-bottom: 3rem;">Découvrez les trois piliers de notre engagement culturel</p>
        
        <div class="domaine-section">
            <h2>Architecture</h2>
            <div class="domaine-content">
                <img src="https://cdn1.citylocker.paris/img/consignes-paris/bons-plans-paris/notre-dame/notre-dame-de-paris.jpg" alt="Architecture moderne" class="domaine-image">
                <div class="domaine-text">
                    <p>L'architecture est bien plus qu'une simple construction - c'est l'art de concevoir des espaces qui inspirent, émeuvent et façonnent notre quotidien. Notre agence s'engage à mettre en lumière les joyaux architecturaux français, des cathédrales gothiques aux innovations contemporaines.</p>
                    <p>Nous explorons notamment :</p>
                    <ul>
                        <li>L'évolution des styles architecturaux à travers les siècles</li>
                        <li>Les défis de la préservation du patrimoine bâti</li>
                        <li>L'architecture durable et écologique</li>
                        <li>Les projets urbains innovants</li>
                        <li>Les architectes visionnaires qui ont marqué leur époque</li>
                    </ul>
                    <p>À travers nos visites guidées, expositions et documentaires, nous rendons accessible cette discipline souvent perçue comme élitiste, en montrant son impact concret sur notre cadre de vie.</p>
                </div>
            </div>
        </div>
        
        <div class="domaine-section">
            <h2>Patrimoine</h2>
            <div class="domaine-content">
                <img src="https://lh5.googleusercontent.com/proxy/oc9Lbmy2Plr1FE04CC4x2fSc5Z_SLQV4mYvFWAYykZrY-z2SUxcNWrGpfU5nlO3h0iWpS95HEQ4gC43lQ22N8ckLUbusLEhWIF4edvz-v0V862mOFXxemvMQTqO_JbOhiqHajQbIKmiSxFv3Dw6-uDV4WiGbirb9yw3xEXAgL2fj0NDkhA" alt="Patrimoine historique" class="domaine-image">
                <div class="domaine-text">
                    <p>Le patrimoine culturel français est d'une richesse inestimable, témoin de notre histoire collective. Notre mission est de le valoriser auprès des jeunes générations en montrant sa modernité et sa pertinence dans le monde actuel.</p>
                    <p>Nos actions couvrent :</p>
                    <ul>
                        <li>Les monuments historiques classés</li>
                        <li>Les traditions et savoir-faire artisanaux</li>
                        <li>Le patrimoine immatériel (contes, chants, danses)</li>
                        <li>Les musées et collections</li>
                        <li>Les archives et documents historiques</li>
                    </ul>
                    <p>Nous organisons régulièrement des ateliers interactifs, des reconstitutions historiques et des parcours numériques pour redonner vie à ce patrimoine. Notre approche privilégie l'immersion et l'expérience sensible plutôt que l'érudition pure.</p>
                </div>
            </div>
        </div>
        
        <div class="domaine-section">
            <h2>Jardins</h2>
            <div class="domaine-content">
                <img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Jardin à la française" class="domaine-image">
                <div class="domaine-text">
                    <p>Les jardins représentent l'alliance parfaite entre nature et culture. De Versailles aux jardins partagés urbains, ils racontent notre relation à l'environnement et notre quête de beauté. Notre agence s'attache à montrer leur dimension artistique, historique et écologique.</p>
                    <p>Nos thématiques principales :</p>
                    <ul>
                        <li>L'art des jardins à travers les époques</li>
                        <li>Les jardins remarquables de France</li>
                        <li>La biodiversité et les écosystèmes</li>
                        <li>Le jardinage urbain et participatif</li>
                        <li>Les paysagistes contemporains</li>
                    </ul>
                    <p>Nous proposons des balades sensorielles, des ateliers de permaculture et des résidences d'artistes dans les jardins pour créer du lien entre les jeunes et ces espaces de vie. Nos projets mêlent souvent art contemporain et nature pour des expériences inédites.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include '../../includes/layout/footer.php'; ?>
</body>
</html>
