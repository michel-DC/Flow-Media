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
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- <link rel="stylesheet" href="/assets/style/global.css"> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Geologica:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #121212;
            --secondary: #f9f9f9;
            --accent: #ff3c5f;
            --accent-light: #ff6b85;
            --accent-dark: #d72345;
            --text: #333333;
            --text-light: #666666;
            --white: #ffffff;
            --gray: #888888;
            --light-gray: #f4f4f4;
            --overlay: rgba(0, 0, 0, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text);
            background-color: var(--secondary);
            line-height: 1.6;
            height: 100%;
            overflow-y: scroll;
            scroll-snap-type: y mandatory;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Geologica', sans-serif;
            line-height: 1.2;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            width: 100%;
            overflow: hidden;
            background-color: var(--primary);
            scroll-snap-align: start;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.6;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--white);
            padding: 0 20px;
        }

        .hero-title {
            font-size: clamp(2.5rem, 8vw, 5rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
            animation: fadeInUp 1s ease forwards;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 3vw, 1.5rem);
            max-width: 700px;
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease forwards 0.3s;
            opacity: 0;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            animation: fadeInUp 1s ease forwards 0.6s;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-primary {
            background: var(--accent);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--accent-light);
            transform: translateY(-3px);
        }

        .btn-secondary {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }

        /* Scroll Indicator */
        .scroll-arrow {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            cursor: pointer;
            animation: bounce 2s infinite;
        }

        .scroll-arrow span {
            display: block;
            width: 30px;
            height: 30px;
            border-bottom: 3px solid var(--white);
            border-right: 3px solid var(--white);
            transform: rotate(45deg);
            margin: -10px 0;
            opacity: 0;
            animation: fadeIn 0.5s forwards 1s;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            40% {
                transform: translateX(-50%) translateY(-20px);
            }

            60% {
                transform: translateX(-50%) translateY(-10px);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Culture Categories Section */
        .culture-categories {
            position: relative;
            padding: 80px 0;
        }

        .category-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .category-title {
            font-size: clamp(2rem, 5vw, 3rem);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .category-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
        }

        .category-subtext {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
            color: var(--text-light);
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .category-card {
            border-radius: 15px;
            overflow: hidden;
            background: var(--white);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .category-img {
            height: 250px;
            position: relative;
            overflow: hidden;
        }

        .category-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .category-card:hover .category-img img {
            transform: scale(1.1);
        }

        .category-img::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.6));
        }

        .category-name {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: var(--white);
            font-size: 1.8rem;
            font-weight: 700;
            z-index: 1;
        }

        .category-content {
            padding: 25px;
        }

        .category-desc {
            margin-bottom: 20px;
        }

        .btn-outline {
            display: inline-block;
            padding: 10px 20px;
            background: transparent;
            color: var(--accent);
            border: 2px solid var(--accent);
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: var(--accent);
            color: var(--white);
        }

        /* Events Section */
        .events {
            background-color: var(--light-gray);
            padding: 80px 0;
            position: relative;
            scroll-snap-align: start;
            min-height: 100vh;
        }

        .events-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .events-title {
            font-size: clamp(2rem, 5vw, 3rem);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .events-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
        }

        .events-subtext {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
            color: var(--text-light);
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .event-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .event-img {
            height: 200px;
            position: relative;
        }

        .event-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .event-date {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent);
            color: var(--white);
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .event-content {
            padding: 20px;
        }

        .event-title {
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .event-location {
            color: var(--text-light);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .event-location i {
            margin-right: 8px;
            color: var(--accent);
        }

        .event-desc {
            margin-bottom: 20px;
        }

        /* Testimonials */
        .testimonials {
            padding: 80px 0;
            background: linear-gradient(135deg, #121212 0%, #333333 100%);
            color: var(--white);
            scroll-snap-align: start;
            min-height: 100vh;
        }

        .testimonials-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .testimonials-title {
            font-size: clamp(2rem, 5vw, 3rem);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .testimonials-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
        }

        .testimonials-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .testimonial-slider {
            overflow: hidden;
        }

        .testimonial-track {
            display: flex;
            transition: transform 0.3s ease;
        }

        .testimonial {
            flex: 0 0 100%;
            padding: 0 20px;
            text-align: center;
        }

        .testimonial-text {
            font-size: 1.2rem;
            font-style: italic;
            margin-bottom: 20px;
            position: relative;
        }

        .testimonial-text::before,
        .testimonial-text::after {
            content: "";
            font-size: 3rem;
            line-height: 0;
            position: relative;
            color: var(--accent);
        }

        .testimonial-text::after {
            content: "" ";

        }

        .testimonial-author {
            font-weight: 600;
        }

        .testimonial-role {
            color: var(--accent);
            font-size: 0.9rem;
        }

        .testimonial-dots {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 10px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .dot.active {
            background: var(--accent);
        }

        /* Newsletter */
        .newsletter {
            padding: 60px 0;
            background: linear-gradient(to right, var(--accent-light), var(--accent));
            color: var(--white);
            text-align: center;
            scroll-snap-align: start;
            min-height: 100vh;
        }

        .newsletter-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .newsletter-title {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .newsletter-text {
            margin-bottom: 2rem;
        }

        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-input {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 30px 0 0 30px;
            font-size: 1rem;
            outline: none;
        }

        .newsletter-btn {
            padding: 12px 25px;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 0 30px 30px 0;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .newsletter-btn:hover {
            background: #333;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .hero-cta {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .newsletter-input {
                border-radius: 30px;
                margin-bottom: 10px;
            }

            .newsletter-btn {
                border-radius: 30px;
            }
        }

        .theme-section {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            scroll-snap-align: start;
        }

        .theme-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .theme-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4));
            z-index: 2;
        }

        .theme-content {
            position: relative;
            z-index: 3;
            color: var(--white);
            max-width: 600px;
            margin-left: 10%;
            padding: 0 20px;
        }

        .theme-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            margin-bottom: 1.5rem;
            position: relative;
        }

        .theme-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--accent);
        }

        .theme-desc {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .theme-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }

        .theme-arrow {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 4;
            cursor: pointer;
            animation: bounce 2s infinite;
        }

        .theme-arrow svg {
            width: 40px;
            height: 40px;
            fill: var(--white);
        }

        /* Éléments graphiques spécifiques à chaque thème */
        .architecture-elements {
            background:
                radial-gradient(circle at 20% 30%, rgba(255, 60, 95, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 60, 95, 0.1) 0%, transparent 50%);
        }

        .architecture-elements::before {
            content: '';
            position: absolute;
            top: 20%;
            right: 10%;
            width: 200px;
            height: 200px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 3h18v18H3V3zm16 16V5H5v14h14z"/></svg>') no-repeat;
            opacity: 0.1;
        }

        .patrimoine-elements {
            background:
                radial-gradient(circle at 30% 40%, rgba(255, 60, 95, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(255, 60, 95, 0.1) 0%, transparent 50%);
        }

        .patrimoine-elements::before {
            content: '';
            position: absolute;
            bottom: 20%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>') no-repeat;
            opacity: 0.1;
        }

        .jardins-elements {
            background:
                radial-gradient(circle at 40% 50%, rgba(255, 60, 95, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 60% 50%, rgba(255, 60, 95, 0.1) 0%, transparent 50%);
        }

        .jardins-elements::before {
            content: '';
            position: absolute;
            top: 50%;
            right: 15%;
            width: 200px;
            height: 200px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>') no-repeat;
            opacity: 0.1;
        }

        html {
            scroll-behavior: smooth;
            scroll-snap-type: y mandatory;
            overflow-y: scroll;
            height: 100%;
        }




        #section-nav {
            position: fixed;
            top: 50%;
            right: 30px;
            transform: translateY(-50%);
            z-index: 1000;
        }

        #section-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #section-nav li {
            margin: 15px 0;
        }

        #section-nav a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--white);
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        #section-nav a::before {
            content: '';
            display: block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        #section-nav a:hover::before,
        #section-nav a.active::before {
            background-color: var(--accent);
            transform: scale(1.2);
        }

        #section-nav a span {
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        #section-nav:hover a span {
            opacity: 1;
            transform: translateX(0);
        }

        @media (max-width: 768px) {
            #section-nav {
                right: 15px;
            }

            #section-nav a span {
                display: none;
            }
        }
    </style>
