<?php
require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$query = "SELECT * FROM activites ORDER BY date_activite ASC";
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

        .activities-container {
            max-width: 1200px;
            margin: 0 auto 100px;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .activity-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
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
            color: var(--primary-color);
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
            color: #666;
        }

        @media (max-width: 768px) {
            .activities-container {
                display: none;
            }

            .mobile-swipe-container {
                display: block;
            }

            .page-title {
                font-size: 2rem;
                margin: 100px 0 20px;
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

        @media (max-width: 768px) {
            .bottom-illustrations {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>

    <h1 class="page-title">
        <i class="fas fa-hiking"></i>
        Nos Activités
    </h1>

    <div class="activities-container">
        <?php while ($activity = mysqli_fetch_assoc($result)): ?>
            <div class="activity-card">
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
                        <i class="fas fa-map-marker-alt"></i>
                        <?php echo htmlspecialchars($activity['lieu']); ?>
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
            <img src="../" alt="" class="swipe-image">
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
                    swipeCard.style.display = 'none';
                    return;
                }

                const activity = activities[currentIndex];
                swipeImage.src = activity.image_url;
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
        });
    </script>
</body>

</html>