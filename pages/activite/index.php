<?php
require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$query = "SELECT * FROM all_activites";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Activités</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
    <script src="https://hammerjs.github.io/dist/hammer.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #3a791f;
            --secondary-color: #8ac571;
            --primary-color-red: #e53e3e;
            --secondary-color-red: #fc8181;
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
            display: flex;
            flex-direction: column;
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

        .page-title {
            color: var(--primary-color-red);
            text-align: center;
            margin: 150px 0 30px;
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .activities-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px;
            flex: 1;
        }

        .activity-card {
            background: #E7E3D9;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(58, 121, 31, 0.1);
            display: flex;
            flex-direction: column;
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .activity-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 50px;
            padding: 10px;
            box-sizing: border-box;
        }

        .activity-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .activity-date {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .activity-title {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .activity-location {
            color: #3A791F;
            font-size: 0.9rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
            justify-content: center;
            flex-grow: 1;
        }

        .activity-adresse {
            text-align: center;
            font-size: 1rem;
        }

        .activity-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .activity-details {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #666;
        }

        .activity-detail {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .activity-price {
            color: var(--primary-color-red);
            font-weight: 600;
        }

        .activity-link {
            display: block;
            padding: 10px 20px;
            background: var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease;
            text-align: center;
            font-weight: bold;
            margin: 20px auto 0 auto;
            margin-top: auto;
        }

        .activity-link:hover {
            background: var(--secondary-color);
        }

        .mobile-swipe-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--light-bg);
            z-index: 1000;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .swipe-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 400px;
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .swipe-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .swipe-content {
            padding: 20px;
        }

        .swipe-actions {
            position: fixed;
            bottom: 40px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .swipe-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: none;
            background: var(--white);
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .swipe-button:hover {
            transform: scale(1.1);
        }

        .swipe-button i {
            font-size: 24px;
        }

        .swipe-button.like {
            color: var(--primary-color);
        }

        .swipe-button.skip {
            color: var(--primary-color-red);
        }

        @media (max-width: 768px) {
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                background: var(--white);
                box-shadow: var(--shadow-sm);
            }

            .page-title {
                margin-top: 120px;
            }

            .activities-container {
                margin-top: 20px;
            }

            .activities-container {
                display: none;
            }

            .mobile-swipe-container {
                display: block;
            }
        }

        .bottom-illustrations {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            pointer-events: none;
            z-index: 1;
        }

        .bottom-illustration {
            width: 300px;
            height: auto;
            opacity: 0.8;
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
            color: var(--primary-color-red);
            filter: drop-shadow(0 0 10px rgba(229, 62, 62, 0.3));
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
            color: var(--primary-color-red);
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: -5s;
            color: var(--secondary-color-red);
        }

        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 15%;
            animation-delay: -10s;
            color: var(--primary-color-red);
        }

        .floating-element:nth-child(4) {
            bottom: 20%;
            right: 20%;
            animation-delay: -15s;
            color: var(--secondary-color-red);
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

        @media (max-width: 768px) {
            .bottom-illustrations {
                display: none;
            }
        }

        .filters-container {
            max-width: 1400px;
            margin: 0 auto 40px;
            padding: 20px;
            background: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow-sm);
        }

        .filters {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
            font-weight: 500;
        }

        .filter-group select {
            width: 100%;
            padding: 10px;
            border: 2px solid var(--secondary-color);
            border-radius: 8px;
            font-family: "Poppins", sans-serif;
            color: var(--text-color);
            background: var(--white);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-group select:hover {
            border-color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .filters {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
            }
        }

        .info-tooltip {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .info-tooltip i {
            font-size: clamp(20px, 4vw, 24px);
            color: #a259e6;
            cursor: help;
        }

        .tooltip-text {
            visibility: hidden;
            width: min(300px, 90vw);
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 10px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: clamp(0.5rem, 1.5vw, 0.7rem);
        }

        .info-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>

    <div class="floating-elements">
        <i class="fas fa-hiking floating-element"></i>
        <i class="fas fa-mountain floating-element"></i>
        <i class="fas fa-campground floating-element"></i>
        <i class="fas fa-tree floating-element"></i>
    </div>

    <h1 class="page-title">
        <i class="fas fa-hiking"></i>
        Nos Activités
        <div class="info-tooltip">
            <i class="fas fa-question-circle"></i>
            <span class="tooltip-text">Malheuresement, il est impossible pour nous de toujours proposer des activités proche de chez vous. Mais restez restez à l'affût.</span>
        </div>
    </h1>

    <div class="filters-container">
        <div class="filters">
            <div class="filter-group">
                <label for="region-filter">Région</label>
                <select id="region-filter">
                    <option value="all">Toutes les régions</option>
                    <?php
                    $regions_query = "SELECT DISTINCT region FROM all_activites ORDER BY region";
                    $regions_result = mysqli_query($link, $regions_query);
                    while ($region = mysqli_fetch_assoc($regions_result)) {
                        echo '<option value="' . strtolower($region['region']) . '">' . htmlspecialchars($region['region']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="architecture-filter">Type d'architecture</label>
                <select id="architecture-filter">
                    <option value="all">Tous les types</option>
                    <?php
                    $architecture_query = "SELECT DISTINCT type_architecture FROM all_activites ORDER BY type_architecture";
                    $architecture_result = mysqli_query($link, $architecture_query);
                    while ($architecture = mysqli_fetch_assoc($architecture_result)) {
                        echo '<option value="' . strtolower($architecture['type_architecture']) . '">' . htmlspecialchars($architecture['type_architecture']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="type-lieu-filter">Type de lieu</label>
                <select id="type-lieu-filter">
                    <option value="all">Tous les types</option>
                    <?php
                    $type_lieu_query = "SELECT DISTINCT type_lieu FROM all_activites ORDER BY type_lieu";
                    $type_lieu_result = mysqli_query($link, $type_lieu_query);
                    while ($type_lieu = mysqli_fetch_assoc($type_lieu_result)) {
                        echo '<option value="' . strtolower($type_lieu['type_lieu']) . '">' . htmlspecialchars($type_lieu['type_lieu']) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="activities-container">
        <?php while ($activity = mysqli_fetch_assoc($result)): ?>
            <div class="activity-card"
                data-location="<?php echo strtolower($activity['nom_lieu']); ?>"
                data-region="<?php echo strtolower($activity['region']); ?>"
                data-architecture="<?php echo strtolower($activity['type_architecture']); ?>"
                data-type-lieu="<?php echo strtolower($activity['type_lieu']); ?>">
                <img src="../<?php echo htmlspecialchars($activity['image']); ?>"
                    alt="<?php echo htmlspecialchars($activity['titre']); ?>"
                    class="activity-image">
                <div class="activity-content">

                    <h3 class="activity-title" style="text-align: center;"><?php echo htmlspecialchars($activity['titre']); ?></h3>
                    <p style="text-align: center;"><?php echo htmlspecialchars($activity['adresse']); ?></p>
                    <div class="activity-location">

                        <?php echo htmlspecialchars($activity['region']); ?>
                        <i class="fas fa-map-marker-alt"></i>
                    </div>


                    <a href="details.php?id=<?php echo $activity['id']; ?>" class="activity-link">
                        En savoir plus
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="mobile-swipe-container">
        <div class="swipe-card">
            <img src="" alt="" class="swipe-image">
            <div class="swipe-content">
                <h3 class="activity-title"></h3>
                <div class="activity-location"></div>
                <p class="activity-adresse"></p>
                <p class="activity-description"></p>
            </div>
        </div>
        <div class="swipe-actions">
            <button class="swipe-button skip">
                <i class="fas fa-times"></i>
            </button>
            <button class="swipe-button like">
                <i class="fas fa-heart"></i>
            </button>
        </div>
    </div>

    <?php include '../../includes/layout/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const activities = <?php
                                mysqli_data_seek($result, 0);
                                echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
                                ?>;
            let currentIndex = 0;
            const swipeCard = document.querySelector('.swipe-card');
            const swipeImage = swipeCard.querySelector('.swipe-image');
            const swipeContent = swipeCard.querySelector('.swipe-content');
            const likeButton = document.querySelector('.swipe-button.like');
            const skipButton = document.querySelector('.swipe-button.skip');

            function updateSwipeCard() {
                if (currentIndex >= activities.length) {
                    currentIndex = 0;
                }

                const activity = activities[currentIndex];
                swipeImage.src = "../" + activity.image;
                swipeImage.alt = activity.titre;
                swipeContent.querySelector('.activity-title').textContent = activity.titre;
                swipeContent.querySelector('.activity-location').innerHTML = `
                    <i class="fas fa-map-marker-alt"></i>
                    ${activity.region}
                `;
                swipeContent.querySelector('.activity-adresse').innerHTML = `
                    ${activity.adresse}
                `;
                swipeContent.querySelector('.activity-description').textContent = activity.description;
            }

            function nextCard() {
                currentIndex++;
                updateSwipeCard();
            }

            function handleSwipe(direction) {
                if (direction === 'right') {
                    window.location.href = `details.php?id=${activities[currentIndex].id}`;
                } else {
                    nextCard();
                }
            }

            const hammer = new Hammer(swipeCard);
            hammer.on('swipeleft swiperight', function(e) {
                handleSwipe(e.direction === Hammer.DIRECTION_RIGHT ? 'right' : 'left');
            });

            likeButton.addEventListener('click', () => handleSwipe('right'));
            skipButton.addEventListener('click', () => handleSwipe('left'));

            updateSwipeCard();

            const regionFilter = document.getElementById('region-filter');
            const architectureFilter = document.getElementById('architecture-filter');
            const typeLieuFilter = document.getElementById('type-lieu-filter');
            const activityCards = document.querySelectorAll('.activity-card');

            function filterActivities() {
                const selectedRegion = regionFilter.value;
                const selectedArchitecture = architectureFilter.value;
                const selectedTypeLieu = typeLieuFilter.value;

                activityCards.forEach(card => {
                    const cardRegion = card.dataset.region;
                    const cardArchitecture = card.dataset.architecture;
                    const cardTypeLieu = card.dataset.typeLieu;
                    let showCard = true;


                    if (selectedRegion !== 'all' && showCard) {
                        showCard = showCard && cardRegion === selectedRegion;
                    }

                    if (selectedArchitecture !== 'all' && showCard) {
                        showCard = showCard && cardArchitecture === selectedArchitecture;
                    }

                    if (selectedTypeLieu !== 'all' && showCard) {
                        showCard = showCard && cardTypeLieu === selectedTypeLieu;
                    }

                    card.style.display = showCard ? 'block' : 'none';
                });
            }

            regionFilter.addEventListener('change', filterActivities);
            architectureFilter.addEventListener('change', filterActivities);
            typeLieuFilter.addEventListener('change', filterActivities);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const colors = ['#FF3131', '#3A791F', '#9D9581', '#853FD4'];
            const activityLinks = document.querySelectorAll('.activity-link');

            activityLinks.forEach(link => {
                const randomColor = colors[Math.floor(Math.random() * colors.length)];
                link.style.backgroundColor = randomColor;
                link.style.borderColor = randomColor;
            });
        });
    </script>
</body>

</html>