</head>

<?php require_once 'loader/loader.php'; ?>

<body>
    <div id="body">
        <?php include './includes/layout/navbar-special.php'; ?>

        <nav id="section-nav">
            <ul>
                <li><a href="#" data-section="0">Accueil</a></li>
                <li><a href="#architecture" data-section="1">Architecture</a></li>
                <li><a href="#patrimoine" data-section="2">Patrimoine</a></li>
                <li><a href="#jardins" data-section="3">Jardins</a></li>
                <li><a href="#events" data-section="4">Événements</a></li>
                <li><a href="#testimonials" data-section="5">Témoignages</a></li>
                <li><a href="#newsletter" data-section="6">Newsletter</a></li>
            </ul>
        </nav>

        <!-- Hero Section -->
        <section class="hero">
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

        <!-- Architecture Section -->
        <section class="theme-section" id="architecture">
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

        <!-- Patrimoine Section -->
        <section class="theme-section" id="patrimoine">
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

        <!-- Jardins Section -->
        <section class="theme-section" id="jardins">
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
        <div class="testimonials">
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
        <div class="newsletter">
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

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            // Navigation menu
            const sectionNav = document.querySelectorAll('#section-nav a');

            // Mise à jour de la classe active sur le menu de navigation
            function updateActiveNav() {
                const sections = document.querySelectorAll('.section, #events, #testimonials, #newsletter');
                let current = '';

                sections.forEach((section, index) => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= (sectionTop - sectionHeight / 3)) {
                        current = section.getAttribute('id') || index;
                    }
                });

                sectionNav.forEach(link => {
                    link.classList.remove('active');
                    const section = link.getAttribute('data-section');
                    if (section == current || link.getAttribute('href').substring(1) === current) {
                        link.classList.add('active');
                    }
                });
            }

            // Ajouter la fonctionnalité de clic aux liens de navigation
            sectionNav.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const section = this.getAttribute('data-section');
                    if (section) {
                        fullpage_api.moveTo(parseInt(section) + 1);
                    } else {
                        const target = this.getAttribute('href').substring(1);
                        const element = document.getElementById(target);
                        window.scrollTo({
                            top: element.offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Mettre à jour la navigation active lors du défilement
            window.addEventListener('scroll', updateActiveNav);
            // Activer la première entrée par défaut
            updateActiveNav();

            new fullpage('#fullpage', {
                licenseKey: null,
                autoScrolling: true,
                scrollHorizontally: false,
                navigation: false, // Désactiver la navigation par défaut car nous utilisons notre propre menu
                scrollingSpeed: 1000,
                fitToSection: true,
                scrollBar: false,
                css3: true,
                normalScrollElements: '.events, .testimonials, .newsletter',
                onLeave: function(origin, destination, direction) {
                    updateActiveNav();
                },
                afterLoad: function(origin, destination, direction) {
                    if (destination.item.classList.contains('section')) {
                        AOS.refresh();
                    }
                }
            });

            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });

            // Section-by-section scrolling
            let currentSection = 0;
            const sections = document.querySelectorAll('section');
            let isScrolling = false;
            let scrollTimeout;

            function scrollToSection(index) {
                if (index >= 0 && index < sections.length) {
                    sections[index].scrollIntoView({
                        behavior: 'smooth'
                    });
                    currentSection = index;
                }
            }

            window.addEventListener('wheel', (e) => {
                e.preventDefault();

                if (isScrolling) return;

                isScrolling = true;
                clearTimeout(scrollTimeout);

                if (e.deltaY > 0) {
                    scrollToSection(currentSection + 1);
                } else {
                    scrollToSection(currentSection - 1);
                }

                scrollTimeout = setTimeout(() => {
                    isScrolling = false;
                }, 1000);
            }, {
                passive: false
            });

            // Handle keyboard navigation
            window.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowDown' || e.key === 'PageDown') {
                    e.preventDefault();
                    scrollToSection(currentSection + 1);
                } else if (e.key === 'ArrowUp' || e.key === 'PageUp') {
                    e.preventDefault();
                    scrollToSection(currentSection - 1);
                }
            });

            // Update current section on scroll
            window.addEventListener('scroll', () => {
                const scrollPosition = window.scrollY;
                sections.forEach((section, index) => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    if (scrollPosition >= sectionTop - sectionHeight / 3) {
                        currentSection = index;
                    }
                });
            });

            // Testimonial Slider
            const testimonialTrack = document.querySelector('.testimonial-track');
            const dots = document.querySelectorAll('.dot');
            let currentSlide = 0;
            let interval;

            function goToSlide(index) {
                currentSlide = index;
                testimonialTrack.style.transform = `translateX(-${currentSlide * 100}%)`;

                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentSlide);
                });
            }

            function startAutoSlide() {
                interval = setInterval(() => {
                    const next = (currentSlide + 1) % dots.length;
                    goToSlide(next);
                }, 5000);
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    clearInterval(interval);
                    goToSlide(index);
                    startAutoSlide();
                });
            });

            startAutoSlide();
        </script>
    </div>
</body>

</html>