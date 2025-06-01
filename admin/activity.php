<?php require_once '../includes/auth.php'; ?>

<?php
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$query = "SELECT * FROM activites ORDER BY id DESC";

if (isset($_POST['search_activites'])) {
    $search = mysqli_real_escape_string($link, $_POST['search']);
    $query = "SELECT * FROM activites WHERE titre LIKE '%$search%' ORDER BY id DESC";
}

if (isset($_POST['see_activites'])) {
    $query = "SELECT * FROM activites ORDER BY id DESC";
}

$result = mysqli_query($link, $query);
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    :root {
        --primary-color: #2ECC71;
        --secondary-color: #25a25a;
        --text-color: #333;
        --light-bg: #f0f0f0;
        --white: #ffffff;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .activity-component .activity-list-container {
        font-family: "Poppins", sans-serif;
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 20px;
        padding: 20px;
    }

    .activity-component .activity-list-container h1 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 45px;
        color: #151717;
        text-align: center;
        position: relative;
        padding-bottom: 10px;
    }

    .activity-component .activity-list-container h1 span {
        color: var(--primary-color);
        position: relative;
    }

    .activity-component .activity-list-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
        transform: translateX(0%);
    }

    .activity-component .activity-search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 60px;
        justify-content: center;
    }

    .activity-component .activity-search-form input[type="text"] {
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-family: "Poppins", sans-serif;
        flex-grow: 1;
        max-width: 400px;
    }

    .activity-component .activity-search-form button {
        padding: 10px 20px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .activity-component .activity-search-form button:hover {
        background-color: var(--secondary-color);
    }

    .activity-component .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        padding: 20px 0;
    }

    .activity-component .activity-card {
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: transform 0.3s ease;
    }

    .activity-component .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }

    .activity-component .activity-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .activity-component .activity-content {
        padding: 20px;
    }

    .activity-component .activity-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }

    .activity-component .activity-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 15px;
    }

    .activity-component .info-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4b5563;
        font-size: 0.9rem;
    }

    .activity-component .info-item i {
        color: var(--primary-color);
    }

    .activity-component .activity-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-top: 15px;
    }

    .activity-component .activity-description {
        color: #6b7280;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 15px 0;
    }

    .activity-component .no-activity-message {
        text-align: center;
        font-size: 1.1rem;
        color: var(--text-color);
        width: 100%;
        grid-column: 1 / -1;
    }


    @media (max-width: 768px) {
        .activity-component .activity-search-form {
            flex-direction: column;
            align-items: center;
        }

        .activity-component .activity-search-form input[type="text"] {
            max-width: 100%;
        }

        .activity-component .activity-search-form button {
            width: 100%;
        }

        .activity-component .activity-list-container h1 {
            font-size: 28px;
        }

        .activity-component .activity-card {
            padding: 15px;
        }
    }
</style>

<div class="activity-component">
    <div class="activity-list-container">
        <h1>Les activités <span>disponibles</span></h1>

        <form method="POST" action="dashboard.php#see-activity-section" class=" activity-search-form">
            <input type="text" name="search" placeholder="Rechercher une activité...">
            <button type="submit" name="search_activites">Rechercher</button>
            <button type="submit" name="see_activites">Voir toutes les activités</button>
        </form>

        <div class="activities-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($activite = mysqli_fetch_assoc($result)): ?>
                    <div class="activity-card">
                        <img src="<?= htmlspecialchars($activite['image_url']) ?>" alt="<?= htmlspecialchars($activite['titre']) ?>" class="activity-image">
                        <div class="activity-content">
                            <h2 class="activity-title"><?= htmlspecialchars($activite['titre']) ?></h2>

                            <div class="activity-info">
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?= htmlspecialchars($activite['lieu']) ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-users"></i>
                                    <span>Âge: <?= htmlspecialchars($activite['age_min']) ?> - <?= htmlspecialchars($activite['age_max']) ?> ans</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>Le: <?= htmlspecialchars($activite['date_activite']) ?></span>
                                </div>
                            </div>

                            <p class="activity-description"><?= htmlspecialchars($activite['description']) ?></p>

                            <div class="activity-price">
                                <?= number_format(htmlspecialchars($activite['prix']), 2) ?> €
                            </div>
                        </div>
                    </div>
            <?php endwhile;
            } else {
                echo "<p class='no-activity-message'>Aucune activité trouvée pour votre recherche.</p>";
            }
            ?>
        </div>
    </div>
</div>