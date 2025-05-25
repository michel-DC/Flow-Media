<?php
require_once '../../includes/auth.php';

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
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #3a791f;
            --secondary-color: #8ac571;
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

        .page-title {
            color: var(--primary-color);
            text-align: center;
            margin: 150px 0 30px;
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .fun-facts-container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto 40px;
            padding: 20px;
            overflow: hidden;
        }

        .carousel-container {
            position: relative;
            width: 100%;
            height: 600px;
        }

        .fun-fact-card {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
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

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .carousel-nav:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-nav.prev {
            left: 20px;
        }

        .carousel-nav.next {
            right: 20px;
        }

        .carousel-nav i {
            font-size: 24px;
            color: var(--primary-color);
        }

        .carousel-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: var(--white);
            transform: scale(1.2);
        }

        .fun-fact-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: var(--white);
            z-index: 2;
        }

        .fun-fact-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .fun-fact-details {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .fun-fact-detail {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .fun-fact-detail i {
            color: var(--secondary-color);
        }

        .fun-fact-story {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-top: 15px;
        }

        @media (max-width: 1200px) {
            .fun-facts-container {
                max-width: 90%;
            }
        }

        @media (max-width: 992px) {
            .carousel-container {
                height: 500px;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
                margin: 80px 0 20px;
            }

            .fun-facts-container {
                margin: 0 auto 20px;
            }

            .carousel-container {
                height: 450px;
            }

            .carousel-nav {
                width: 40px;
                height: 40px;
            }

            .carousel-nav i {
                font-size: 20px;
            }

            .fun-fact-title {
                font-size: 1.5rem;
            }

            .fun-fact-details {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.8rem;
                margin: 40px 0 15px;
            }

            .carousel-container {
                height: 400px;
            }

            .fun-fact-content {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.5rem;
                gap: 10px;
                margin-top: 100px;
            }

            .carousel-container {
                height: 350px;
                margin-top: 200px;
            }

            .carousel-nav {
                width: 35px;
                height: 35px;
                display: none;
            }

            .carousel-nav i {
                display: none;
            }

            .fun-fact-title {
                font-size: 1.2rem;
            }

            .fun-fact-story {
                font-size: 0.9rem;
            }

            .carousel-dots {
                width: 10px;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>

    <h1 class="page-title">
        <i class="fas fa-lightbulb"></i>
        Quelques fun facts
    </h1>

    <div class="fun-facts-container">
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
            setInterval(nextSlide, 20000);

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