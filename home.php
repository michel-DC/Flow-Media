<?php
require_once 'includes/auth.php'; 
$link = mysqli_connect("localhost", "micheldjoumessi_pair-prog", "michelchrist", "micheldjoumessi_pair-prog");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Explorez le patrimoine français</title>
    <link rel="icon" href="/assets/icons/icon-test.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        
        :root {
            --primary: #1a1a1a;
            --secondary: #f9f9f9;
            --accent: #e63946;
            --white: #ffffff;
            --light-gray: #f0f0f0;
            --beige: #f8f4e3;
            --gold: #daa520;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }
        
        body {
            font-family: "Poppins", sans-serif;
            color: var(--primary);
            background: var(--secondary);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
        }
        
        /* Hero Section */
        .hero {
            height: 100vh;
            position: relative;
            overflow: hidden;
            background-color: #000;
        }
        
        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.7;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100%;
            padding: 0 20px;
            color: var(--white);
        }
        
        .hero-title {
            font-family: "Playfair Display", serif;
            font-size: 4.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s forwards 0.5s;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
            max-width: 800px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s forwards 0.8s;
        }
        
        .hero-cta {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s forwards 1.1s;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Buttons */
        .btn {
            display: inline-block;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-primary {
            background-color: var(--accent);
            color: var(--white);
            border: 2px solid var(--accent);
        }
        
        .btn-primary:hover {
            background-color: transparent;
            color: var(--white);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(230, 57, 70, 0.3);
        }
        
        .btn-secondary {
            background-color: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }
        
        .btn-secondary:hover {
            background-color: var(--white);
            color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.3);
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            z-index: -1;
        }
        
        .btn:hover::before {
            width: 100%;
        }
        
        /* Section Styles */
        section {
            padding: 100px 0;
            position: relative;
        }
        
        .section-title {
            font-family: "Playfair Display", serif;
            font-size: 3rem;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            padding-bottom: 20px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--accent);
        }
        
        .section-description {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 3rem;
            font-size: 1.1rem;
        }
        
        /* Architecture Section */
        .architecture {
            background-color: var(--white);
            position: relative;
        }
        
        .parallax-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: 0;
            opacity: 0.15;
        }
        
        .architecture-bg {
            background-image: url('https://www.district-immo.com/wp-content/uploads/2023/04/Immeuble-haussmannien-shutterstock.png');
        }
        
        .content-wrapper {
            position: relative;
            z-index: 1;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2rem;
        }
        
        .content-text {
            flex: 1;
            min-width: 300px;
        }
        
        .content-img {
            flex: 1;
            min-width: 300px;
            height: 500px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            position: relative;
        }
        
        .content-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .content-img:hover img {
            transform: scale(1.05);
        }
        
        .content-title {
            font-family: "Playfair Display", serif;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 15px;
        }
        
        .content-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--accent);
        }
        
        .content-description {
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        
        .feature-list {
            list-style-type: none;
            margin-bottom: 2rem;
        }
        
        .feature-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
        }
        
        .feature-list li i {
            color: var(--accent);
            margin-right: 10px;
            margin-top: 5px;
        }
        
        /* Heritage Section */
        .heritage {
            background-color: var(--beige);
            position: relative;
        }
        
        .heritage-bg {
            background-image: url('https://media.lesechos.com/api/v1/images/view/65095a3f3880a20fca650e2f/contenu_article/image.jpg');
        }
        
        /* Gardens Section */
        .gardens {
            background-color: var(--white);
            position: relative;
        }
        
        .gardens-bg {
            background-image: url('https://www.stiga.com/media/contentmanager/content/symetrie_jardin.jpg');
        }
        
        /* Testimonials Section */
        .testimonials {
            background-color: var(--primary);
            color: var(--white);
            text-align: center;
        }
        
        .testimonial-slider {
            max-width: 900px;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
        }
        
        .testimonial-track {
            display: flex;
            transition: transform 0.5s ease;
        }
        
        .testimonial-slide {
            flex: 0 0 100%;
            padding: 2rem;
        }
        
        .testimonial-quote {
            font-size: 1.2rem;
            font-style: italic;
            margin-bottom: 1.5rem;
        }
        
        .testimonial-author {
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .testimonial-location {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .testimonial-dots {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 10px;
        }
        
        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.3);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .dot.active {
            background-color: var(--accent);
        }
        
        /* Activities Section */
        .activities {
            background-color: var(--light-gray);
            position: relative;
            overflow: hidden;
        }
        
        .activity-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .activity-card {
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .activity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .activity-img {
            height: 200px;
            overflow: hidden;
        }
        
        .activity-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .activity-card:hover .activity-img img {
            transform: scale(1.1);
        }
        
        .activity-content {
            padding: 1.5rem;
        }
        
        .activity-title {
            font-family: "Playfair Display", serif;
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }
        
        .activity-date {
            font-size: 0.9rem;
            color: var(--accent);
            margin-bottom: 1rem;
            display: block;
        }
        
        .activity-description {
            margin-bottom: 1.5rem;
        }
        
        .text-center {
            text-align: center;
        }
        
        /* CTA Section */
        .cta {
            background-color: var(--accent);
            color: var(--white);
            text-align: center;
            padding: 80px 0;
        }
        
        .cta-title {
            font-family: "Playfair Display", serif;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }
        
        .cta-description {
            max-width: 700px;
            margin: 0 auto 2rem;
            font-size: 1.1rem;
        }
        
        .btn-white {
            background-color: var(--white);
            color: var(--accent);
            border: 2px solid var(--white);
        }
        
        .btn-white:hover {
            background-color: transparent;
            color: var(--white);
        }
        
        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--white);
            z-index: 3;
            cursor: pointer;
            animation: bounce 2s infinite;
        }
        
        .scroll-indicator span {
            font-size: 0.9rem;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .scroll-icon {
            font-size: 1.5rem;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-20px);
            }
            60% {
                transform: translateX(-50%) translateY(-10px);
            }
        }
        
        /* Responsive Styles */
        @media (max-width: 1024px) {
            .hero-title {
                font-size: 3.5rem;
            }
            
            .section-title {
                font-size: 2.5rem;
            }
            
            .content-title {
                font-size: 2rem;
            }
            
            .content-img {
                height: 400px;
            }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.8rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .content-wrapper {
                flex-direction: column-reverse;
            }
            
            .content-text {
                text-align: center;
            }
            
            .content-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .content-img {
                width: 100%;
                height: 350px;
            }
            
            .feature-list li {
                justify-content: center;
            }
            
            section {
                padding: 70px 0;
            }
            
            .hero-cta {
                flex-direction: column;
                width: 100%;
            }
            
            .btn {
                width: 100%;
            }
        }
        
        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .content-title {
                font-size: 1.5rem;
            }
            
            .testimonial-quote {
                font-size: 1rem;
            }
        }
        
        /* Partners Section */
        .partners {
            background-color: var(--white);
            text-align: center;
        }
        
        .partners-slider {
            display: flex;
            gap: 4rem;
            overflow: hidden;
            padding: 2rem 0;
        }
        
        .partners-track {
            display: flex;
            gap: 4rem;
            animation: partnersScroll 30s linear infinite;
        }
        
        .partner-logo {
            height: 80px;
            filter: grayscale(1);
            opacity: 0.7;
            transition: all 0.3s ease;
        }
        
        .partner-logo:hover {
            filter: grayscale(0);
            opacity: 1;
        }
        
        @keyframes partnersScroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-100% - 4rem));
            }
        }
        
        /* Diagonal Sections */
        .diagonal-box {
            position: relative;
            padding: 15vh 0;
            margin-top: -10vh;
            margin-bottom: -10vh;
            transform: skewY(-5deg);
            background-color: var(--white);
        }
        
        .diagonal-content {
            transform: skewY(5deg);
        }
        
        /* Floating Elements */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
        }
        
        .floating-element {
            position: absolute;
            background-color: var(--accent);
            opacity: 0.1;
            border-radius: 50%;
        }
        
        .element-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -100px;
        }
        
        .element-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            right: -50px;
        }
        
        .element-3 {
            width: 150px;
            height: 150px;
            top: 50%;
            right: 10%;
        }

        .newsletter {
            background: linear-gradient(135deg, var(--light-green) 0%, rgba(44, 85, 48, 0.1) 100%);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .newsletter::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1511818966892-d7d671e672a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80') center/cover;
            opacity: 0.05;
            z-index: 0;
        }

        .newsletter-content {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 0 auto;
            text-align: center;
            padding: 0 20px;
        }

        .newsletter .section-title {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: clamp(2rem, 5vw, 3rem);
        }

        .newsletter .section-description {
            color: var(--dark-green);
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
            opacity: 0.8;
        }

        .newsletter-form {
            margin-top: 2rem;
        }

        .form-group {
            display: flex;
            gap: 1rem;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        .form-group input {
            flex: 1;
            padding: 18px 25px;
            border: 2px solid var(--primary);
            border-radius: 50px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary);
        }

        .form-group input::placeholder {
            color: var(--primary);
            opacity: 0.6;
        }

        .form-group input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(44, 85, 48, 0.1);
            background: var(--secondary);
        }

        .form-group .btn {
            padding: 18px 35px;
            border-radius: 50px;
            white-space: nowrap;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            background: var(--primary);
            color: var(--secondary);
            border: none;
        }

        .form-group .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(44, 85, 48, 0.2);
            background: var(--dark-green);
        }

        .form-group .btn:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .newsletter {
                padding: 60px 0;
            }

            .form-group {
                flex-direction: column;
                gap: 1rem;
            }

            .form-group input,
            .form-group .btn {
                width: 100%;
                padding: 15px 20px;
            }

            .newsletter .section-title {
                font-size: 2rem;
            }

            .newsletter .section-description {
                font-size: 1rem;
            }
        }

        /* Animation pour le formulaire */
        .newsletter-form {
            animation: slideUp 0.8s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<?php require_once 'loader/loader.php'; ?>
<body>
    <div id="body">
        <?php include './includes/layout/navbar-special.php'; ?>

        <!-- Hero Section -->
        <header class="hero">
            <video class="hero-video" autoplay muted loop>
                <source src="https://videos.pexels.com/video-files/1777892/1777892-sd_640_360_25fps.mp4" type="video/mp4">
                Votre navigateur ne prend pas en charge la vidéo.
            </video>
            <div class="hero-content">
                <h1 class="hero-title">Explorez l'héritage français</h1>
                <p class="hero-subtitle">Découvrez le patrimoine, l'architecture et les jardins historiques de France sous un nouveau regard</p>
                <div class="hero-cta">
                    <a href="/connexion/register.php" class="btn btn-primary">Rejoindre l'aventure</a>
                    <a href="#architecture" class="btn btn-secondary">Explorer</a>
                </div>
            </div>
            <div class="scroll-indicator" id="scroll-down">
                <span>Découvrir</span>
                <i class="fas fa-chevron-down scroll-icon"></i>
            </div>
        </header>

        <!-- Architecture Section -->
        <section id="architecture" class="architecture">
            <div class="parallax-bg architecture-bg"></div>
            <div class="container">
                <div class="content-wrapper">
                    <div class="content-text" data-aos="fade-right" data-aos-duration="1000">
                        <h2 class="content-title">Architecture</h2>
                        <p class="content-description">L'architecture française raconte notre histoire à travers ses formes, ses matériaux et ses innovations. Des châteaux médiévaux aux constructions contemporaines, chaque bâtiment est le reflet d'une époque et d'une vision.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Découvrez l'évolution des styles architecturaux à travers les siècles</li>
                            <li><i class="fas fa-check-circle"></i> Explorez les techniques de construction qui ont façonné nos villes</li>
                            <li><i class="fas fa-check-circle"></i> Comprenez comment l'architecture influence notre quotidien</li>
                        </ul>
                        <a href="/pages/architecture.php" class="btn btn-primary">En savoir plus</a>
                    </div>
                    <div class="content-img" data-aos="fade-left" data-aos-duration="1000">
                        <img src="https://www.district-immo.com/wp-content/uploads/2023/04/Immeuble-haussmannien-shutterstock.png" alt="Architecture française">
                    </div>
                </div>
            </div>
        </section>

        <!-- Heritage Section -->
        <section id="heritage" class="heritage">
            <div class="parallax-bg heritage-bg"></div>
            <div class="container">
                <div class="content-wrapper">
                    <div class="content-img" data-aos="fade-right" data-aos-duration="1000">
                        <img src="https://media.lesechos.com/api/v1/images/view/65095a3f3880a20fca650e2f/contenu_article/image.jpg" alt="Patrimoine français">
                    </div>
                    <div class="content-text" data-aos="fade-left" data-aos-duration="1000">
                        <h2 class="content-title">Patrimoine</h2>
                        <p class="content-description">Le patrimoine français constitue un héritage culturel d'une richesse exceptionnelle. Des monuments historiques aux traditions locales, ce sont ces éléments qui créent notre identité collective et forgent notre avenir.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Plongez dans l'histoire vivante à travers des monuments emblématiques</li>
                            <li><i class="fas fa-check-circle"></i> Découvrez les savoir-faire traditionnels qui perdurent au fil des générations</li>
                            <li><i class="fas fa-check-circle"></i> Participez à la préservation de notre mémoire collective</li>
                        </ul>
                        <a href="/pages/patrimoine.php" class="btn btn-primary">Explorer notre patrimoine</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gardens Section -->
        <section id="gardens" class="gardens">
            <div class="parallax-bg gardens-bg"></div>
            <div class="container">
                <div class="content-wrapper">
                    <div class="content-text" data-aos="fade-right" data-aos-duration="1000">
                        <h2 class="content-title">Jardins & Nature</h2>
                        <p class="content-description">Les jardins français sont des œuvres d'art vivantes où la nature dialogue avec la culture. Des jardins à la française aux espaces contemporains, découvrez comment ces lieux uniques combinent esthétique, histoire et biodiversité.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Admirez l'art paysager qui a défini l'identité des jardins français</li>
                            <li><i class="fas fa-check-circle"></i> Découvrez les jardins historiques qui ont inspiré l'Europe entière</li>
                            <li><i class="fas fa-check-circle"></i> Comprenez le rôle des espaces verts dans nos environnements urbains</li>
                        </ul>
                        <a href="/pages/jardins.php" class="btn btn-primary">Découvrir les jardins</a>
                    </div>
                    <div class="content-img" data-aos="fade-left" data-aos-duration="1000">
                        <img src="https://www.stiga.com/media/contentmanager/content/symetrie_jardin.jpg" alt="Jardins français">
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Testimonials Section -->
        <section class="testimonials">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Ce qu'ils en disent</h2>
                <div class="testimonial-slider" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-track">
                        <div class="testimonial-slide">
                            <p class="testimonial-quote">"La visite nocturne des monuments illuminés a complètement changé ma vision de l'architecture de ma propre ville. Je ne regarderai plus jamais ces bâtiments de la même façon."</p>
                            <p class="testimonial-author">Léa, 19 ans</p>
                            <p class="testimonial-location">Lyon</p>
                        </div>
                        <div class="testimonial-slide">
                            <p class="testimonial-quote">"L'atelier de cyanotype dans le jardin botanique était à la fois un moment de connexion avec la nature et une découverte technique fascinante. Je ne pensais pas que le patrimoine pouvait être aussi vivant et inspirant."</p>
                            <p class="testimonial-author">Maxime, 22 ans</p>
                            <p class="testimonial-location">Bordeaux</p>
                        </div>
                        <div class="testimonial-slide">
                            <p class="testimonial-quote">"Grâce aux podcasts de Flow Media, j'ai découvert des aspects de la culture urbaine que je côtoyais tous les jours sans les remarquer. J'ai maintenant un regard beaucoup plus attentif sur mon environnement."</p>
                            <p class="testimonial-author">Chloé, 17 ans</p>
                            <p class="testimonial-location">Nantes</p>
                        </div>
                    </div>
                    <div class="testimonial-dots">
                        <div class="dot active"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Activities Section -->
        <section class="activities" id="activities">
            <div class="floating-elements">
                <div class="floating-element element-1"></div>
                <div class="floating-element element-2"></div>
                <div class="floating-element element-3"></div>
            </div>
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Prochaines activités</h2>
                <p class="section-description" data-aos="fade-up" data-aos-delay="200">Participez à nos événements pour vivre des expériences culturelles uniques et immersives</p>
                <div class="activity-cards">
                    <div class="activity-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="activity-img">
                            <img src="https://images.unsplash.com/photo-1567767292278-a4f21aa2d36e" alt="Street Art Tour">
                        </div>
                        <div class="activity-content">
                            <h3 class="activity-title">Street Art Tour - Centre-ville</h3>
                            <span class="activity-date">28 mai 2025</span>
                            <p class="activity-description">Parcours guidé à travers les œuvres de street art qui transforment nos murs en galeries à ciel ouvert. Découvrez les artistes locaux et internationaux qui s'expriment dans l'espace urbain.</p>
                            <a href="/evenements/street-art-tour.php" class="btn btn-primary">S'inscrire</a>
                        </div>
                    </div>
                    <div class="activity-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="activity-img">
                            <img src="https://images.unsplash.com/photo-1513311068348-19c8fbdc0bb6" alt="Visite architecturale">
                        </div>
                        <div class="activity-content">
                            <h3 class="activity-title">Visite architecturale - Quartier historique</h3>
                            <span class="activity-date">15 juin 2025</span>
                            <p class="activity-description">Explorez l'architecture Art Déco et les influences modernistes qui ont façonné notre ville. Une visite guidée par un architecte passionné qui vous révélera les secrets de ces bâtiments emblématiques.</p>
                            <a href="/evenements/visite-architecturale.php" class="btn btn-primary">S'inscrire</a>
                        </div>
                    </div>
                    <div class="activity-card" data-aos="fade-up" data-aos-delay="500">
                        <div class="activity-img">
                            <img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae" alt="Atelier jardinage">
                        </div>
                        <div class="activity-content">
                            <h3 class="activity-title">Atelier jardinage urbain</h3>
                            <span class="activity-date">22 juin 2025</span>
                            <p class="activity-description">Apprenez à créer et entretenir votre jardin urbain. Des techniques de permaculture aux solutions innovantes pour les espaces restreints, découvrez comment cultiver la nature en ville.</p>
                            <a href="/evenements/atelier-jardinage.php" class="btn btn-primary">S'inscrire</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="newsletter">
            <div class="container">
                <div class="newsletter-content" data-aos="fade-up">
                    <h2 class="section-title">Restez informé</h2>
                    <p class="section-description">Recevez nos actualités et découvrez les prochains événements en avant-première</p>
                    <form class="newsletter-form" action="/includes/newsletter.php" method="POST">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Votre adresse email" required>
                            <button type="submit" class="btn btn-primary">S'abonner</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

<?php include 'includes/layout/footer.php' ?>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 1000,
                once: true
            });

            // Testimonial Slider
            const testimonialTrack = document.querySelector('.testimonial-track');
            const dots = document.querySelectorAll('.dot');
            let currentSlide = 0;

            function updateSlider() {
                testimonialTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    updateSlider();
                });
            });

            setInterval(() => {
                currentSlide = (currentSlide + 1) % dots.length;
                updateSlider();
            }, 5000);

            // Smooth Scroll
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Scroll Indicator
            document.getElementById('scroll-down').addEventListener('click', () => {
                document.querySelector('#architecture').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        </script>
    </div>
</body>
</html>