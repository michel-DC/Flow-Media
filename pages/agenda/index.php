<?php

require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$query = "SELECT * FROM evenements_culturels ORDER BY date_evenement ASC";
$result = mysqli_query($link, $query);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Agenda Culturel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
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
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 10% 20%, rgba(138, 197, 113, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(58, 121, 31, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 50% 50%, rgba(46, 125, 50, 0.05) 0%, transparent 30%);
            pointer-events: none;
            z-index: -1;
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

        .events-container {
            max-width: 1200px;
            margin: 0 auto 100px;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .event-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .event-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .event-content {
            padding: 20px;
        }

        .event-date {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .event-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .event-location {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .event-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .event-tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .event-tag {
            background: var(--secondary-color);
            color: var(--white);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .event-link {
            display: block;
            margin-top: 10px;
            text-align: right;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
                margin: 100px 0 20px;
            }

            .filters {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
            }

            .events-container {
                grid-template-columns: 1fr;
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
            transition: transform 0.3s ease;
        }

        .bottom-illustration.left {
            margin-left: 20px;
        }

        .bottom-illustration.right {
            margin-right: 20px;
        }

        @media (max-width: 768px) {
            .bottom-illustrations {
                display: none;
                /* Cache les illustrations sur mobile */
            }
        }

        @media (max-width: 480px) {
            .bottom-illustration {
                width: 160px;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>

    <h1 class="page-title">
        <i class="fas fa-calendar-alt"></i>
        Agenda Culturel
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
                    <option value="paris">Paris</option>
                    <option value="lyon">Lyon</option>
                    <option value="marseille">Marseille</option>
                    <option value="bordeaux">Bordeaux</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="category-filter">Catégorie</label>
                <select id="category-filter">
                    <option value="all">Toutes les catégories</option>
                    <option value="architecture">Architecture</option>
                    <option value="patrimoine">Patrimoine</option>
                    <option value="jardins">Jardins</option>
                </select>
            </div>
        </div>
    </div>

    <div class="events-container">
        <?php
        while ($event = mysqli_fetch_assoc($result)):
        ?>
            <div class="event-card" data-date="<?php echo $event['date_evenement']; ?>"
                data-location="<?php echo strtolower($event['ville']); ?>"
                data-category="<?php echo strtolower($event['categorie']); ?>">
                <img src="<?php echo htmlspecialchars($event['image_url']); ?>"
                    alt="<?php echo htmlspecialchars($event['titre']); ?>"
                    class="event-image">
                <div class="event-content">
                    <div class="event-date">
                        <i class="far fa-calendar"></i>
                        <?php echo date('d/m/Y', strtotime($event['date_evenement'])); ?>
                    </div>
                    <h3 class="event-title"><?php echo htmlspecialchars($event['titre']); ?></h3>
                    <div class="event-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <?php echo htmlspecialchars($event['ville']); ?>
                    </div>
                    <p class="event-description"><?php echo htmlspecialchars($event['description']); ?></p>
                    <div class="event-tags">
                        <span class="event-tag"><?php echo htmlspecialchars($event['categorie']); ?></span>
                    </div>
                    <?php if (!empty($event['lien_web'])): ?>
                        <a href="<?php echo htmlspecialchars($event['lien_web']); ?>"
                            class="event-link"
                            target="_blank"
                            rel="noopener noreferrer">
                            <i class="fas fa-external-link-alt"></i>
                            Site officiel
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="bottom-illustrations">
        <img src="../../assets/images/svg/family-1-12.svg" alt="Family illustration" class="bottom-illustration left">
        <img src="../../assets/images/svg/adventure-95.svg" alt="Adventure illustration" class="bottom-illustration right">
    </div>

    <?php include '../../includes/layout/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateFilter = document.getElementById('date-filter');
            const locationFilter = document.getElementById('location-filter');
            const categoryFilter = document.getElementById('category-filter');
            const eventCards = document.querySelectorAll('.event-card');

            function filterEvents() {
                const selectedDate = dateFilter.value;
                const selectedLocation = locationFilter.value;
                const selectedCategory = categoryFilter.value;

                eventCards.forEach(card => {
                    const cardDate = new Date(card.dataset.date);
                    const cardLocation = card.dataset.location;
                    const cardCategory = card.dataset.category;
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

                    if (selectedCategory !== 'all' && showCard) {
                        showCard = cardCategory === selectedCategory;
                    }

                    card.style.display = showCard ? 'block' : 'none';
                });
            }

            dateFilter.addEventListener('change', filterEvents);
            locationFilter.addEventListener('change', filterEvents);
            categoryFilter.addEventListener('change', filterEvents);
        });
    </script>
</body>

</html>