<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos | AMF</title>
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
                <p>L'Association des Maires de France (AMF) est la voix des collectivités locales depuis 1907. Représentant plus de 35 000 maires, elle œuvre quotidiennement pour défendre les intérêts des communes et promouvoir le développement local.</p>
                <p>À travers Flow Media, notre agence partenaire, nous avons pour mission de rapprocher les jeunes de 15 à 25 ans de la richesse culturelle de nos territoires. Nous croyons que la culture est un vecteur essentiel de cohésion sociale et d'épanouissement personnel pour les jeunes générations.</p>
            </div>
            <div>
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/f5/Logo-amf-bas.png" alt="Logo AMF" style="max-width: 100%; border-radius: 8px;">
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Notre action</h2>
        <div class="grid">
            <div class="card">
                <h3>Défense des communes</h3>
                <p>Nous représentons et défendons les intérêts des collectivités locales auprès des institutions nationales et européennes.</p>
            </div>
            <div class="card">
                <h3>Promotion culturelle</h3>
                <p>Nous soutenons et valorisons le patrimoine culturel local à travers des initiatives innovantes comme Flow Media.</p>
            </div>
            <div class="card">
                <h3>Engagement jeunesse</h3>
                <p>Nous développons des programmes pour impliquer les jeunes dans la vie culturelle et citoyenne de leur territoire.</p>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Nos valeurs</h2>
        <div class="grid" style="grid-template-columns: 1fr 1fr; align-items: start;">
            <div>
                <ul class="values-list">
                    <li><strong>Proximité</strong> - Nous sommes au plus près des réalités locales</li>
                    <li><strong>Engagement</strong> - Nous défendons avec conviction les intérêts des communes</li>
                    <li><strong>Innovation</strong> - Nous développons des solutions adaptées aux nouveaux enjeux</li>
                </ul>
            </div>
            <div>
                <ul class="values-list">
                    <li><strong>Solidarité</strong> - Nous agissons pour la cohésion entre les territoires</li>
                    <li><strong>Transmission</strong> - Nous œuvrons pour préserver et partager notre héritage culturel</li>
                    <li><strong>Dialogue</strong> - Nous favorisons les échanges entre les générations</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container fin">
        <h2>Notre équipe</h2>
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
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

    <?php include '../../includes/layout/footer.php'; ?>
</body>
</html>
