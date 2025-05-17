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
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
            background: #fff;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .hero {
            text-align: center;
            padding: 30px 0;
            border-bottom: 1px solid #000;
            background-image: url('https://musees-nationaux-alpesmaritimes.fr/chagall/sites/chagall/files/styles/w1920_extra_wide/public/2023-09/Atelier_duBeau_texture_%C3%A9tudiants_1920x960px.jpg?itok=ViyGvrM4');
            background-size: cover;
            background-position: center;
            color: #fff;
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
        }
        .cursive-text {
            font-family: "Cookie", cursive;
            font-weight: 400;
            font-style: normal;
            font-size: 10rem;
            margin-bottom: 10px;
        }
        .hero-content p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        .hero-cta-text {
            font-size: 2.5rem;
            font-weight: 700;
            margin-top: 40px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px; /* Decreased padding */
            background: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            margin-top: 20px;
            transition: all 0.3s ease;
            margin-right: 10px;
        }
        .btn:last-child {
             margin-right: 0;
        }
        .btn:hover {
            background: #333;
            transform: translateY(-2px);
        }
        .btn-large {
            padding: 12px 24px; /* Decreased padding */
            font-size: 1rem; /* Decreased font size */
            font-weight: 700;
        }
        .btn-white {
            background: #fff;
            color: #000;
            border: 1px solid #000; /* Added border for visibility */
        }
        .btn-white:hover {
            background: #eee; /* Lighter hover effect for white button */
            color: #000;
            transform: translateY(-2px);
        }

        section {
            padding: 60px 0;
            border-bottom: 1px solid #000;
        }
        section h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
        .card {
            border: 1px solid #000;
            padding: 20px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .card h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        .card p {
            flex-grow: 1;
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
        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .activity-card {
            border: 1px solid #000;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }
        .activity-card h3 {
             margin-top: 0;
             margin-bottom: 5px;
             font-size: 1.3rem;
        }
        .activity-date {
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
            font-size: 1rem;
        }
        .activity-card p {
            flex-grow: 1;
        }
        .podcast-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .podcast-card {
            border: 1px solid #000;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .podcast-card h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        .podcast-card p {
            font-style: italic;
            margin-bottom: 20px;
            flex-grow: 1;
        }
        .testimonials {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin: 30px 0;
        }
        .testimonial {
            padding: 20px;
            border: 1px solid #000;
            font-style: italic;
            display: flex;
            flex-direction: column;
        }
        .testimonial p:first-of-type {
            flex-grow: 1;
        }
        .testimonial-author {
            font-weight: bold;
            font-style: normal;
            margin-top: 10px;
            text-align: right;
        }
        .partners {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin: 30px 0;
        }
        .partner-logo {
            max-width: 150px;
            height: 80px;
            background: #f0f0f0;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            font-size: 0.9rem;
            text-align: center;
        }
        footer {
            padding: 40px 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: center;
        }
        footer > div:last-child {
            text-align: right;
        }
        .footer-links {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }
        .footer-links a {
            color: #000;
            text-decoration: none;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }
        .social-icons a {
            color: #000;
            font-size: 1.5rem;
        }

        .nav-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: #000;
            color: #fff;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .nav-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 60px;
            height: 100vh;
            background: #f0f0f0;
            z-index: 100;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 100px;
            display: none;
        }
        .nav-sidebar a {
            margin: 15px 0;
            color: #000;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        .nav-sidebar a:hover {
            transform: scale(1.2);
        }
        .nav-fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            z-index: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s ease;
        }
        .nav-fullscreen.active {
            opacity: 1;
            visibility: visible;
        }
        .nav-fullscreen-content {
            text-align: left;
        }
        .nav-fullscreen-content a {
            display: block;
            color: #fff;
            font-size: 2rem;
            margin: 20px 0;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .nav-fullscreen-content a:hover {
            transform: translateX(10px);
            color: #ccc;
        }
        .close-nav {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            .hero-content p {
                font-size: 1.2rem;
            }
            .hero-cta-text {
                font-size: 1.8rem;
            }
            section h2 {
                font-size: 2rem;
            }
            footer {
                grid-template-columns: 1fr;
                text-align: center;
            }
            footer > div:last-child {
                text-align: center;
                margin-top: 20px;
            }
            .footer-links {
                justify-content: center;
            }
            .social-icons {
                 justify-content: center;
            }
            /* Adjust button spacing on small screens */
            .hero-content .btn {
                margin-right: 0;
                margin-bottom: 10px;
                display: block; /* Stack buttons vertically */
            }
        }
    </style>
</head>
<body>
    <button class="nav-toggle" id="navToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="nav-fullscreen" id="navFullscreen">
        <div class="nav-fullscreen-content">
            <a href="#>Accueil</a>
            <a href="/pages/about">Qui sommes-nous</a>
            <a href="/pages/domaines-culturels">Nos domaines culturels</a>
            <a href="/pages/activites">Activités à venir</a>
            <a href="/pages/podcast">Nos podcasts</a>
            <a href="/pages/avis">Témoignages</a>
            <a href="/pages/partenaires">Nos partenaires</a>
            <a href="/pages/contact">Contact</a>
            <a href="/connexion/login.php">Me connecter</a>
        </div>
    </div>

    <header class="hero" id="accueil">
        <div class="hero-content container">
            <h1 class="cursive-text">Flow Media</h1>
            <p>Cultivez votre curiosité, explorez votre culture</p>
            <div class="hero-cta-text">Prêt à explorer la culture autrement ?</div>
            <!-- Applied btn-large to both buttons and btn-white to the second one -->
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
                    [Photo d'architecture contemporaine]
                </div>
                <h3>Architecture</h3>
                <p>Découvrez l'impact culturel et visuel de l'architecture qui façonne nos villes. Des bâtiments emblématiques aux structures innovantes, explorez les espaces qui racontent notre société et son évolution.</p>
            </div>
            <div class="card">
                <div class="image-placeholder">
                    [Photo de lieu patrimonial]
                </div>
                <h3>Patrimoine</h3>
                <p>Plongez dans l'histoire vivante de votre région à travers ses monuments, traditions et savoir-faire. Le patrimoine n'est pas figé dans le passé, il dialogue constamment avec notre présent et inspire notre futur.</p>
            </div>
            <div class="card">
                <div class="image-placeholder">
                    [Photo de jardin public ou espace naturel]
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
                <p class="testimonial-author">Léa, 19 ans, Lyon</p>
            </div>
            <div class="testimonial">
                <p>"L'atelier de cyanotype dans le jardin botanique était à la fois un moment de connexion avec la nature et une découverte technique fascinante. Je ne pensais pas que le patrimoine pouvait être aussi vivant et inspirant."</p>
                <p class="testimonial-author">Maxime, 22 ans, Bordeaux</p>
            </div>
            <div class="testimonial">
                <p>"Grâce aux podcasts de Flow Media, j'ai découvert des aspects de la culture urbaine que je côtoyais tous les jours sans les remarquer. J'ai maintenant un regard beaucoup plus attentif sur mon environnement."</p>
                <p class="testimonial-author">Chloé, 17 ans, Nantes</p>
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
        const navToggle = document.getElementById('navToggle');
        const navFullscreen = document.getElementById('navFullscreen');

        // Toggle the 'active' class on navFullscreen when navToggle is clicked
        navToggle.addEventListener('click', () => {
            navFullscreen.classList.toggle('active');
        });

        // Close the fullscreen nav when a link inside it is clicked
        document.querySelectorAll('.nav-fullscreen-content a').forEach(link => {
            link.addEventListener('click', () => {
                navFullscreen.classList.remove('active');
            });
        });
    </script>
</body>
</html>