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
    <link rel="stylesheet" href="/assets/style/index.css">
</head>

<?php require_once 'loader/loader.php'; ?>

<body>
    <div id="body">
        <script>
            // Animation des pétales
            function createPetal() {
                const petal = document.createElement('div');
                petal.className = 'petal';

                const size = Math.random() * 10 + 5;
                const startPosition = Math.random() * window.innerWidth;
                const fallDistance = Math.random() * 100 - 50;
                const duration = Math.random() * 4 + 4;

                petal.style.cssText = `
                    left: ${startPosition}px;
                    width: ${size}px;
                    height: ${size}px;
                    background: white;
                    border-radius: 150% 0 150% 0;
                    --fall-distance: ${fallDistance}px;
                    animation-duration: ${duration}s;
                `;

                document.body.appendChild(petal);

                setTimeout(() => {
                    petal.remove();
                }, duration * 1000);
            }

            setTimeout(() => {
                const petalInterval = setInterval(createPetal, 100);
                setTimeout(() => {
                    clearInterval(petalInterval);
                }, 60000);
            }, 1000);
        </script>

        <div class="container">

            <!-- Header Navigation -->
            <?php include 'includes/layout/navbar-rc.php'; ?>

            <!-- Contenu principal -->
            <main class="main-content">
                <div class="hero-section">
                    <h1 class="main-title">Ce que tu cherches est tout près, sauras-tu le trouver ?</h1>

                    <div class="action-buttons">
                        <button class="btn btn-primary">Créer un compte gratuitement</button>
                        <button class="btn btn-secondary">Découvrir les activités</button>
                    </div>
                </div>
            </main>

            <!-- Mascotte gauche -->
            <div class="mascotte mascotte-left">
                <div class="message-bubble">Hey ! Je suis <b>Jardi</b>, je vais t'aider à découvrir les <b>jardins</b> !</div>
                <img src="assets/images/vert.png" alt="Mascotte">
            </div>

            <!-- Mascotte droite -->
            <div class="mascotte mascotte-right">
                <div class="message-bubble">Salut ! Je suis <b>Archi</b>, je vais te guider dans <b>l'architecture</b> !</div>
                <img src="assets/images/rouge.png" alt="Mascotte">
            </div>

            <!-- Sections informatives -->
            <section class="info-sections">
                <div class="info-card architecture-card">
                    <div class="card-icon architecture-icon">
                        <div class="icon-bars">
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">L'ARCHITECTURE</h3>
                        <p class="card-description">
                            L'architecture, c'est l'art et la technique de concevoir et construire des bâtiments et des espaces pour qu'ils soient utiles, beaux et adaptés à la vie des gens.
                        </p>
                    </div>
                </div>

                <div class="info-card gardens-card">
                    <div class="card-icon gardens-icon">
                        <div class="icon-circles">
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">LES JARDINS</h3>
                        <p class="card-description">
                            L'architecture, c'est l'art et la technique de concevoir et construire des bâtiments et des espaces pour qu'ils soient utiles,
                        </p>
                    </div>
                </div>
            </section>


            <!-- Section Découvrir -->
            <section class="discover-section">
                <div class="discover-section-container">
                    <div class="best-places-header">
                        <h2 class="best-places-title">LES MEILLEURS LIEUX</h2>
                        <p class="best-places-subtitle">Découvrez les lieux préférés de nos internautes</p>
                    </div>
                    <div class="best-places-carousel">
                        <button class="carousel-arrow left"><span>&#10094;</span></button>
                        <div class="carousel-track">
                            <div class="carousel-card">
                                <img src="/assets/images/1.png" alt="Lieu 1" class="carousel-img">
                                <div class="carousel-info-overlay">
                                    <div class="carousel-info-content">
                                        <h3 class="carousel-info-title">TRÉSORS ARCHITECTURAUX<br>À DÉCOUVRIR</h3>
                                        <p class="carousel-info-desc">Explorez les joyaux architecturaux qui ont façonné notre histoire et notre culture !</p>
                                        <button class="carousel-info-btn">Voir plus</button>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-card">
                                <img src="/assets/images/2.png" alt="Lieu 2" class="carousel-img">
                                <div class="carousel-info-overlay">
                                    <div class="carousel-info-content">
                                        <h3 class="carousel-info-title">UN PATRIMOINE<br>CHARGÉ D'HISTOIRE</h3>
                                        <p class="carousel-info-desc">Partez à la chasse aux histoires insolites qui se cachent juste au coin de votre rue !</p>
                                        <button class="carousel-info-btn">Voir plus</button>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-card">
                                <img src="/assets/images/3.png" alt="Lieu 3" class="carousel-img">
                                <div class="carousel-info-overlay">
                                    <div class="carousel-info-content">
                                        <h3 class="carousel-info-title">DES JARDINS<br>REMARQUABLES</h3>
                                        <p class="carousel-info-desc">Explorez les plus beaux jardins français classés et découvrez leurs secrets botaniques !</p>
                                        <button class="carousel-info-btn">Voir plus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-arrow right"><span>&#10095;</span></button>
                    </div>
                    <div class="carousel-indicators">
                        <span class="carousel-dot active"></span>
                        <span class="carousel-dot"></span>
                        <span class="carousel-dot"></span>
                    </div>
                </div>
            </section>

            <!-- Section Nearby Places -->
            <section class="nearby-places-section">
                <h2 class="nearby-title">LES LIEUX PRÈS DE CHEZ TOI</h2>
                <div class="nearby-geoloc-btn-container">
                    <button class="nearby-geoloc-btn"><i class="fa-solid fa-location-dot"></i> Se géolocaliser</button>
                </div>
                <div class="nearby-cards-row">
                    <div class="nearby-card nearby-card-left">
                        <img src="https://offloadmedia.feverup.com/parissecret.com/wp-content/uploads/2021/04/17054435/shutterstock_455256892-1-scaled.jpg" alt="Jardin Albert Khan" class="nearby-card-img">
                        <div class="nearby-card-label">JARDIN ALBERT KHAN</div>
                        <div class="nearby-card-fav"><i class="fa-regular fa-heart"></i></div>
                    </div>
                    <div class="nearby-card nearby-card-center">
                        <img src="https://domaine-de-sceaux.hauts-de-seine.fr/fileadmin/_processed_/6/3/csm_chateauWilly_6e1650a2ea.jpg" alt="Château de Sceaux" class="nearby-card-img">
                        <div class="nearby-card-fav"><i class="fa-regular fa-heart"></i></div>
                    </div>
                    <div class="nearby-card nearby-card-right">
                        <img src="https://www.hauts-de-seine.fr/fileadmin/_processed_/3/f/csm_saintcloud1_1005999dec.jpg" alt="Domaine de St Cloud" class="nearby-card-img">
                        <div class="nearby-card-label">DOMAINE DE ST CLOUD</div>
                        <div class="nearby-card-fav"><i class="fa-regular fa-heart"></i></div>
                    </div>
                </div>
                <div class="nearby-card-info">
                    <div class="nearby-card-title">CHÂTEAU DE SCEAUX <span class="nearby-card-stars">★★★★★</span></div>
                    <div class="nearby-card-desc">92330, Sceaux</div>
                    <button class="nearby-card-btn">Voir plus</button>
                </div>
            </section>

            <section class="enigmes-section">
                <div class="path-background"></div>

                <h1 class="main-title-enigme">LES ÉNIGMES DE JARDY ET ARCHY</h1>

                <div class="characters-container">
                    <!-- Jardy Character -->
                    <div class="character jardy">
                        <div class="character-avatar">
                            <img src="/assets/images/1new.png" alt="Jardy" class="avatar-img">
                        </div>
                        <div class="speech-bubble archy-bubble">
                            <div class="character-name">🏛️ Archy</div>
                            <p>Je repère les détails que<br>
                                personne ne regarde.<br>
                                Façades, colonnes, trucs<br>
                                chelous sur les toits...<br>
                                Si t'aimes explorer, je suis<br>
                                ton gars sûr.</p>
                        </div>
                    </div>

                    <!-- Archy Character -->
                    <div class="character archy">
                        <div class="speech-bubble jardy-bubble">
                            <div class="character-name">🌿 Jardy</div>
                            <p>Moi c'est calme, nature et<br>
                                coins planqués.<br>
                                J'te fais découvrir les jardins<br>
                                qui valent le détour.<br>
                                Tu crois connaître ta ville ?<br>
                                On va voir ça.</p>
                        </div>
                        <div class="character-avatar">
                            <img src="/assets/images/2new.png" alt="Archy" class="avatar-img-2">
                        </div>
                    </div>
                </div>

                <!-- Fun Facts Section -->
                <div class="fun-facts">
                    <div class="fact-card" data-fact="0">
                        <div class="fact-original">
                            <div class="fact-header">LE FUN FACT</div>
                            <div class="fact-content">LA CATHÉDRALE DE<br>STRASBOURG</div>
                        </div>
                    </div>

                    <div class="fact-card" data-fact="1">
                        <div class="fact-original">
                            <div class="fact-header">LE FUN FACT</div>
                            <div class="fact-content">LA GRANDE MOSQUÉE<br>DE PARIS</div>
                        </div>
                    </div>

                    <div class="fact-card" data-fact="2">
                        <div class="fact-original">
                            <div class="fact-header">LE FUN FACT</div>
                            <div class="fact-content">LE CENTRE<br>POMPIDOU DE METZ</div>
                        </div>
                    </div>

                    <div class="fact-card" data-fact="3">
                        <div class="fact-original">
                            <div class="fact-header">LE FUN FACT</div>
                            <div class="fact-content">LE PALAIS IDÉAL<br>DU FACTEUR CHEVAL</div>
                        </div>
                    </div>

                    <!-- Hover cards container -->
                    <div class="fact-hover" id="hover-0">
                        <img src="https://q-xx.bstatic.com/xdata/images/landmark/608x352/275344.webp?k=fe69f9d21286dc64e62d67386eedac822585742d8f177300060292e8365e6ea4&o=" alt="Cathédrale de Strasbourg" class="fact-image-hover">
                        <div class="fact-text-area">
                            Sa flèche gothique culmine à<br>
                            142 mètres, faisant d'elle<br>
                            l'une des plus hautes<br>
                            cathédrales de France.<br>
                            Son horloge astronomique<br>
                            date de la Renaissance.
                        </div>
                        <button class="fact-button">En savoir +</button>
                    </div>

                    <div class="fact-hover" id="hover-1">
                        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0a/d2/95/f7/photo5jpg.jpg?w=800&h=500&s=1" alt="Grande Mosquée de Paris" class="fact-image-hover">
                        <div class="fact-text-area">
                            Construite en 1926, c'est la plus<br>
                            ancienne mosquée de France<br>
                            métropolitaine. Son minaret<br>
                            s'élève à 33 mètres de haut,<br>
                            inspiré de celui de Fès.
                        </div>
                        <button class="fact-button">En savoir +</button>
                    </div>

                    <div class="fact-hover" id="hover-2">
                        <img src="https://api.centrepompidou-metz.fr/assets/q70-w1200/b16448a2/architecture_c_jacqueline_trichard_21_centre_pompidou_metz_29072020_2147.jpg" alt="Centre Pompidou de Metz" class="fact-image-hover">
                        <div class="fact-text-area">
                            Son toit en forme de<br>
                            chapeau chinois est inspiré<br>
                            d'un panama. La structure<br>
                            couvre 8000m² sans aucun<br>
                            pilier central.
                        </div>
                        <button class="fact-button">En savoir +</button>
                    </div>

                    <div class="fact-hover" id="hover-3">
                        <img src="https://woody.cloudly.space/app/uploads/porte-dromardeche/2021/07/thumbs/palais00-1920x960-crop-1642494192.jpg" alt="Palais Idéal du Facteur Cheval" class="fact-image-hover">
                        <div class="fact-text-area">
                            Ferdinand Cheval a passé<br>
                            33 ans à construire ce palais<br>
                            seul, en ramassant des pierres<br>
                            pendant sa tournée de<br>
                            facteur rural.
                        </div>
                        <button class="fact-button">En savoir +</button>
                    </div>
                </div>
            </section>

            <!-- Testimonials Section -->
            <section class="testimonials-section">
                <h2 class="testimonials-title">CE QU'ILS EN PENSENT</h2>
                <div class="testimonials-carousel-container">
                    <div class="testimonials-carousel-track">
                        <!-- Testimonial Card 1 -->
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Avatar">
                            </div>
                            <div class="testimonial-content">
                                <p class="testimonial-text">"Une expérience incroyable ! J'ai découvert des lieux magnifiques que je ne connaissais pas dans ma propre ville."</p>
                                <div class="testimonial-author">
                                    <h4>Marie L.</h4>
                                    <p>Paris</p>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Card 2 -->
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Avatar">
                            </div>
                            <div class="testimonial-content">
                                <p class="testimonial-text">"Les défis sont vraiment amusants et m'ont permis d'en apprendre beaucoup sur l'architecture de ma ville."</p>
                                <div class="testimonial-author">
                                    <h4>Thomas D.</h4>
                                    <p>Lyon</p>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Card 3 -->
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Avatar">
                            </div>
                            <div class="testimonial-content">
                                <p class="testimonial-text">"Une application qui rend la découverte culturelle accessible et ludique. Je recommande !"</p>
                                <div class="testimonial-author">
                                    <h4>Sophie M.</h4>
                                    <p>Bordeaux</p>
                                </div>
                            </div>
                        </div>
                        <!-- Duplicate cards for infinite effect -->
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Avatar">
                            </div>
                            <div class="testimonial-content">
                                <p class="testimonial-text">"Une expérience incroyable ! J'ai découvert des lieux magnifiques que je ne connaissais pas dans ma propre ville."</p>
                                <div class="testimonial-author">
                                    <h4>Marie L.</h4>
                                    <p>Paris</p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Avatar">
                            </div>
                            <div class="testimonial-content">
                                <p class="testimonial-text">"Les défis sont vraiment amusants et m'ont permis d'en apprendre beaucoup sur l'architecture de ma ville."</p>
                                <div class="testimonial-author">
                                    <h4>Thomas D.</h4>
                                    <p>Lyon</p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card">
                            <div class="testimonial-avatar">
                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Avatar">
                            </div>
                            <div class="testimonial-content">
                                <p class="testimonial-text">"Une application qui rend la découverte culturelle accessible et ludique. Je recommande !"</p>
                                <div class="testimonial-author">
                                    <h4>Sophie M.</h4>
                                    <p>Bordeaux</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="partners-section">
                <h1 class="testimonials-title">ILS NOUS ONT FAIT CONFIANCE</h1>

                <div class="partners-carousel-container">
                    <div class="partners-carousel-track">
                        <!-- Logos originaux -->
                        <div class="partners-carousel-slide">
                            <img src="https://aufildudedale.fr/storage/2024/02/logo-pass-culture-1-png-16162.png" alt="Pass Culture" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://image.over-blog.com/lWzrS-cab4LuWDJkxy_Dvxh62Ks=/filters:no_upscale()/image%2F6834552%2F20220421%2Fob_8b255d_81-5fc6581a822f9-orig-1.png" alt="Ministère de la Culture" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f5/Logo-amf-bas.png" alt="AMF" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvt-rUaFQJuiskfXDgYZ08Nf-yBTSHMXodIg&s" alt="Région Île-de-France" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://www.arte.tv/sites/corporate/files/arte-logo_1920x1080-6-470x270.jpg" alt="Ville de Paris" class="partners-logo">
                        </div>
                        <div class="partern-logo">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQICLj-Kd5YYTgiSCAQFy9L6Wds2OUjWv8taQ&s" alt="Région aquitaine" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://aufildudedale.fr/storage/2024/02/logo-pass-culture-1-png-16162.png" alt="Pass Culture" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://image.over-blog.com/lWzrS-cab4LuWDJkxy_Dvxh62Ks=/filters:no_upscale()/image%2F6834552%2F20220421%2Fob_8b255d_81-5fc6581a822f9-orig-1.png" alt="Ministère de la Culture" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f5/Logo-amf-bas.png" alt="AMF" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvt-rUaFQJuiskfXDgYZ08Nf-yBTSHMXodIg&s" alt="Région Île-de-France" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://www.arte.tv/sites/corporate/files/arte-logo_1920x1080-6-470x270.jpg" alt="Ville de Paris" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQICLj-Kd5YYTgiSCAQFy9L6Wds2OUjWv8taQ&s" alt="Région aquitaine" class="partners-logo">
                        </div>

                        <!-- Logos dupliqués pour l'effet infini -->
                        <div class="partners-carousel-slide">
                            <img src="https://aufildudedale.fr/storage/2024/02/logo-pass-culture-1-png-16162.png" alt="Pass Culture" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://image.over-blog.com/lWzrS-cab4LuWDJkxy_Dvxh62Ks=/filters:no_upscale()/image%2F6834552%2F20220421%2Fob_8b255d_81-5fc6581a822f9-orig-1.png" alt="Ministère de la Culture" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f5/Logo-amf-bas.png" alt="AMF" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvt-rUaFQJuiskfXDgYZ08Nf-yBTSHMXodIg&s" alt="Région Île-de-France" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://www.arte.tv/sites/corporate/files/arte-logo_1920x1080-6-470x270.jpg" alt="Ville de Paris" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQICLj-Kd5YYTgiSCAQFy9L6Wds2OUjWv8taQ&s" alt="Région aquitaine" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://aufildudedale.fr/storage/2024/02/logo-pass-culture-1-png-16162.png" alt="Pass Culture" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://image.over-blog.com/lWzrS-cab4LuWDJkxy_Dvxh62Ks=/filters:no_upscale()/image%2F6834552%2F20220421%2Fob_8b255d_81-5fc6581a822f9-orig-1.png" alt="Ministère de la Culture" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f5/Logo-amf-bas.png" alt="AMF" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvt-rUaFQJuiskfXDgYZ08Nf-yBTSHMXodIg&s" alt="Région Île-de-France" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://www.arte.tv/sites/corporate/files/arte-logo_1920x1080-6-470x270.jpg" alt="Ville de Paris" class="partners-logo">
                        </div>
                        <div class="partners-carousel-slide">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQICLj-Kd5YYTgiSCAQFy9L6Wds2OUjWv8taQ&s" alt="Région aquitaine" class="partners-logo">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Newsletter Section -->
            <section class="newsletter-section">
                <div class="newsletter-container">
                    <div class="newsletter-content">
                        <div class="newsletter-title">Newsletter</div>
                        <div class="newsletter-form">
                            <input type="email" class="newsletter-input" placeholder="Ton e-mail">
                            <button class="newsletter-button">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </div>

    <?php include 'includes/layout/footer.php'; ?>

    <script>
        document.querySelectorAll('.carousel-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('hovered');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hovered');
            });
        });

        document.querySelectorAll('.nearby-card-right').forEach(function(card) {
            const infoCard = card.querySelector('.nearby-class-info-none');
            if (infoCard) {
                card.addEventListener('mouseenter', function() {
                    infoCard.style.display = 'flex';
                });
                card.addEventListener('mouseleave', function() {
                    infoCard.style.display = 'none';
                });
                infoCard.addEventListener('mouseenter', function() {
                    infoCard.style.display = 'flex';
                });
                infoCard.addEventListener('mouseleave', function() {
                    infoCard.style.display = 'none';
                });
            }
        });

        document.querySelectorAll('.nearby-card-left').forEach(function(card) {
            const infoCard = card.querySelector('.nearby-card-info-none');
            if (infoCard) {
                card.addEventListener('mouseenter', function() {
                    infoCard.style.display = 'flex';
                });
                card.addEventListener('mouseleave', function() {
                    infoCard.style.display = 'none';
                });
                infoCard.addEventListener('mouseenter', function() {
                    infoCard.style.display = 'flex';
                });
                infoCard.addEventListener('mouseleave', function() {
                    infoCard.style.display = 'none';
                });
            }
        });

        //carousel

        // Carousel partenaires - pause au hover
        const partnersCarouselContainer = document.querySelector('.partners-carousel-container');
        const partnersCarouselTrack = document.querySelector('.partners-carousel-track');

        if (partnersCarouselContainer && partnersCarouselTrack) {
            partnersCarouselContainer.addEventListener('mouseenter', () => {
                partnersCarouselTrack.style.animationPlayState = 'paused';
            });

            partnersCarouselContainer.addEventListener('mouseleave', () => {
                partnersCarouselTrack.style.animationPlayState = 'running';
            });
        }

        // fact card
        document.addEventListener('DOMContentLoaded', function() {
            const factCards = document.querySelectorAll('.fact-card');
            const hoverCards = document.querySelectorAll('.fact-hover');
            const firstCard = document.querySelector('.fact-card[data-fact="1"]');
            const firstHover = document.getElementById('hover-1');

            // Positionner la première carte au chargement
            if (firstCard && firstHover) {
                const cardRect = firstCard.getBoundingClientRect();
                const containerRect = firstCard.parentElement.getBoundingClientRect();
                const leftOffset = cardRect.left - containerRect.left;

                firstHover.style.left = leftOffset + 'px';
            }

            factCards.forEach((card, index) => {
                const hoverCard = document.getElementById(`hover-${index}`);

                card.addEventListener('mouseenter', function() {
                    if (index !== 1) {
                        hoverCards.forEach(h => h.classList.remove('active'));
                    }

                    if (hoverCard && index !== 1) {
                        const cardRect = card.getBoundingClientRect();
                        const containerRect = card.parentElement.getBoundingClientRect();
                        const leftOffset = cardRect.left - containerRect.left;

                        hoverCard.style.left = leftOffset + 'px';
                        hoverCard.style.bottom = '100%';
                        hoverCard.style.marginBottom = '20px';

                        hoverCard.classList.add('active');
                    }
                });

                card.addEventListener('mouseleave', function() {
                    if (index !== 0) {
                        setTimeout(() => {
                            if (!hoverCard.matches(':hover') && !card.matches(':hover')) {
                                hoverCard.classList.remove('active');
                            }
                        }, 100);
                    }
                });

                if (hoverCard && index !== 0) {
                    hoverCard.addEventListener('mouseenter', function() {
                        hoverCard.classList.add('active');
                    });

                    hoverCard.addEventListener('mouseleave', function() {
                        hoverCard.classList.remove('active');
                    });
                }
            });
        });

        // Manual carousel navigation (example - you might need to implement full carousel logic)
        const carouselTrackElement = document.querySelector('.best-places-carousel .carousel-track');
        const carouselCards = document.querySelectorAll('.best-places-carousel .carousel-card');
        const prevArrow = document.querySelector('.best-places-carousel .carousel-arrow.left');
        const nextArrow = document.querySelector('.best-places-carousel .carousel-arrow.right');
        let currentIndex = 0;

        if (prevArrow && nextArrow && carouselTrackElement && carouselCards.length > 0) {
            const cardWidth = carouselCards[0].offsetWidth + parseInt(getComputedStyle(carouselTrackElement).gap);

            nextArrow.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % carouselCards.length;
                carouselTrackElement.style.transform = `translateX(${-currentIndex * cardWidth}px)`;
            });

            prevArrow.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + carouselCards.length) % carouselCards.length;
                carouselTrackElement.style.transform = `translateX(${-currentIndex * cardWidth}px)`;
            });
        }
    </script>
</body>

</html>