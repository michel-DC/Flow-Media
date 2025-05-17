<?php
require_once 'includes/auth.php'; 

$link = mysqli_connect("localhost", "micheldjoumessi_pair-prog", "michelchrist", "micheldjoumessi_pair-prog");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Connecter les jeunes à la culture</title>
    <link rel="icon" href="/assets/icons/icon-test.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cookie&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
        
        :root {
            --soft-black: #1a1a1a;
            --white: #f9f9f9;
        }
        
        body {
            font-family: "Space Grotesk", sans-serif;
            margin: 0;
            padding: 0;
            color: var(--soft-black);
            background: var(--white);
            line-height: 1.6;
        }
        
        .navbar {
            position: sticky;
            top: 0;
            background: var(--white);
            padding: 0.50rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .nav-links a {
            color: var(--soft-black);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-links a:hover {
            opacity: 0.8;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .hero {
            text-align: center;
            padding: 30px 0;
            background-image: url('https://musees-nationaux-alpesmaritimes.fr/chagall/sites/chagall/files/styles/w1920_extra_wide/public/2023-09/Atelier_duBeau_texture_%C3%A9tudiants_1920x960px.jpg?itok=ViyGvrM4');
            background-size: cover;
            background-position: center;
            color: var(--white);
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 2rem;
        }
        
        .cursive-text {
            font-family: "Cookie", cursive;
            font-weight: 400;
            font-style: normal;
            font-size: 10rem;
            margin-bottom: 1rem;
        }
        
        .hero-content p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .hero-cta-text {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 2.5rem 0;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 28px;
            background: var(--soft-black);
            color: var(--white);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 500;
            margin: 1rem 0.5rem;
            transition: all 0.3s ease;
            border: 2px solid var(--soft-black);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-large {
            padding: 15px 32px;
            font-size: 1.1rem;
        }
        
        .btn-white {
            background: var(--white);
            color: var(--soft-black);
        }
        
        .btn-white:hover {
            background: var(--soft-black);
            color: var(--white);
        }
        
        section {
            padding: 5rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        
        section h2 {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
        }

        #domains .image-placeholder {
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f0f0;
            margin-bottom: 15px;
        }

        #domains .image-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.3s ease;
        }

        #domains .card:hover img {
            transform: scale(1.05);
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .card {
            border: 1px solid rgba(0,0,0,0.1);
            padding: 1.5rem;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            background: var(--white);
            border-radius: 8px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .image-placeholder {
            background: #f0f0f0;
            height: 200px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #666;
            text-align: center;
        }

        .img-placeholder img {
            width: 100px;
            height: 100px
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }
            
            .nav-links {
                margin-top: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .cursive-text {
                font-size: 5rem;
            }
            
            .hero-content p {
                font-size: 1.2rem;
            }
            
            .hero-cta-text {
                font-size: 1.8rem;
            }
            
            .btn {
                display: block;
                margin: 0.5rem auto;
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8ZM9.25 3.75C9.25 4.44036 8.69036 5 8 5C7.30964 5 6.75 4.44036 6.75 3.75C6.75 3.05964 7.30964 2.5 8 2.5C8.69036 2.5 9.25 3.05964 9.25 3.75ZM12 8H9.41901L11.2047 13H9.081L8 9.97321L6.91901 13H4.79528L6.581 8H4V6H12V8Z" fill="#000000"/>
            </svg>
        </div>
        <div class="nav-links">
            <!-- <a href="#accueil"><i class="fas fa-home"></i></a> -->
            
            <div class="nav-dropdown">
                <button class="nav-dropbtn">Découvrir <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/pages/about"><i class="fas fa-question-circle"></i> Qui sommes-nous</a>
                    <a href="/pages/domaines-culturels"><i class="fas fa-landmark"></i> Domaines culturels</a>
                    <a href="/pages/patenaires"><i class="fas fa-handshake"></i> Partenaires</a>
                </div>
            </div>
            
            <div class="nav-dropdown">
                <button class="nav-dropbtn">Expériences <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/pages/activites"><i class="fas fa-calendar-alt"></i> Activités</a>
                    <a href="/pages/podcast"><i class="fas fa-podcast"></i> Podcasts</a>
                    <a href="/pages/temoignages"><i class="fas fa-comment-alt"></i> Témoignages</a>
                </div>
            </div>
            
            <?php if (isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] == 'user'): ?>
            <div class="nav-dropdown">
                <button class="nav-dropbtn"><i class="fas fa-user-alt"></i> <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/connexion/login.php">Mon profil</a>
                    <a href="/connexion/register.php">Mes réservations</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true): ?>
                <div class="nav-dropdown">
                <button class="nav-dropbtn"><i class="fas fa-user-alt"></i> <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/connexion/login.php">Me connecter</a>
                    <a href="/connexion/register.php">M'inscrire</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <style>
            .nav-dropdown {
                position: relative;
                display: inline-block;
            }
            
            .nav-dropbtn {
                background-color: transparent;
                color: var(--soft-black);
                padding: 12px 16px;
                font-size: inherit;
                font-family: inherit;
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 5px;
            }
            
            .nav-dropdown-content {
                display: none;
                position: absolute;
                background-color: var(--white);
                min-width: 200px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
                border-radius: 4px;
                right: 0;
            }
            
            .nav-dropdown-content a {
                color: var(--soft-black);
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
                transition: background-color 0.3s ease;
            }
            
            .nav-dropdown-content a:hover {
                background-color: #f1f1f1;
            }
            
            .nav-dropdown:hover .nav-dropdown-content {
                display: block;
            }
            
            .nav-dropdown:hover .nav-dropbtn {
                opacity: 0.8;
            }
        </style>
    </nav>

    <header class="hero" id="accueil">
        <div class="hero-content container">
            <h1 class="cursive-text">Flow Media</h1>
            <p>Cultivez votre curiosité, explorez votre culture</p>
            <div class="hero-cta-text">Prêt à explorer la culture autrement ?</div>
            <a href="/connexion/register.php" class="btn btn-large">Créer un compte gratuitement</a>
            <a href="#activities" class="btn btn-large btn-white">Découvrir les activités</a>
        </div>
    </header>

    <section class="container" id="about">
        <h2>Qui sommes-nous ?</h2>
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); align-items: center;">
            <div>
                <p>Flow Media est une agence de communication portée par une équipe jeune et créative, au service de la culture et de l'accessibilité. Mandatée par l'Association des Maires de France, notre mission est de valoriser le patrimoine culturel auprès des 15-25 ans.</p>
                <p>Notre approche ? Rendre la culture attractive, accessible et pertinente pour les jeunes générations. Nous créons des ponts entre les institutions culturelles traditionnelles et les codes de communication d'aujourd'hui.</p>
            </div>
            <div class="image-placeholder">
                [Image d'équipe : jeunes professionnels en réunion créative]
            </div>
        </div>
    </section>

    <section class="container" id="domains">
        <h2>Nos domaines culturels</h2>
        <div class="grid">
            <div class="card">
                <div class="image-placeholder">
                    <img class src="https://www.district-immo.com/wp-content/uploads/2023/04/Immeuble-haussmannien-shutterstock.png" alt="">
                </div>
                <h3>Architecture</h3>
                <p>Découvrez l'impact culturel et visuel de l'architecture qui façonne nos villes. Des bâtiments emblématiques aux structures innovantes, explorez les espaces qui racontent notre société et son évolution.</p>
            </div>
            <div class="card">
                <div class="image-placeholder">
                    <img src="https://media.lesechos.com/api/v1/images/view/65095a3f3880a20fca650e2f/contenu_article/image.jpg" alt="">
                </div>
                <h3>Patrimoine</h3>
                <p>Plongez dans l'histoire vivante de votre région à travers ses monuments, traditions et savoir-faire. Le patrimoine n'est pas figé dans le passé, il dialogue constamment avec notre présent et inspire notre futur.</p>
            </div>
            <div class="card">
                <div class="image-placeholder">
                    <img src="https://www.stiga.com/media/contentmanager/content/symetrie_jardin.jpg" alt="">
                </div>
                <h3>Jardin & nature</h3>
                <p>Reconnectez avec l'environnement et le vivant à travers les jardins historiques, parcs urbains et espaces verts. Découvrez comment la nature s'intègre à notre patrimoine culturel et architectural.</p>
            </div>
        </div>
    </section>

    <section class="container" id="activities">
        <h2>Activités à venir</h2>
        <div class="activities-grid">
            <div class="activity-card">
                <div class="image-placeholder">
                    [Photo exposition d'art urbain]
                </div>
                <h3>Street Art Tour - Centre-ville</h3>
                <p class="activity-date">28 mai 2025</p>
                <p>Parcours guidé à travers les œuvres de street art qui transforment nos murs en galeries à ciel ouvert. Découvrez les artistes locaux et internationaux qui s'expriment dans l'espace urbain.</p>
            </div>
            <div class="activity-card">
                <div class="image-placeholder">
                    [Photo lieu architectural]
                </div>
                <h3>Visite nocturne - Architectures lumineuses</h3>
                <p class="activity-date">5 juin 2025</p>
                <p>Une exploration des bâtiments emblématiques de la ville, magnifiés par des installations lumineuses. Redécouvrez l'architecture sous un nouveau jour.</p>
            </div>
            <div class="activity-card">
                <div class="image-placeholder">
                    [Photo atelier créatif]
                </div>
                <h3>Atelier cyanotype - Jardin des plantes</h3>
                <p class="activity-date">12 juin 2025</p>
                <p>Initiez-vous à cette technique photographique ancienne qui utilise la lumière solaire pour créer des impressions bleues à partir d'éléments naturels.</p>
            </div>
        </div>
        <div style="text-align: center; margin-top: 30px;">
             <a href="activites.php" class="btn">Voir toutes les activités</a>
        </div>
    </section>

    <section class="container" id="podcasts">
        <h2>Nos podcasts</h2>
        <div class="podcast-container">
            <div class="podcast-card">
                <div class="image-placeholder">
                    [Cover podcast - Culture & Urbanisme]
                </div>
                <h3>Épisode 8 : L'art dans l'espace public</h3>
                <p>"Le street art n'est pas seulement une forme d'expression visuelle, c'est une révolution culturelle qui démocratise l'art et transforme nos villes en musées à ciel ouvert."</p>
                <a href="#" class="btn">Écouter sur YouTube</a>
            </div>
            <div class="podcast-card">
                <div class="image-placeholder">
                    [Cover podcast - Patrimoine vivant]
                </div>
                <h3>Épisode 7 : Jardins historiques, espaces d'avenir</h3>
                <p>"Ces espaces verts centenaires ne sont pas des vestiges figés, mais des laboratoires vivants où s'inventent de nouvelles relations entre l'humain et la nature."</p>
                <a href="#" class="btn">Écouter sur YouTube</a>
            </div>
        </div>
    </section>

    <section class="container" id="community">
        <h2>Rejoignez notre communauté</h2>
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); align-items: center;">
            <div>
                <p>Devenez membre de Flow Media et accédez à une expérience culturelle enrichie, personnalisée et avantageuse.</p>
                <ul>
                    <li><strong>Contenus exclusifs</strong> - Accédez à des activités premium et des podcasts en avant-première</li>
                    <li><strong>Avantages culture</strong> - Bénéficiez de codes promo pour les musées, théâtres et événements culturels partenaires</li>
                    <li><strong>Expérience personnalisée</strong> - Recevez des recommandations adaptées à vos centres d'intérêt culturels</li>
                    <li><strong>Réseau culturel</strong> - Échangez avec d'autres passionnés et élargissez vos horizons</li>
                </ul>
            </div>
            <div style="text-align: center;">
                 <a href="inscription.php" class="btn btn-large">Créer un compte gratuitement</a>
            </div>
        </div>
    </section>

    <section class="container" id="testimonials">
        <h2>Ils ont participé</h2>
        <div class="testimonials">
            <div class="testimonial">
                <p>"La visite nocturne des monuments illuminés a complètement changé ma vision de l'architecture de ma propre ville. Je ne regarderai plus jamais ces bâtiments de la même façon."</p>
                <p class="testimonial-author"><b>Léa, 19 ans, Lyon</b></p>
            </div>
            <div class="testimonial">
                <p>"L'atelier de cyanotype dans le jardin botanique était à la fois un moment de connexion avec la nature et une découverte technique fascinante. Je ne pensais pas que le patrimoine pouvait être aussi vivant et inspirant."</p>
                <p class="testimonial-author"><b>Maxime, 22 ans, Bordeaux</b></p>
            </div>
            <div class="testimonial">
                <p>"Grâce aux podcasts de Flow Media, j'ai découvert des aspects de la culture urbaine que je côtoyais tous les jours sans les remarquer. J'ai maintenant un regard beaucoup plus attentif sur mon environnement."</p>
                <p class="testimonial-author"><b>Chloé, 17 ans, Nantes</b></p>
            </div>
        </div>
    </section>

    <section class="container" id="partners">
        <h2>Nos partenaires</h2>
        <div class="partners">
            <div class="partner-logo">Association des Maires de France</div>
            <div class="partner-logo">Ministère de la Culture</div>
            <div class="partner-logo">Musée d'Art Moderne</div>
            <div class="partner-logo">Office du Tourisme</div>
            <div class="partner-logo">Centre des Monuments Nationaux</div>
        </div>
    </section>

    <footer class="container">
        <div>
            <p>© 2025 Flow Media. Tous droits réservés.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
        <div>
            <div class="footer-links">
                <a href="#">Politique de confidentialité</a>
                <a href="#">Cookies</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>
    </footer>

    <script>
        // Simple script for smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>