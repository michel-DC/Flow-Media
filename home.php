<?php
require_once 'includes/auth.php';
$link = mysqli_connect("localhost", "micheldjoumessi_pair-prog", "michelchrist", "micheldjoumessi_pair-prog");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Explorez la culture autrement</title>
    <link rel="shortcut icon" href="/assets/icons/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style/index.css">

    <!-- gestion des cookies avec -> tarte au citrons (citron js) -->
    <script src="/node_modules/tarteaucitronjs/tarteaucitron.min.js"></script>

    <script type="text/javascript">
        tarteaucitron.init({
            "privacyUrl": "/legal/politique-confidentialite.php",
            "bodyPosition": "top",
            "hashtag": "#tarteaucitron",
            "cookieName": "tarteaucitron",
            "orientation": "popup",
            "groupServices": true,
            "showDetailsOnClick": true,
            "serviceDefaultState": "wait",
            "showAlertSmall": false,
            "cookieslist": false,
            "closePopup": true,
            "showIcon": false,
            "iconPosition": "bottom",
            "adblocker": false,
            "DenyAllCta": true,
            "AcceptAllCta": true,
            "highPrivacy": true,
            "handleBrowserDNTRequest": false,
            "removeCredit": false,
            "moreInfoLink": true,
            "useExternalCss": false,
            "useExternalJs": false,
            "mandatory": true,
            "mandatoryCta": false,
            "googleConsentMode": true,
            "bingConsentMode": true,
            "softConsentMode": false,
            "dataLayer": false,
            "serverSide": false,
            "partnersList": true,
            "cookiesDuration": 365,
            "cookieDomain": window.location.hostname,
            "popupPosition": "bottom",
            "popupBackground": "#fff",
            "popupTextColor": "#000",
            "popupLinkColor": "#000",
            "popupButtonBackground": "#000",
            "popupButtonTextColor": "#fff",
            "popupButtonHoverBackground": "#333",
            "popupButtonHoverTextColor": "#fff"
        });

        tarteaucitron.user.gtagUa = 'G-XXXXXXXXXX';
        tarteaucitron.user.gtagMore = function() {
            tarteaucitron.addService('gtag');
        };
        (tarteaucitron.job = tarteaucitron.job || []).push('gtag');
    </script>
</head>

