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
            margin-bottom: 40px;
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
        
        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .partner-card {
            background: var(--white);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .partner-card:hover {
            transform: translateY(-5px);
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
            color: #555;
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
        <h1>Nos Partenaires</h1>
        <p style="text-align: center; margin-bottom: 3rem;">Nous collaborons avec des institutions et créateurs engagés dans la promotion culturelle</p>
        
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
                <img src="https://www.clique.tv/wp-content/uploads/2024/03/0000_ARTICLE-4-1.jpg" alt="Nota Bene" class="partner-logo">
                <h3>Nota Bene</h3>
                <p class="partner-description">Créateur de contenu historique qui rend la culture accessible aux jeunes.</p>
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
                <img src="https://yt3.googleusercontent.com/8hjEXqyKPEgZnqf9uuBMw9djY0DvmCAkRzfuywP8HbPAxQM-yxIxEPZw6iAInButgnGkw6kwjw=s160-c-k-c0x00ffffff-no-rj" alt="EGO" class="partner-logo">
                <h3>EGO</h3>
                <p class="partner-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut deserunt asperiores tempora optio laudantium laborum magni deleniti nemo.</p>
            </div>
        </div>
    </section>

    <?php include '../../includes/layout/footer.php'; ?>
</body>
</html>
