<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Philosophie | Flow Media</title>
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

        .feature-image {
            width: 100%;
            max-width: 500px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin: 2rem 0;
        }

        .game-element {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 2rem;
            margin: 1rem 0;
            border-left: 4px solid var(--soft-black);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            align-items: center;
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
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        .highlight {
            font-weight: 600;
        }

        @media (max-width: 768px) {
            h1 { font-size: 2.5rem; }
            h2 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <section class="container">
        <h1>Notre Approche Innovante</h1>
        <div class="grid">
            <div>
                <p>Chez Flow Media, nous avons développé une approche unique pour rendre la culture accessible et captivante pour les jeunes. Notre méthode combine <span class="highlight">gamification</span>, <span class="highlight">exploration interactive</span> et <span class="highlight">technologies modernes</span> pour créer une expérience culturelle immersive.</p>
                <p>Notre mission est de transformer la découverte culturelle en une aventure passionnante, où chaque jeune peut devenir un explorateur du patrimoine français.</p>
            </div>
            <img src="https://www.comtogether.fr/wp-content/uploads/2021/11/team-comtogether-min-1024x708.jpg" alt="Exploration culturelle" class="feature-image">
        </div>
    </section>

    <section class="container">
        <h2>La Chasse au Trésor Culturelle</h2>
        <div class="game-element">
            <h3>Explorez, Découvrez, Gagnez</h3>
            <p>Transformez chaque visite culturelle en une aventure captivante :</p>
            <ul>
                <li>Parcours interactifs avec des indices à découvrir</li>
                <li>Badges et récompenses pour chaque découverte</li>
                <li>Classements et défis entre amis</li>
                <li>Énigmes historiques à résoudre</li>
                <li>Collection de souvenirs numériques</li>
            </ul>
        </div>
        <div class="grid">
            <div class="game-element">
                <h3>Comment ça marche ?</h3>
                <p>1. Choisissez votre parcours thématique</p>
                <p>2. Scannez les QR codes sur place</p>
                <p>3. Résolvez les énigmes</p>
                <p>4. Collectionnez vos récompenses</p>
            </div>
            <img src="https://www.jeuxetcompagnie.fr/wp-content/uploads/2017/04/enfants-chasse-tresor.jpg" alt="Chasse au trésor" class="feature-image">
        </div>
    </section>

    <section class="container">
        <h2>Gamification de l'Apprentissage</h2>
        <div class="grid">
            <div>
                <div class="game-element">
                    <h3>Quiz Interactifs</h3>
                    <p>Testez vos connaissances de manière ludique avec nos quiz thématiques sur l'histoire et le patrimoine.</p>
                    <ul>
                        <li>Quiz chronométrés</li>
                        <li>Questions adaptatives</li>
                        <li>Badges de spécialiste</li>
                    </ul>
                </div>
                <div class="game-element">
                    <h3>Réalité Augmentée</h3>
                    <p>Revivez l'histoire grâce à des reconstitutions en réalité augmentée des monuments et sites historiques.</p>
                    <ul>
                        <li>Reconstitutions 3D</li>
                        <li>Visites virtuelles</li>
                        <li>Animations historiques</li>
                    </ul>
                </div>
            </div>
            <img src="https://i0.wp.com/virtuelli.ma/wp-content/uploads/2023/08/children-using-vr-in-art-gallery.jpg?fit=2000%2C1333&ssl=1" alt="Gamification" class="feature-image">
        </div>
    </section>

    <section class="container">
        <h2>Communauté et Partage</h2>
        <div class="grid">
            <img src="https://media.istockphoto.com/id/1371940128/fr/photo/des-amis-multiraciaux-prennent-un-selfie-en-grand-groupe-en-souriant-%C3%A0-la-cam%C3%A9ra-des-jeunes.jpg?s=612x612&w=0&k=20&c=HuKWH5KVg5seO1FdC58OEsvtd-D-RT2lmuAumVGMO0U=" alt="Communauté" class="feature-image">
            <div>
                <p>Créez votre profil d'explorateur culturel, partagez vos découvertes et connectez-vous avec d'autres passionnés. Gagnez des points en :</p>
                <ul>
                    <li>Partageant vos photos et expériences</li>
                    <li>Organisant des visites guidées</li>
                    <li>Contribuant à l'enrichissement du contenu</li>
                    <li>Participant à des événements communautaires</li>
                    <li>Créant des parcours personnalisés</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Technologies Innovantes</h2>
        <div class="grid">
            <div>
                <div class="game-element">
                    <h3>Application Mobile</h3>
                    <p>Une application intuitive pour :</p>
                    <ul>
                        <li>Suivre vos parcours en temps réel</li>
                        <li>Accéder à votre collection de badges</li>
                        <li>Partager vos découvertes</li>
                        <li>Interagir avec la communauté</li>
                    </ul>
                </div>
                <div class="game-element">
                    <h3>Intelligence Artificielle</h3>
                    <p>Des parcours personnalisés grâce à l'IA :</p>
                    <ul>
                        <li>Recommandations adaptées</li>
                        <li>Contenu dynamique</li>
                        <li>Expérience unique pour chaque utilisateur</li>
                    </ul>
                </div>
            </div>
            <img src="https://img.freepik.com/psd-premium/conception-interface-ui-ux-pour-smartphone_23-2150395031.jpg?semt=ais_hybrid&w=740" alt="Technologies" class="feature-image">
        </div>
    </section>

    <?php include '../../includes/layout/footer.php'; ?>
</body>
</html>
