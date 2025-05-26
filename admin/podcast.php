<?php require_once '../includes/auth.php'; ?>

<?php
// Connexion à la base de données
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Default query to get all podcasts
$query = "SELECT * FROM podcasts ORDER BY id DESC"; // Added ORDER BY for consistency

// Traitement de la recherche
if (isset($_POST['search_podcasts'])) {
    $search = mysqli_real_escape_string($link, $_POST['search']);
    $query = "SELECT * FROM podcasts WHERE titre LIKE '%$search%' ";
    // Adding back the ORDER BY clause after search
    $query .= " ORDER BY id DESC";
}

if (isset($_POST['see_podcasts'])) {
    // Reset to default query
    $query = "SELECT * FROM podcasts ORDER BY id DESC";
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

    .podcast-component .podcast-list-container {
        font-family: "Poppins", sans-serif;
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 20px;
        padding: 20px;
    }

    .podcast-component .podcast-list-container h1 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 45px;
        color: #151717;
        text-align: center;
        position: relative;
        padding-bottom: 10px;
    }

    .podcast-component .podcast-list-container h1 span {
        color: var(--primary-color);
        position: relative;
    }

    .podcast-component .podcast-list-container h1 span::after {
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

    .podcast-component .podcast-search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 60px;
        justify-content: center;
    }

    .podcast-component .podcast-search-form input[type="text"] {
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-family: "Poppins", sans-serif;
        flex-grow: 1;
        max-width: 400px;
    }

    .podcast-component .podcast-search-form button {
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

    .podcast-component .podcast-search-form button:hover {
        background-color: var(--secondary-color);
    }

    .podcast-component .podcasts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        padding: 20px 0;
    }

    .podcast-component .podcast-card {
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: transform 0.3s ease;
    }

    .podcast-component .podcast-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }

    .podcast-component .podcast-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .podcast-component .podcast-content {
        padding: 20px;
    }

    .podcast-component .podcast-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }

    .podcast-component .podcast-description {
        color: #6b7280;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 15px 0;
    }

    .podcast-component .podcast-links {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 15px;
    }

    .podcast-component .podcast-link {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s ease;
    }

    .podcast-component .podcast-link:hover {
        color: var(--secondary-color);
    }

    .podcast-component .podcast-link i {
        font-size: 1.1rem;
    }

    .podcast-component .no-podcast-message {
        text-align: center;
        font-size: 1.1rem;
        color: var(--text-color);
        width: 100%;
        grid-column: 1 / -1;
    }

    @media (max-width: 768px) {
        .podcast-component .podcast-search-form {
            flex-direction: column;
            align-items: center;
        }

        .podcast-component .podcast-search-form input[type="text"] {
            max-width: 100%;
        }

        .podcast-component .podcast-search-form button {
            width: 100%;
        }

        .podcast-component .podcast-list-container h1 {
            font-size: 28px;
        }

        .podcast-component .podcast-card {
            padding: 15px;
        }
    }
</style>

<div class="podcast-component">
    <div class="podcast-list-container">
        <h1>Les podcasts <span>disponibles</span></h1>

        <form method="POST" action="dashboard.php#see-podcast-section" class="podcast-search-form">
            <input type="text" name="search" placeholder="Rechercher un podcast...">
            <button type="submit" name="search_podcasts">Rechercher</button>
            <button type="submit" name="see_podcasts">Voir tous les podcasts</button>
        </form>

        <div class="podcasts-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($podcast = mysqli_fetch_assoc($result)): ?>
                    <div class="podcast-card">
                        <img src="<?= htmlspecialchars($podcast['image_url']) ?>" alt="<?= htmlspecialchars($podcast['titre']) ?>" class="podcast-image">
                        <div class="podcast-content">
                            <h2 class="podcast-title"><?= htmlspecialchars($podcast['titre']) ?></h2>
                            
                            <p class="podcast-description"><?= htmlspecialchars($podcast['description']) ?></p>

                            <div class="podcast-links">
                                <?php if (!empty($podcast['fichier_audio_url'])): ?>
                                    <a href="<?= htmlspecialchars($podcast['fichier_audio_url']) ?>" class="podcast-link" target="_blank">
                                        <i class="fas fa-headphones"></i>
                                        <span>Écouter le podcast</span>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($podcast['youtube_url'])): ?>
                                    <a href="<?= htmlspecialchars($podcast['youtube_url']) ?>" class="podcast-link" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                        <span>Voir sur YouTube</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php endwhile;
            } else {
                echo "<p class='no-podcast-message'>Aucun podcast trouvé pour votre recherche.</p>";
            }
            ?>
        </div>
    </div>
</div>
