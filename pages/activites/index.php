<?php
require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$query = "SELECT * FROM activites ORDER BY date_activite DESC";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Activités</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            flex: 1;
        }

        .activity-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(58, 121, 31, 0.1);
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .activity-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .activity-content {
            padding: 20px;
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
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .activity-location {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
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
            display: inline-block;
            padding: 10px 20px;
            background: var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease;
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
        }

        .swipe-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
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
            max-width: 1200px;
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
                <label for="date-filter">Date</label>
                <select id="date-filter">
                    <option value="all">Toutes les dates</option>
                    <option value="this-month">Ce mois</option>
                    <option value="next-month">Mois prochain</option>
                    <option value="next-3-months">3 prochains mois</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="location-filter">Lieu</label>
                <select id="location-filter">
                    <option value="all">Tous les lieux</option>
                    <?php
                    $locations_query = "SELECT DISTINCT lieu FROM activites ORDER BY lieu";
                    $locations_result = mysqli_query($link, $locations_query);
                    while ($location = mysqli_fetch_assoc($locations_result)) {
                        echo '<option value="' . strtolower($location['lieu']) . '">' . htmlspecialchars($location['lieu']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="price-filter">Prix</label>
                <select id="price-filter">
                    <option value="all">Tous les prix</option>
                    <option value="0-20">0-20€</option>
                    <option value="20-50">20-50€</option>
                    <option value="50-100">50-100€</option>
                    <option value="100+">100€ et plus</option>
                </select>
            </div>
        </div>
    </div>

    <div class="activities-container">
        <?php while ($activity = mysqli_fetch_assoc($result)): ?>
            <div class="activity-card"
                data-date="<?php echo $activity['date_activite']; ?>"
                data-location="<?php echo strtolower($activity['lieu']); ?>"
                data-price="<?php echo $activity['prix']; ?>">
                <img src="../<?php echo htmlspecialchars($activity['image_url']); ?>"
                    alt="<?php echo htmlspecialchars($activity['titre']); ?>"
                    class="activity-image">
                <div class="activity-content">
                    <div class="activity-date">
                        <i class="far fa-calendar"></i>
                        <?php echo date('d/m/Y', strtotime($activity['date_activite'])); ?>
                    </div>
                    <h3 class="activity-title"><?php echo htmlspecialchars($activity['titre']); ?></h3>
                    <div class="activity-location">

                        <?php echo htmlspecialchars($activity['lieu']); ?>
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <p class="activity-description"><?php echo htmlspecialchars($activity['description']); ?></p>
                    <div class="activity-details">
                        <div class="activity-detail">
                            <i class="fas fa-user"></i>
                            <?php echo $activity['age_min']; ?>-<?php echo $activity['age_max']; ?> ans
                        </div>
                        <div class="activity-detail activity-price">
                            <i class="fas fa-euro-sign"></i>
                            <?php echo number_format($activity['prix'], 2); ?>
                        </div>
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
                <div class="activity-date"></div>
                <h3 class="activity-title"></h3>
                <div class="activity-location"></div>
                <p class="activity-description"></p>
                <div class="activity-details">
                    <div class="activity-detail age-range"></div>
                    <div class="activity-detail activity-price"></div>
                </div>
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
                swipeImage.src = "../" + activity.image_url;
                swipeImage.alt = activity.titre;
                swipeContent.querySelector('.activity-date').innerHTML = `
                    <i class="far fa-calendar"></i>
                    ${new Date(activity.date_activite).toLocaleDateString()}
                `;
                swipeContent.querySelector('.activity-title').textContent = activity.titre;
                swipeContent.querySelector('.activity-location').innerHTML = `
                    <i class="fas fa-map-marker-alt"></i>
                    ${activity.lieu}
                `;
                swipeContent.querySelector('.activity-description').textContent = activity.description;
                swipeContent.querySelector('.age-range').innerHTML = `
                    <i class="fas fa-user"></i>
                    ${activity.age_min}-${activity.age_max} ans
                `;
                swipeContent.querySelector('.activity-price').innerHTML = `
                    <i class="fas fa-euro-sign"></i>
                    ${parseFloat(activity.prix).toFixed(2)}
                `;
            }

            function nextCard() {
                currentIndex++;
                updateSwipeCard();
            }

            function handleSwipe(direction) {
                if (direction === 'right') {
                    window.location.href = `reservation.php?id=${activities[currentIndex].id}`;
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

            const dateFilter = document.getElementById('date-filter');
            const locationFilter = document.getElementById('location-filter');
            const priceFilter = document.getElementById('price-filter');
            const activityCards = document.querySelectorAll('.activity-card');

            function filterActivities() {
                const selectedDate = dateFilter.value;
                const selectedLocation = locationFilter.value;
                const selectedPrice = priceFilter.value;

                activityCards.forEach(card => {
                    const cardDate = new Date(card.dataset.date);
                    const cardLocation = card.dataset.location;
                    const cardPrice = parseFloat(card.dataset.price);
                    let showCard = true;

                    if (selectedDate !== 'all') {
                        const today = new Date();
                        const threeMonthsFromNow = new Date();
                        threeMonthsFromNow.setMonth(today.getMonth() + 3);

                        switch (selectedDate) {
                            case 'this-month':
                                showCard = cardDate.getMonth() === today.getMonth() &&
                                    cardDate.getFullYear() === today.getFullYear();
                                break;
                            case 'next-month':
                                const nextMonth = new Date(today);
                                nextMonth.setMonth(today.getMonth() + 1);
                                showCard = cardDate.getMonth() === nextMonth.getMonth() &&
                                    cardDate.getFullYear() === nextMonth.getFullYear();
                                break;
                            case 'next-3-months':
                                showCard = cardDate >= today && cardDate <= threeMonthsFromNow;
                                break;
                        }
                    }

                    if (selectedLocation !== 'all' && showCard) {
                        showCard = cardLocation === selectedLocation;
                    }

                    if (selectedPrice !== 'all' && showCard) {
                        const [min, max] = selectedPrice.split('-').map(Number);
                        if (max) {
                            showCard = cardPrice >= min && cardPrice <= max;
                        } else {
                            showCard = cardPrice >= min;
                        }
                    }

                    card.style.display = showCard ? 'block' : 'none';
                });
            }

            dateFilter.addEventListener('change', filterActivities);
            locationFilter.addEventListener('change', filterActivities);
            priceFilter.addEventListener('change', filterActivities);
        });
    </script>
</body>

</html>