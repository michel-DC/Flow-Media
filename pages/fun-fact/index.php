<?php

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");
if (mysqli_connect_errno()) {
    die("Échec de la connexion à MySQL: " . mysqli_connect_error());
}

$query = "SELECT * FROM fun_fact ORDER BY id DESC";
$result = mysqli_query($link, $query);

if (!$result) {
    die("Erreur de requête : " . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Fun facts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #e53e3e;
            --secondary-color: #fc8181;
            --accent-color: #ff6b6b;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: var(--light-bg);
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 10% 20%, rgba(252, 129, 129, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(255, 107, 107, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 50% 50%, rgba(229, 62, 62, 0.05) 0%, transparent 30%);
            pointer-events: none;
            z-index: -1;
        }

        .page-header {
            position: relative;
            padding: clamp(60px, 15vh, 120px) 20px clamp(30px, 8vh, 60px);
            text-align: center;
            background: linear-gradient(135deg,
                    var(--primary-color) 0%,
                    #f56565 25%,
                    #ff6b6b 75%,
                    #ff4757 100%);
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
            margin-bottom: clamp(20px, 5vh, 40px);
        }

        .page-title {
            color: var(--secondary-color);
            font-size: clamp(1.8rem, 5vw, 4rem);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: clamp(10px, 2vw, 20px);
            text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.2);
        }

        .page-title i {
            font-size: clamp(1.5rem, 4vw, 3.5rem);
            animation: pulse 2s infinite;
        }

        .fun-facts-container {
            position: relative;
            width: min(1400px, 95%);
            margin: 0 auto;
            padding: clamp(15px, 3vw, 40px);
            background: var(--white);
            border-radius: clamp(15px, 3vw, 30px);
            box-shadow: var(--shadow-md);
            margin-top: clamp(200px, 15vh, 300px);
        }

        .fun-facts-container::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 40px;
            z-index: -1;
            opacity: 0.1;
        }

        .carousel-container {
            position: relative;
            width: 100%;
            height: clamp(300px, 50vh, 700px);
            border-radius: clamp(10px, 2vw, 20px);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transform: perspective(1000px) rotateX(5deg);
            transition: transform 0.3s ease;
        }

        .carousel-container:hover {
            transform: perspective(1000px) rotateX(0deg);
        }

        .fun-fact-card {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: all 0.5s ease;
            transform: translateX(100%);
        }

        .fun-fact-card.active {
            opacity: 1;
            transform: translateX(0);
        }

        .fun-fact-card.prev {
            transform: translateX(-100%);
        }

        .fun-fact-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: relative;
            display: block;
        }

        .fun-fact-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: clamp(15px, 3vw, 50px);
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
            color: var(--white);
            z-index: 2;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .fun-fact-card.active .fun-fact-content {
            transform: translateY(0);
        }

        .fun-fact-title {
            font-size: clamp(1.2rem, 3vw, 2.2rem);
            font-weight: 700;
            margin-bottom: clamp(8px, 2vw, 15px);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .fun-fact-details {
            display: flex;
            flex-wrap: wrap;
            gap: clamp(8px, 2vw, 20px);
            margin: clamp(10px, 2vw, 20px) 0;
        }

        .fun-fact-detail {
            display: flex;
            align-items: center;
            gap: clamp(5px, 1vw, 10px);
            background: rgba(255, 255, 255, 0.15);
            padding: clamp(8px, 1.5vw, 12px) clamp(12px, 2vw, 20px);
            border-radius: 30px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .fun-fact-detail:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.25);
        }

        .fun-fact-detail i {
            color: var(--secondary-color);
        }

        .fun-fact-story {
            font-size: clamp(0.9rem, 2vw, 1.2rem);
            line-height: 1.6;
            margin-top: clamp(10px, 2vw, 20px);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .additional-content {
            width: min(1200px, 95%);
            margin: clamp(30px, 5vh, 50px) auto;
            padding: 0 clamp(15px, 3vw, 20px);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 300px), 1fr));
            gap: clamp(15px, 3vw, 30px);
            margin-top: clamp(20px, 4vh, 40px);
        }

        .info-card {
            background: var(--white);
            padding: clamp(15px, 3vw, 30px);
            border-radius: clamp(10px, 2vw, 15px);
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-card i {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            color: var(--primary-color);
            margin-bottom: clamp(10px, 2vw, 20px);
        }

        .info-card h3 {
            color: var(--primary-color);
            margin-bottom: clamp(8px, 1.5vw, 15px);
        }

        .info-card p {
            color: var(--text-color);
            line-height: 1.5;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: clamp(35px, 8vw, 60px);
            height: clamp(35px, 8vw, 60px);
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .carousel-nav:hover {
            transform: translateY(-50%) scale(1.1);
            background: var(--white);
        }

        .carousel-nav.prev {
            left: clamp(10px, 2vw, 20px);
        }

        .carousel-nav.next {
            right: clamp(10px, 2vw, 20px);
        }

        .carousel-dots {
            position: absolute;
            bottom: clamp(10px, 2vw, 30px);
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: clamp(8px, 1.5vw, 15px);
            z-index: 10;
        }

        .dot {
            width: clamp(8px, 1.5vw, 15px);
            height: clamp(8px, 1.5vw, 15px);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        .dot.active {
            background: var(--accent-color);
            transform: scale(1.2);
            box-shadow: 0 0 20px var(--accent-color);
        }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            font-size: clamp(3rem, 8vw, 8rem);
            opacity: 0.15;
            animation: float 20s linear infinite;
            color: var(--primary-color);
            filter: drop-shadow(0 0 10px rgba(58, 121, 31, 0.3));
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
            color: var(--primary-color);
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: -5s;
            color: var(--secondary-color);
        }

        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 15%;
            animation-delay: -10s;
            color: var(--accent-color);
        }

        .floating-element:nth-child(4) {
            bottom: 20%;
            right: 20%;
            animation-delay: -15s;
            color: var(--primary-color);
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg) scale(1);
            }

            50% {
                transform: translate(30px, 30px) rotate(180deg) scale(1.1);
            }

            100% {
                transform: translate(0, 0) rotate(360deg) scale(1);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        @media (max-width: 480px) {
            .carousel-nav {
                display: none;
            }

            .fun-fact-details {
                flex-direction: column;
            }

            .fun-fact-detail {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>

    <div class="floating-elements">
        <i class="fas fa-paint-brush floating-element"></i>
        <i class="fas fa-palette floating-element"></i>
        <i class="fas fa-spray-can floating-element"></i>
        <i class="fas fa-image floating-element"></i>
    </div>

    <div class="fun-facts-container">
        <h1 class="page-title">
            <i class="fas fa-lightbulb"></i>
            Fun Facts
        </h1>
        <div class="carousel-container">
            <?php
            mysqli_data_seek($result, 0);
            $index = 0;
            while ($affiche = mysqli_fetch_assoc($result)):
            ?>
                <div class="fun-fact-card <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                    <?php if (isset($affiche['image_url']) && !empty($affiche['image_url'])): ?>
                        <img src="../<?php echo htmlspecialchars($affiche['image_url']); ?>"
                            alt="<?php echo htmlspecialchars($affiche['nom']); ?>"
                            class="fun-fact-image">
                    <?php endif; ?>
                    <div class="fun-fact-content">
                        <h2 class="fun-fact-title"><?php echo htmlspecialchars($affiche['nom']); ?></h2>
                        <div class="fun-fact-details">
                            <div class="fun-fact-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo htmlspecialchars($affiche['adresse']); ?></span>
                            </div>
                            <div class="fun-fact-detail">
                                <i class="fas fa-user"></i>
                                <span><?php echo htmlspecialchars($affiche['createur']); ?></span>
                            </div>
                            <div class="fun-fact-detail">
                                <i class="fas fa-palette"></i>
                                <span><?php echo htmlspecialchars($affiche['style']); ?></span>
                            </div>
                        </div>
                        <p class="fun-fact-story"><?php echo htmlspecialchars($affiche['histoire']); ?></p>
                    </div>
                </div>
            <?php
                $index++;
            endwhile;
            ?>
            <div class="carousel-nav prev">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="carousel-nav next">
                <i class="fas fa-chevron-right"></i>
            </div>
            <div class="carousel-dots">
                <?php
                mysqli_data_seek($result, 0);
                $dotIndex = 0;
                while (mysqli_fetch_assoc($result)):
                ?>
                    <div class="dot <?php echo $dotIndex === 0 ? 'active' : ''; ?>" data-index="<?php echo $dotIndex; ?>"></div>
                <?php
                    $dotIndex++;
                endwhile;
                ?>
            </div>
        </div>
    </div>

    <div class="additional-content">
        <h2 class="section-title">Pourquoi les Fun Facts ?</h2>
        <div class="info-grid">
            <div class="info-card">
                <i class="fas fa-book-open"></i>
                <h3>Histoire Vivante</h3>
                <p>Chaque œuvre raconte une histoire unique, témoignant de la richesse culturelle de notre ville et de ses artistes.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-paint-brush"></i>
                <h3>Art Urbain</h3>
                <p>L'art urbain transforme nos rues en galeries à ciel ouvert, créant un dialogue entre l'artiste et le public.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-users"></i>
                <h3>Communauté</h3>
                <p>Ces œuvres rassemblent les communautés et créent des espaces de partage et d'échange culturel.</p>
            </div>
        </div>
    </div>

    <?php include '../../includes/layout/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.fun-fact-card');
            const dots = document.querySelectorAll('.dot');
            const prevBtn = document.querySelector('.carousel-nav.prev');
            const nextBtn = document.querySelector('.carousel-nav.next');
            let currentIndex = 0;

            function updateCarousel(index) {
                cards.forEach(card => {
                    card.classList.remove('active', 'prev');
                });
                dots.forEach(dot => {
                    dot.classList.remove('active');
                });

                cards[index].classList.add('active');
                dots[index].classList.add('active');

                if (index > 0) {
                    cards[index - 1].classList.add('prev');
                }
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % cards.length;
                updateCarousel(currentIndex);
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + cards.length) % cards.length;
                updateCarousel(currentIndex);
            }

            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel(currentIndex);
                });
            });

            // Auto-advance slides every 5 seconds
            setInterval(nextSlide, 25000);

            // Touch events for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            document.querySelector('.carousel-container').addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            });

            document.querySelector('.carousel-container').addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                if (touchEndX < touchStartX - swipeThreshold) {
                    nextSlide();
                }
                if (touchEndX > touchStartX + swipeThreshold) {
                    prevSlide();
                }
            }
        });
    </script>
</body>

</html>