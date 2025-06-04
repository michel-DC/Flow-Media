<?php require_once '../includes/auth.php'; ?>

<?php

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$podcast_id = null;
$podcast_data = null;
$success_message = null;
$error_message = null;

// Récupérer tous les podcasts pour le select
$query_all = "SELECT * FROM podcasts ORDER BY titre ASC";
$result_all = mysqli_query($link, $query_all);
$podcasts = [];
while ($row = mysqli_fetch_assoc($result_all)) {
    $podcasts[] = $row;
}

if (isset($_GET['id'])) {
    $podcast_id = mysqli_real_escape_string($link, $_GET['id']);
    $query = "SELECT * FROM podcasts WHERE id = '$podcast_id'";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $podcast_data = mysqli_fetch_assoc($result);
    } else {
        $error_message = "Podcast introuvable.";
    }
}

if (isset($_POST['delete_podcast'])) {
    $podcast_id = mysqli_real_escape_string($link, $_POST['podcast_id']);

    $query = "SELECT fichier_audio_url, image_url FROM podcasts WHERE id = '$podcast_id'";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $podcast = mysqli_fetch_assoc($result);

        if ($podcast['fichier_audio_url'] && file_exists($podcast['fichier_audio_url'])) {
            unlink($podcast['fichier_audio_url']);
        }
        if ($podcast['image_url'] && file_exists($podcast['image_url'])) {
            unlink($podcast['image_url']);
        }

        $delete_query = "DELETE FROM podcasts WHERE id = '$podcast_id'";
        if (mysqli_query($link, $delete_query)) {
            $success_message = "Podcast supprimé avec succès !";
            $podcast_data = null;
        } else {
            $error_message = "Erreur lors de la suppression en base de données: " . mysqli_error($link);
        }
    } else {
        $error_message = "Podcast introuvable.";
    }
}
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f5f5;
        padding: 80px 0;
    }

    .delete-podcast-component .delete-podcast-container {
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .delete-podcast-component .delete-podcast-container h1 {
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
        color: #151717;
        position: relative;
        padding-bottom: 10px;
    }

    .delete-podcast-component .delete-podcast-container h1 span {
        color: #FF3131;
        position: relative;
    }

    .delete-podcast-component .delete-podcast-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #FF3131;
        border-radius: 3px;
    }

    .delete-podcast-component .podcasts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        padding: 20px 0;
    }

    .delete-podcast-component .podcast-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .delete-podcast-component .podcast-card:hover {
        transform: translateY(-5px);
    }

    .delete-podcast-component .podcast-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .delete-podcast-component .podcast-content {
        padding: 20px;
        flex-grow: 1;
    }

    .delete-podcast-component .podcast-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }

    .delete-podcast-component .podcast-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 15px;
    }

    .delete-podcast-component .info-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4b5563;
        font-size: 0.9rem;
    }

    .delete-podcast-component .info-item i {
        color: #FF3131;
    }

    .delete-podcast-component .podcast-description {
        color: #6b7280;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 15px 0;
        max-height: 60px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .delete-podcast-component .select-form {
        padding: 0 20px 20px;
    }

    .delete-podcast-component .select-button {
        display: block;
        width: 100%;
        padding: 10px 20px;
        background-color: #FF3131;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        transition: background-color 0.2s ease;
        text-align: center;
    }

    .delete-podcast-component .select-button:hover {
        background-color: #e02828;
    }

    .delete-podcast-component .no-podcast-message {
        text-align: center;
        font-size: 1.1rem;
        color: #333;
        width: 100%;
        grid-column: 1 / -1;
    }

    .message {
        padding: 12px;
        border-radius: 4px;
        margin: 10px auto;
        text-align: center;
        width: 90%;
        max-width: 400px;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        animation: fadeOut 5s forwards;
        font-size: 14px;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .error {
        background-color: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .success {
        background-color: #f0fdf4;
        color: #166534;
        border: 1px solid #dcfce7;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        90% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            display: none;
        }
    }

    @media (max-width: 768px) {
        .delete-podcast-component .delete-podcast-container {
            padding: 0 20px;
        }

        .delete-podcast-component .delete-podcast-container h1 {
            font-size: 28px;
        }

        .delete-podcast-component .podcast-card {
            padding: 0 0 15px 0;
        }

        .delete-podcast-component .podcast-content {
            padding: 15px;
        }

        .delete-podcast-component .select-form {
            padding: 0 15px 0 15px;
        }
    }
</style>

<div class="delete-podcast-component">
    <div class="delete-podcast-container">
        <?php if (isset($success_message)): ?>
            <div class="message success"><?= $success_message ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="message error"><?= $error_message ?></div>
        <?php endif; ?>

        <h1>Supprimer un <span>podcast</span></h1>

        <div class="podcasts-grid">
            <?php
            if (!empty($podcasts)) {
                foreach ($podcasts as $podcast): ?>
                    <div class="podcast-card">
                        <img src="<?= htmlspecialchars($podcast['image_url']) ?>" alt="<?= htmlspecialchars($podcast['titre']) ?>" class="podcast-image">
                        <div class="podcast-content">
                            <h2 class="podcast-title"><?= htmlspecialchars($podcast['titre']) ?></h2>

                            <div class="podcast-info">
                                <div class="info-item">
                                    <i class="fas fa-headphones"></i>
                                    <span><?= basename($podcast['fichier_audio_url']) ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fab fa-youtube"></i>
                                    <span><?= htmlspecialchars($podcast['youtube_url']) ?></span>
                                </div>
                            </div>

                            <p class="podcast-description"><?= htmlspecialchars($podcast['description']) ?></p>
                        </div>
                        <div class="select-form">
                            <form method="POST" action="dashboard.php#supp-podcast-section" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce podcast ?');">
                                <input type="hidden" name="podcast_id" value="<?= $podcast['id'] ?>">
                                <button type="submit" class="select-button">Supprimer</button>
                            </form>
                        </div>
                    </div>
            <?php endforeach;
            } else {
                echo "<p class='no-podcast-message'>Aucun podcast trouvé.</p>";
            }
            ?>
        </div>

    </div>
</div>