<body>
    <!-- Background Decorations -->
    <div class="bg-decoration">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>

    <div id="body">
        <div class="container">

            <!-- Header Navigation -->
            <?php include 'includes/layout/navbar-rc.php'; ?>

            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">
                            <span class="gradient-text">Explorez la culture</span>
                            <span class="hero-subtitle">autrement</span>
                        </h1>
                        <p class="hero-description">
                            Découvrez les trésors cachés de votre ville à travers l'architecture et les jardins.
                            Une aventure culturelle unique vous attend !
                        </p>
                        <div class="hero-buttons">
                            <a href="/connexion/register.php" class="btn btn-primary">
                                <i class="fas fa-rocket"></i>
                                Commencer l'aventure
                            </a>
                            <a href="/pages/activites/" class="btn btn-secondary">
                                <i class="fas fa-compass"></i>
                                Découvrir
                            </a>
                        </div>
                    </div>
                    <div class="hero-visual">
                        <div class="hero-mascots">
                            <div class="mascot mascot-jardy">
                                <img src="assets/images/vert.png" alt="Jardi">
                                <div class="mascot-bubble">
                                    <p>Salut ! Je suis <strong>Jardi</strong> 🌿</p>
                                </div>
                            </div>
                            <div class="mascot mascot-archy">
                                <img src="assets/images/rouge.png" alt="Archy">
                                <div class="mascot-bubble">
                                    <p>Hey ! Je suis <strong>Archy</strong> 🏛️</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="features-section">
                <div class="section-header">
                    <h2 class="section-title">Nos Spécialités</h2>
                    <p class="section-subtitle">Deux univers passionnants à explorer</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card architecture-card">
                        <div class="feature-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Architecture</h3>
                            <p>L'art et la technique de concevoir des bâtiments qui racontent l'histoire de nos villes</p>
                            <div class="feature-stats">
                                <span class="stat">500+ monuments</span>
                                <span class="stat">25 villes</span>
                            </div>
                        </div>
                    </div>
                    <div class="feature-card gardens-card">
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Jardins</h3>
                            <p>Des espaces verts exceptionnels où la nature rencontre l'art du paysage</p>
                            <div class="feature-stats">
                                <span class="stat">200+ jardins</span>
                                <span class="stat">15 régions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Discovery Section -->
            <section class="discovery-section">
                <div class="section-header">
                    <h2 class="section-title">Les Lieux Incontournables</h2>
                    <p class="section-subtitle">Sélectionnés par notre communauté</p>
                </div>
                <div class="discovery-carousel">
                    <div class="carousel-container">
                        <button class="carousel-nav prev" data-direction="prev">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="carousel-track">
                            <div class="discovery-card active">
                                <div class="card-image">
                                    <img src="/assets/images/1.png" alt="Architecture">
                                    <div class="card-overlay">
                                        <div class="card-category">Architecture</div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h3>Trésors Architecturaux</h3>
                                    <p>Explorez les joyaux qui ont façonné notre patrimoine</p>
                                    <a href="/pages/activites/" class="card-link">
                                        Découvrir <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="discovery-card">
                                <div class="card-image">
                                    <img src="/assets/images/2.png" alt="Patrimoine">
                                    <div class="card-overlay">
                                        <div class="card-category">Histoire</div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h3>Patrimoine Historique</h3>
                                    <p>Des histoires insolites au coin de votre rue</p>
                                    <a href="/pages/activites/" class="card-link">
                                        Découvrir <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="discovery-card">
                                <div class="card-image">
                                    <img src="/assets/images/3.png" alt="Jardins">
                                    <div class="card-overlay">
                                        <div class="card-category">Jardins</div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h3>Jardins Remarquables</h3>
                                    <p>Les plus beaux jardins français et leurs secrets</p>
                                    <a href="/pages/activites/" class="card-link">
                                        Découvrir <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-nav next" data-direction="next">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="carousel-indicators">
                        <button class="indicator active" data-slide="0"></button>
                        <button class="indicator" data-slide="1"></button>
                        <button class="indicator" data-slide="2"></button>
                    </div>
                </div>
            </section>

            <!-- Nearby Places Section -->
            <section class="nearby-section">
                <div class="section-header">
                    <h2 class="section-title">Près de Chez Vous</h2>
                    <a href="/pages/maps/" class="geolocation-btn">
                        <i class="fas fa-location-dot"></i>
                        Me géolocaliser
                    </a>
                </div>
                <div class="nearby-grid">
                    <div class="nearby-card featured">
                        <div class="card-image">
                            <img src="https://domaine-de-sceaux.hauts-de-seine.fr/fileadmin/_processed_/6/3/csm_chateauWilly_6e1650a2ea.jpg" alt="Château de Sceaux">
                            <button class="favorite-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-info">
                            <h3>Château de Sceaux</h3>
                            <div class="rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="rating-text">5.0</span>
                            </div>
                            <p class="location">92330, Sceaux</p>
                            <a href="/pages/maps" class="btn btn-outline">En savoir plus</a>
                        </div>
                    </div>
                    <div class="nearby-card">
                        <div class="card-image">
                            <img src="https://offloadmedia.feverup.com/parissecret.com/wp-content/uploads/2021/04/17054435/shutterstock_455256892-1-scaled.jpg" alt="Jardin Albert Khan">
                            <button class="favorite-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-info">
                            <h3>Jardin Albert Khan</h3>
                            <p class="location">Boulogne-Billancourt</p>
                        </div>
                    </div>
                    <div class="nearby-card">
                        <div class="card-image">
                            <img src="https://www.hauts-de-seine.fr/fileadmin/_processed_/3/f/csm_saintcloud1_1005999dec.jpg" alt="Domaine de St Cloud">
                            <button class="favorite-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-info">
                            <h3>Domaine de St Cloud</h3>
                            <p class="location">Saint-Cloud</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Fun Facts Section -->
            <section class="fun-facts-section">
                <div class="section-header">
                    <h2 class="section-title">Le Saviez-Vous ?</h2>
                    <p class="section-subtitle">Des anecdotes fascinantes sur notre patrimoine</p>
                </div>
                <div class="fun-facts-grid">
                    <div class="fact-card" data-fact="0">
                        <div class="fact-image">
                            <img src="https://q-xx.bstatic.com/xdata/images/landmark/608x352/275344.webp?k=fe69f9d21286dc64e62d67386eedac822585742d8f177300060292e8365e6ea4&o=" alt="Cathédrale de Strasbourg">
                        </div>
                        <div class="fact-content">
                            <h3>Cathédrale de Strasbourg</h3>
                            <p>Sa flèche gothique culmine à 142 mètres, et son horloge astronomique date de la Renaissance.</p>
                            <a href="/pages/fun-fact/" class="fact-link">En savoir plus</a>
                        </div>
                    </div>
                    <div class="fact-card" data-fact="1">
                        <div class="fact-image">
                            <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0a/d2/95/f7/photo5jpg.jpg?w=800&h=500&s=1" alt="Grande Mosquée de Paris">
                        </div>
                        <div class="fact-content">
                            <h3>Grande Mosquée de Paris</h3>
                            <p>Construite en 1926, c'est la plus ancienne mosquée de France métropolitaine.</p>
                            <a href="/pages/fun-fact/" class="fact-link">En savoir plus</a>
                        </div>
                    </div>
                    <div class="fact-card" data-fact="2">
                        <div class="fact-image">
                            <img src="https://api.centrepompidou-metz.fr/assets/q70-w1200/b16448a2/architecture_c_jacqueline_trichard_21_centre_pompidou_metz_29072020_2147.jpg" alt="Centre Pompidou Metz">
                        </div>
                        <div class="fact-content">
                            <h3>Centre Pompidou Metz</h3>
                            <p>Son toit inspiré d'un panama couvre 8000m² sans aucun pilier central.</p>
                            <a href="/pages/fun-fact/" class="fact-link">En savoir plus</a>
                        </div>
                    </div>
                    <div class="fact-card" data-fact="3">
                        <div class="fact-image">
                            <img src="https://woody.cloudly.space/app/uploads/porte-dromardeche/2021/07/thumbs/palais00-1920x960-crop-1642494192.jpg" alt="Palais Idéal">
                        </div>
                        <div class="fact-content">
                            <h3>Palais Idéal du Facteur Cheval</h3>
                            <p>33 ans de construction par un seul homme, pierre par pierre, durant sa tournée de facteur.</p>
                            <a href="/pages/fun-fact/" class="fact-link">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonials Section -->
            <section class="testimonials-section">
                <div class="section-header">
                    <h2 class="section-title">Ils Nous Font Confiance</h2>
                    <p class="section-subtitle">L'avis de notre communauté</p>
                </div>
                <div class="testimonials-slider">
                    <div class="testimonials-track">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p>"Une expérience incroyable ! J'ai découvert des lieux magnifiques que je ne connaissais pas dans ma propre ville."</p>
                                <div class="testimonial-author">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Marie L.">
                                    <div class="author-info">
                                        <h4>Marie L.</h4>
                                        <span>Paris</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p>"Les défis sont vraiment amusants et m'ont permis d'en apprendre beaucoup sur l'architecture de ma ville."</p>
                                <div class="testimonial-author">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Thomas D.">
                                    <div class="author-info">
                                        <h4>Thomas D.</h4>
                                        <span>Lyon</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p>"Une application qui rend la découverte culturelle accessible et ludique. Je recommande !"</p>
                                <div class="testimonial-author">
                                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Sophie M.">
                                    <div class="author-info">
                                        <h4>Sophie M.</h4>
                                        <span>Bordeaux</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Partners Section -->
            <section class="partners-section">
                <div class="section-header">
                    <h2 class="section-title">Nos Partenaires</h2>
                    <p class="section-subtitle">Ils nous font confiance</p>
                </div>
                <div class="partners-carousel">
                    <div class="partners-track">
                        <div class="partner-logo">
                            <img src="https://aufildudedale.fr/storage/2024/02/logo-pass-culture-1-png-16162.png" alt="Pass Culture">
                        </div>
                        <div class="partner-logo">
                            <img src="https://image.over-blog.com/lWzrS-cab4LuWDJkxy_Dvxh62Ks=/filters:no_upscale()/image%2F6834552%2F20220421%2Fob_8b255d_81-5fc6581a822f9-orig-1.png" alt="Ministère de la Culture">
                        </div>
                        <div class="partner-logo">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f5/Logo-amf-bas.png" alt="AMF">
                        </div>
                        <div class="partner-logo">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvt-rUaFQJuiskfXDgYZ08Nf-yBTSHMXodIg&s" alt="Région Île-de-France">
                        </div>
                        <div class="partner-logo">
                            <img src="https://www.arte.tv/sites/corporate/files/arte-logo_1920x1080-6-470x270.jpg" alt="Arte">
                        </div>
                        <div class="partner-logo">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQICLj-Kd5YYTgiSCAQFy9L6Wds2OUjWv8taQ&s" alt="Région Aquitaine">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Newsletter Section -->
            <section class="newsletter-section">
                <div class="newsletter-container">
                    <div class="newsletter-content">
                        <div class="newsletter-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Restez Informé</h3>
                        <p>Recevez nos dernières découvertes et actualités culturelles</p>
                        <form method="POST" action="" class="newsletter-form">
                            <div class="form-group">
                                <input type="email" name="newsletter_email" placeholder="Votre adresse email" required>
                                <button type="submit" name="newsletter_submit">
                                    <i class="fas fa-paper-plane"></i>
                                    S'abonner
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <?php include 'includes/layout/footer.php'; ?>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script>
        // Carousel Discovery Section
        const carouselTrack = document.querySelector('.carousel-track');
        const carouselCards = document.querySelectorAll('.discovery-card');
        const prevBtn = document.querySelector('.carousel-nav.prev');
        const nextBtn = document.querySelector('.carousel-nav.next');
        const indicators = document.querySelectorAll('.indicator');
        let currentSlide = 0;

        function updateCarousel() {
            carouselCards.forEach((card, index) => {
                card.classList.toggle('active', index === currentSlide);
            });
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
            });
        }

        nextBtn.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % carouselCards.length;
            updateCarousel();
        });

        prevBtn.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + carouselCards.length) % carouselCards.length;
            updateCarousel();
        });

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentSlide = index;
                updateCarousel();
            });
        });

        // Auto-rotate carousel
        setInterval(() => {
            currentSlide = (currentSlide + 1) % carouselCards.length;
            updateCarousel();
        }, 5000);

        // Favorite buttons
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                icon.classList.toggle('far');
                icon.classList.toggle('fas');
                this.classList.toggle('active');
            });
        });

        // Scroll to top
        const scrollToTopBtn = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Floating animations
        function animateFloatingShapes() {
            const shapes = document.querySelectorAll('.floating-shape');
            shapes.forEach((shape, index) => {
                const delay = index * 2000;
                setTimeout(() => {
                    shape.style.animation = `float ${4 + index}s ease-in-out infinite`;
                }, delay);
            });
        }

        // Initialize animations
        document.addEventListener('DOMContentLoaded', () => {
            animateFloatingShapes();
        });

        // Testimonials auto-scroll
        let testimonialIndex = 0;
        const testimonialTrack = document.querySelector('.testimonials-track');
        const testimonialCards = document.querySelectorAll('.testimonial-card');

        function rotateTestimonials() {
            testimonialIndex = (testimonialIndex + 1) % testimonialCards.length;
            testimonialTrack.style.transform = `translateX(-${testimonialIndex * 100}%)`;
        }

        setInterval(rotateTestimonials, 4000);

        // Mascot bubble animations
        setTimeout(() => {
            document.querySelectorAll('.mascot-bubble').forEach((bubble, index) => {
                setTimeout(() => {
                    bubble.classList.add('show');
                }, index * 500);
            });
        }, 1000);
    </script>

    <?php
    if (isset($_POST['newsletter_submit'])) {
        $email = filter_var($_POST['newsletter_email'], FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $success = "Merci pour votre inscription à la newsletter !";
        } else {
            $error = "Veuillez entrer une adresse email valide.";
        }
    }

    if (isset($error)):
        echo "<div class='message error'>$error</div>";
    endif;

    if (isset($success)):
        echo "<div class='message success'>$success</div>";
    endif;

    if (isset($_GET['erreur']) && $_GET['erreur'] === 'deja_connecte_user') {
        echo "<div class='message error'>Vous êtes déja connecté, rendez-vous sur la page de reservation !</div>";
    }
    ?>
</body>

</html>