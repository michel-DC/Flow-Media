<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partenaires | Flow Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        .partners-section {
            background-color: #f8f9fa;
            padding: 100px 0;
            position: relative;
            z-index: 5;
            margin-top: 120px;
        }

        .partners-section::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 10% 20%, rgba(111, 206, 71, 0.2) 0%, transparent 11%),
                radial-gradient(circle at 90% 80%, rgba(95, 224, 102, 0.2) 0%, transparent 11%),
                radial-gradient(circle at 50% 50%, rgba(178, 245, 150, 0.1) 0%, transparent 11%);
            pointer-events: none;
            z-index: -1;
        }

        .partners-title {
            text-align: center;
            color: #3a791f;
            font-size: 2.7rem;
            font-weight: 800;
            margin-bottom: 36px;
            letter-spacing: -1px;
        }

        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .partner-card {
            background: #fff;
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .partner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .partner-logo {
            width: 150px;
            height: 150px;
            object-fit: contain;
            margin: 0 auto 1.5rem;
            display: block;
        }

        .partner-description {
            margin-top: 1rem;
            color: #666;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .partners-title {
                font-size: 2rem;
            }

            .partners-grid {
                grid-template-columns: 1fr;
                padding: 0 25px;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <section class="partners-section">

        <?php include '../../animations/buisson/index.php'; ?>

        <h1 class="partners-title">Nos Partenaires</h1>
        <p style="text-align: center; margin-bottom: 3rem; color: #666;">Nous collaborons avec des institutions et créateurs engagés dans la promotion culturelle</p>

        <div class="partners-grid">
            <div class="partner-card">
                <img src="https://www.amf.asso.fr/img/logo-amf-bas.png" alt="AMF Logo" class="partner-logo">
                <h3>Association des Maires de France</h3>
                <p class="partner-description">Notre principal partenaire institutionnel pour la promotion du patrimoine architectural français.</p>
            </div>

            <div class="partner-card">
                <img src="https://image.over-blog.com/lWzrS-cab4LuWDJkxy_Dvxh62Ks=/filters:no_upscale()/image%2F6834552%2F20220421%2Fob_8b255d_81-5fc6581a822f9-orig-1.png" alt="Ministère de la Culture" class="partner-logo">
                <h3>Ministère de la Culture</h3>
                <p class="partner-description">Partenaire clé pour l'accès aux ressources culturelles et la valorisation du patrimoine.</p>
            </div>

            <div class="partner-card">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdSPWnxwcMCopn4RT7E94Hs3nd5Xs1fE7hlg&s" alt="Pass Culture" class="partner-logo">
                <h3>Pass Culture</h3>
                <p class="partner-description">Partenaire pour l'accès à la culture pour les jeunes.</p>
            </div>

            <div class="partner-card">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvt-rUaFQJuiskfXDgYZ08Nf-yBTSHMXodIg&s" alt="Région Île-de-France" class="partner-logo">
                <h3>Région Île-de-France</h3>
                <p class="partner-description">Partenaire institutionnel pour la promotion du patrimoine francilien.</p>
            </div>

            <div class="partner-card">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQICLj-Kd5YYTgiSCAQFy9L6Wds2OUjWv8taQ&s" alt="Région Aquitaine" class="partner-logo">
                <h3>Région Aquitaine</h3>
                <p class="partner-description">Partenaire pour la valorisation du patrimoine aquitain.</p>
            </div>

            <div class="partner-card">
                <img src="https://www.radiofrance.fr/s3/cruiser-production/2021/11/eac4208f-148f-44fe-8cd0-86a7a393703b/1200x680_dirtybiology.jpg" alt="DirtyBiology" class="partner-logo">
                <h3>DirtyBiology</h3>
                <p class="partner-description">Chaîne de vulgarisation scientifique qui explore les liens entre science et culture.</p>
            </div>

            <div class="partner-card">
                <img src="https://www.arte.tv/sites/corporate/files/arte-logo_1920x1080-6-470x270.jpg" alt="Arte" class="partner-logo">
                <h3>ARTE</h3>
                <p class="partner-description">Chaîne culturelle européenne proposant des documentaires et reportages de qualité.</p>
            </div>

            <div class="partner-card">
                <img src="https://cdn-s-www.bienpublic.com/images/50EE43B2-24F2-4ECC-8974-37E3C646F414/MF_contenu/apres-quatre-mois-de-pause-squeezie-revient-sur-youtube-le-18-mai-1715513377.jpg" alt="EGO" class="partner-logo">
                <h3>Squeezie</h3>
                <p class="partner-description">Créateur de contenu engagé dans la démocratisation de la culture digitale et des nouveaux médias.</p>
            </div>

            <div class="partner-card">
                <img src="https://yt3.googleusercontent.com/57vFhA34Dk7HxGyhJB2zGHoy4uQW8WTy0r3wDO-pncYxLiWYRhU_e_ZQlrhKA0bRJLxNKzrH=s900-c-k-c0x00ffffff-no-rj" alt="EGO" class="partner-logo">
                <h3>Tsuku</h3>
                <p class="partner-description">Artiste numérique spécialisé dans la création de contenus visuels innovants et immersifs.</p>
            </div>

            <div class="partner-card">
                <img src="https://ondec.media/wp-content/uploads/2024/08/lena-situations-entre-attaques-et-succes-ep-2.png" alt="EGO" class="partner-logo">
                <h3>Lena situation</h3>
                <p class="partner-description">Influenceuse engagée dans la promotion de la culture mode et lifestyle auprès des jeunes.</p>
            </div>

            <div class="partner-card">
                <img src="https://journaldemickey.com/wp-content/uploads/2023/01/michou-683x1024.jpg" alt="EGO" class="partner-logo">
                <h3>Michou</h3>
                <p class="partner-description">Créateur de divertissement populaire qui participe à la modernisation des médias jeunesse.</p>
            </div>

            <div class="partner-card">
                <img src="https://yt3.googleusercontent.com/K9oQlDW3f-YUPAw7A-rjg4DQDP8HJMohnhpjoJrL7zhhvvSCD-6ykCkFvHaCVujCJyK2sgAH=s900-c-k-c0x00ffffff-no-rj" alt="EGO" class="partner-logo">
                <h3>Hugo decrypte</h3>
                <p class="partner-description">Journaliste numérique spécialisé dans l'analyse et la vulgarisation de l'actualité culturelle.</p>
            </div>

        </div>
    </section>

    <?php include '../../includes/layout/footer.php' ?>

</body>

</html>