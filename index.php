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
    <link rel="icon" href="/assets/icons/icon-test.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style/home.css">
    <style>
    </style>
</head>

<?php require_once 'loader/loader.php'; ?>

<body>
    <div id="body">
        <?php include './includes/layout/navbar-special.php'; ?>

        <nav id="section-nav">
            <ul>
                <li><a href="#hero" data-section="0"><span>Accueil</span></a></li>
                <li><a href="#architecture" data-section="1"><span>Architecture</span></a></li>
                <li><a href="#patrimoine" data-section="2"><span>Patrimoine</span></a></li>
                <li><a href="#jardins" data-section="3"><span>Jardins</span></a></li>
                <li><a href="#events" data-section="4"><span>Événements</span></a></li>
                <li><a href="#testimonials" data-section="5"><span>Témoignages</span></a></li>
                <li><a href="#newsletter" data-section="6"><span>Newsletter</span></a></li>
            </ul>
        </nav>

        <div id="fullpage">
            <div class="section" id="hero">
                <section class="hero" id="hero">
                    <img src="https://i.familiscope.fr/1400x787/smart/2023/05/16/parc-chateau-de-versailles.jpg" alt="Hero Background" class="hero-bg">
                    <div class="hero-content">
                        <h1 class="hero-title">Découvre ta culture</h1>
                        <p class="hero-subtitle">Explore l'art, l'architecture et l'histoire sous un nouveau regard. La culture française comme tu ne l'as jamais vue.</p>
                        <div class="hero-cta">
                            <a href="/connexion/register.php" class="btn btn-primary">Rejoins le mouvement</a>
                            <a href="#categories" class="btn btn-secondary">Explorer</a>
                        </div>
                    </div>
                    <a href="#architecture" class="theme-arrow">
                        <svg viewBox="0 0 24 24">
                            <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
                        </svg>
                    </a>
                </section>
            </div>

            <div class="section" id="architecture">
                <section class="theme-section">
                    <img src="https://www.district-immo.com/wp-content/uploads/2023/04/Immeuble-haussmannien-shutterstock.png" alt="Architecture" class="theme-bg">
                    <div class="theme-overlay"></div>
                    <div class="theme-elements architecture-elements"></div>
                    <div class="theme-content" data-aos="fade-right">
                        <h2 class="theme-title">Architecture</h2>
                        <p class="theme-desc">De Notre-Dame aux buildings contemporains, l'architecture raconte notre histoire. Chaque bâtiment a son propre style et sa propre histoire à raconter. Découvre comment ces structures façonnent nos villes et nos vies.</p>
                        <a href="/pages/architecture.php" class="btn btn-primary">Explore l'architecture</a>
                    </div>
                    <a href="#patrimoine" class="theme-arrow">
                        <svg viewBox="0 0 24 24">
                            <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
                        </svg>
                    </a>
                </section>
            </div>

            <div class="section" id="patrimoine">
                <section class="theme-section">
                    <img src="https://images.unsplash.com/photo-1549877452-9c387954fbc2" alt="Patrimoine" class="theme-bg">
                    <div class="theme-overlay"></div>
                    <div class="theme-elements patrimoine-elements"></div>
                    <div class="theme-content" data-aos="fade-right">
                        <h2 class="theme-title">Patrimoine</h2>
                        <p class="theme-desc">Plonge dans l'histoire vivante de la France. Des châteaux médiévaux aux traditions locales, notre patrimoine est la base de notre identité. Comprends comment le passé influence notre présent et inspire notre futur.</p>
                        <a href="/pages/patrimoine.php" class="btn btn-primary">Découvre notre patrimoine</a>
                    </div>
                    <a href="#jardins" class="theme-arrow">
                        <svg viewBox="0 0 24 24">
                            <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
                        </svg>
                    </a>
                </section>
            </div>

            <div class="section" id="jardins">
                <section class="theme-section">
                    <img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae" alt="Jardins" class="theme-bg">
                    <div class="theme-overlay"></div>
                    <div class="theme-elements jardins-elements"></div>
                    <div class="theme-content" data-aos="fade-right">
                        <h2 class="theme-title">Jardins</h2>
                        <p class="theme-desc">Des jardins à la française aux parcs urbains modernes, explore ces espaces verts qui sont de véritables œuvres d'art vivantes. Découvre comment ils combinent esthétique, histoire et biodiversité dans un équilibre parfait.</p>
                        <a href="/pages/jardins.php" class="btn btn-primary">Visite les jardins</a>
                    </div>
                    <a href="#events" class="theme-arrow">
                        <svg viewBox="0 0 24 24">
                            <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
                        </svg>
                    </a>
                </section>
            </div>
        </div>

        <!-- Events Section -->
        <div class="events" id="events">
            <div class="container">
                <div class="events-header" data-aos="fade-up">
                    <h2 class="events-title">À ne pas manquer</h2>
                    <p class="events-subtext">Des événements uniques pour vivre la culture autrement. Rencontres, ateliers et expériences immersives t'attendent.</p>
                </div>
                <div class="events-grid">
                    <div class="event-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="event-img">
                            <img src="https://images.unsplash.com/photo-1529088148495-2d9f231db829" alt="Urban Art Tour">
                            <div class="event-date">28 Mai</div>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">Urban Art Tour</h3>
                            <div class="event-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Paris, 11ème
                            </div>
                            <p class="event-desc">Visite guidée du street art parisien. Découvre les artistes locaux qui transforment la ville en galerie à ciel ouvert.</p>
                            <a href="/evenements/urban-art-tour.php" class="btn-outline">En savoir +</a>
                        </div>
                    </div>
                    <div class="event-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="event-img">
                            <img src="https://images.unsplash.com/photo-1513311068348-19c8fbdc0bb6" alt="Atelier d'architecture">
                            <div class="event-date">12 Juin</div>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">Atelier d'architecture</h3>
                            <div class="event-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Lyon, Centre
                            </div>
                            <p class="event-desc">Construis ta vision de la ville de demain avec des architectes pros. Workshop créatif ouvert à tous.</p>
                            <a href="/evenements/atelier-architecture.php" class="btn-outline">En savoir +</a>
                        </div>
                    </div>
                    <div class="event-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="event-img">
                            <img src="https://images.unsplash.com/photo-1547825407-2d060104b7f8" alt="Nuit des jardins">
                            <div class="event-date">20 Juin</div>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">Nuit des jardins</h3>
                            <div class="event-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Bordeaux
                            </div>
                            <p class="event-desc">Visite nocturne des plus beaux jardins avec installations lumineuses et performances artistiques.</p>
                            <a href="/evenements/nuit-jardins.php" class="btn-outline">En savoir +</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="testimonials" id="testimonials">
            <div class="container">
                <div class="testimonials-header" data-aos="fade-up">
                    <h2 class="testimonials-title">Ils l'ont vécu</h2>
                </div>
                <div class="testimonials-container" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-slider">
                        <div class="testimonial-track">
                            <div class="testimonial">
                                <p class="testimonial-text">Je n'aurais jamais pensé que l'architecture pouvait être aussi fascinante. Les visites nocturnes ont complètement changé ma façon de voir ma propre ville.</p>
                                <p class="testimonial-author">Léa, 19 ans</p>
                                <p class="testimonial-role">Étudiante, Lyon</p>
                            </div>
                            <div class="testimonial">
                                <p class="testimonial-text">L'atelier street art m'a fait découvrir une nouvelle passion. Maintenant je regarde chaque mur différemment et je commence même à créer mes propres designs.</p>
                                <p class="testimonial-author">Thomas, 17 ans</p>
                                <p class="testimonial-role">Lycéen, Marseille</p>
                            </div>
                            <div class="testimonial">
                                <p class="testimonial-text">Les podcasts de Flow Media m'accompagnent partout. J'adore apprendre sur notre patrimoine local tout en me déplaçant. C'est comme avoir un guide personnel!</p>
                                <p class="testimonial-author">Chloé, 22 ans</p>
                                <p class="testimonial-role">Apprentie, Nantes</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-dots">
                        <div class="dot active"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Section -->
        <div class="newsletter" id="newsletter">
            <div class="container">
                <div class="newsletter-content" data-aos="fade-up">
                    <h2 class="newsletter-title">Reste connecté</h2>
                    <p class="newsletter-text">Reçois nos bons plans, invitations exclusives et contenus inédits directement dans ta boîte mail.</p>
                    <form class="newsletter-form" action="/includes/newsletter.php" method="POST">
                        <input type="email" name="email" placeholder="Ton email" required class="newsletter-input">
                        <button type="submit" class="newsletter-btn">S'abonner</button>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'includes/layout/footer.php' ?>


    </div>
</body>

</html>