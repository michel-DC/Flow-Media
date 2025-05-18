<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos | Flow Media</title>
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

        .fin {
            margin-bottom: 40px;
        }
        
        h1, h2, h3 {
            font-weight: 600;
        }
        
        h1 {
            font-size: 3rem;
            margin-bottom: 2rem;
        }
        
        h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .card {
            background: var(--white);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .image-placeholder {
            height: 200px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border-radius: 4px;
        }
        
        .team-member {
            text-align: center;
        }
        
        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
        }
        
        .values-list {
            list-style-type: none;
            padding: 0;
        }
        
        .values-list li {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
            position: relative;
        }
        
        .values-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--soft-black);
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
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
        <h1>Notre mission</h1>
        <div class="grid" style="align-items: center;">
            <div>
                <p>Flow Media est une agence de communication innovante créée pour rapprocher les jeunes de 15 à 25 ans de la culture sous toutes ses formes. Mandatée par l'Association des Maires de France, notre objectif est de rendre accessible et attractive la richesse culturelle de notre territoire.</p>
                <p>Nous croyons que la culture n'est pas réservée à une élite, mais qu'elle doit être vivante, partagée et réinventée par chaque génération. Notre approche combine expertise culturelle et codes de communication contemporains pour créer des ponts entre les institutions et les jeunes publics.</p>
            </div>
            <div class="image-placeholder">
                [Image de l'équipe Flow Media en action]
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Notre approche</h2>
        <div class="grid">
            <div class="card">
                <h3>Accessibilité</h3>
                <p>Nous décomplexons l'accès à la culture en créant des contenus adaptés aux codes des jeunes générations, tout en conservant la profondeur et la qualité des sujets traités.</p>
            </div>
            <div class="card">
                <h3>Innovation</h3>
                <p>Nous utilisons les nouvelles technologies et formats de communication (podcasts, réseaux sociaux, réalité augmentée) pour raconter différemment le patrimoine culturel.</p>
            </div>
            <div class="card">
                <h3>Engagement</h3>
                <p>Nous impliquons directement les jeunes dans la création de nos contenus et activités, faisant d'eux des acteurs plutôt que de simples spectateurs.</p>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Nos valeurs</h2>
        <div class="grid" style="grid-template-columns: 1fr 1fr; align-items: start;">
            <div>
                <ul class="values-list">
                    <li><strong>Curiosité</strong> - Nous cultivons l'émerveillement et la soif de découverte</li>
                    <li><strong>Créativité</strong> - Nous repoussons les limites des formats traditionnels</li>
                    <li><strong>Authenticité</strong> - Nous restons fidèles à l'esprit des œuvres tout en les rendant accessibles</li>
                </ul>
            </div>
            <div>
                <ul class="values-list">
                    <li><strong>Inclusion</strong> - Nous croyons que la culture doit être ouverte à tous</li>
                    <li><strong>Innovation</strong> - Nous expérimentons sans cesse de nouvelles façons de partager la culture</li>
                    <li><strong>Engagement</strong> - Nous sommes passionnés par notre mission de transmission</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container fin">
        <h2>Notre équipe</h2>
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
            <div class="team-member">
                <div class="image-placeholder" style="border-radius: 50%;">
                    [Photo membre équipe]
                </div>
                <h3>Michel christ</h3>
                <p>Développeur web</p>
            </div>
            <div class="team-member">
                <div class="image-placeholder" style="border-radius: 50%;">
                    [Photo membre équipe]
                </div>
                <h3>Michel christ</h3>
                <p>Développeur web</p>
            </div>
            <div class="team-member">
                <div class="image-placeholder" style="border-radius: 50%;">
                    [Photo membre équipe]
                </div>
                <h3>Michel christ</h3>
                <p>Développeur web</p>
            </div>
            <div class="team-member">
                <div class="image-placeholder" style="border-radius: 50%;">
                    [Photo membre équipe]
                </div>
                <h3>Michel christ</h3>
                <p>Développeur web</p>
            </div>
        </div>
    </section>

    <?php include '../../includes/layout/footer.php'; ?>
</body>
</html>
