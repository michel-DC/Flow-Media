<?php
require_once '../../includes/auth.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$query = "SELECT * FROM activites WHERE id = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$activity = mysqli_fetch_assoc($result);

if (!$activity) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | <?php echo htmlspecialchars($activity['titre']); ?></title>
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
        }

        .page-title {
            color: var(--primary-color);
            text-align: center;
            margin: 150px 0 30px;
            font-size: 2.5rem;
        }

        .activity-container {
            max-width: 1200px;
            margin: 0 auto 100px;
            padding: 20px;
        }

        .activity-header {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-sm);
        }

        .activity-title {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 20px;
        }

        .activity-meta {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
        }

        .meta-item i {
            color: var(--primary-color);
        }

        .activity-price {
            font-size: 1.5rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .activity-images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .activity-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        .activity-description {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-sm);
        }

        .description-title {
            font-size: 1.5rem;
            color: var(--text-color);
            margin-bottom: 20px;
        }

        .description-content {
            color: #666;
            line-height: 1.6;
        }

        .activity-media {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-sm);
        }

        .media-title {
            font-size: 1.5rem;
            color: var(--text-color);
            margin-bottom: 20px;
        }

        .media-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .media-item {
            width: 100%;
            aspect-ratio: 16/9;
            border-radius: 10px;
            overflow: hidden;
        }

        .media-item iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .reservation-button {
            display: inline-block;
            padding: 15px 30px;
            background: var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: background 0.3s ease;
        }

        .reservation-button:hover {
            background: var(--secondary-color);
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
            .page-title {
                font-size: 2rem;
                margin: 100px 0 20px;
            }

            .activity-images {
                grid-template-columns: 1fr;
            }

            .activity-image {
                height: 200px;
            }

            .bottom-illustrations {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>

    <h1 class="page-title"><?php echo htmlspecialchars($activity['titre']); ?></h1>

    <div class="activity-container">
        <div class="activity-header">
            <h2 class="activity-title"><?php echo htmlspecialchars($activity['titre']); ?></h2>
            <div class="activity-meta">
                <div class="meta-item">
                    <i class="far fa-calendar"></i>
                    <?php echo date('d/m/Y', strtotime($activity['date_activite'])); ?>
                </div>
                <div class="meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo htmlspecialchars($activity['lieu']); ?>
                </div>
                <div class="meta-item">
                    <i class="fas fa-user"></i>
                    <?php echo $activity['age_min']; ?>-<?php echo $activity['age_max']; ?> ans
                </div>
                <div class="meta-item activity-price">
                    <i class="fas fa-euro-sign"></i>
                    <?php echo number_format($activity['prix'], 2); ?>
                </div>
            </div>
        </div>

        <div class="activity-images">
            <img src="../<?php echo htmlspecialchars($activity['image_url']); ?>" alt="<?php echo htmlspecialchars($activity['titre']); ?>" class="activity-image">
            <?php if (!empty($activity['image_url_2'])): ?>
                <img src="../<?php echo htmlspecialchars($activity['image_url_2']); ?>" alt="<?php echo htmlspecialchars($activity['titre']); ?>" class="activity-image">
            <?php endif; ?>
            <?php if (!empty($activity['image_url_3'])): ?>
                <img src="../<?php echo htmlspecialchars($activity['image_url_3']); ?>" alt="<?php echo htmlspecialchars($activity['titre']); ?>" class="activity-image">
            <?php endif; ?>
        </div>

        <div class="activity-description">
            <h3 class="description-title">Description</h3>
            <div class="description-content">
                <?php echo nl2br(htmlspecialchars($activity['description'])); ?>
            </div>
        </div>

        <?php if (!empty($activity['video_url']) || !empty($activity['podcast_url'])): ?>
            <div class="activity-media">
                <h3 class="media-title">Médias</h3>
                <div class="media-content">
                    <?php if (!empty($activity['video_url'])): ?>
                        <div class="media-item">
                            <iframe src="<?php echo htmlspecialchars($activity['video_url']); ?>" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($activity['podcast_url'])): ?>
                        <div class="media-item">
                            <iframe src="<?php echo htmlspecialchars($activity['podcast_url']); ?>" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <a href="reservation.php?id=<?php echo $activity['id']; ?>" class="reservation-button">
            Réserver cette activité
        </a>
    </div>


    <?php include '../../includes/layout/footer.php'; ?>
</body>

</html>