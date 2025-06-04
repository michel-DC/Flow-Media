<?php require_once '../includes/auth.php'; ?>

<?php

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (isset($_POST['delete_activity'])) {
    $activity_id = mysqli_real_escape_string($link, $_POST['activity_id']);

    $image_query = "SELECT image FROM all_activites WHERE id = '$activity_id'";
    $image_result = mysqli_query($link, $image_query);
    $image_data = mysqli_fetch_assoc($image_result);
    $image_to_delete = $image_data['image'] ?? null;

    $delete_query = "DELETE FROM all_activites WHERE id = '$activity_id'";
    if (mysqli_query($link, $delete_query)) {
        if ($image_to_delete && file_exists($image_to_delete)) {
            unlink($image_to_delete);
        }
        $success_message = "Activité supprimée avec succès.";
    } else {
        $error_message = "Erreur lors de la suppression de l'activité : " . mysqli_error($link);
    }
}

$query = "SELECT * FROM all_activites ORDER BY id DESC";
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

    .supp-activity-component .supp-activity-container {
        font-family: "Poppins", sans-serif;
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 20px;
        padding: 20px;
    }

    .supp-activity-component .supp-activity-container h1 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 45px;
        color: #151717;
        text-align: center;
        position: relative;
        padding-bottom: 10px;
    }

    .supp-activity-component .supp-activity-container h1 span {
        color: #E53E3E;
        /* Using a red color for delete title */
        position: relative;
    }

    .supp-activity-component .supp-activity-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #E53E3E;
        /* Red underline */
        border-radius: 3px;
    }


    .supp-activity-component .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        padding: 20px 0;
    }

    .supp-activity-component .activity-card {
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* To push button to bottom */
    }

    .supp-activity-component .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }

    .supp-activity-component .activity-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .supp-activity-component .activity-content {
        padding: 20px;
        flex-grow: 1;
        /* Allow content to grow */
    }

    .supp-activity-component .activity-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }

    .supp-activity-component .activity-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 15px;
    }

    .supp-activity-component .info-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4b5563;
        font-size: 0.9rem;
    }

    .supp-activity-component .info-item i {
        color: var(--primary-color);
    }

    .supp-activity-component .activity-description {
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

    .supp-activity-component .activity-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-top: 15px;
    }

    .supp-activity-component .delete-form {
        padding: 0 20px 20px;
        /* Add padding for the button area */
    }


    .supp-activity-component .delete-button {
        display: block;
        /* Make button take full width */
        width: 100%;
        padding: 10px 20px;
        background-color: #E53E3E;
        /* Red color for delete */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        transition: background-color 0.2s ease;
        text-align: center;
    }

    .supp-activity-component .delete-button:hover {
        background-color: #C53030;
        /* Darker red on hover */
    }

    .supp-activity-component .no-activity-message {
        /* Style for the "Aucune activité trouvée" message */
        text-align: center;
        font-size: 1.1rem;
        color: var(--text-color);
        width: 100%;
        /* Make sure it spans the grid */
        grid-column: 1 / -1;
        /* Span all columns in the grid */
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
        box-shadow: var(--shadow-sm);
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
        .supp-activity-component .supp-activity-container h1 {
            font-size: 28px;
        }

        .supp-activity-component .activity-card {
            padding: 0 0 15px 0;
            /* Adjusted padding for card */
        }

        .supp-activity-component .activity-content {
            padding: 15px;
            /* Adjusted padding for content */
        }

        .supp-activity-component .delete-form {
            padding: 0 15px 0 15px;
            /* Adjusted padding for form */
        }
    }
</style>

<div class="supp-activity-component">
    <div class="supp-activity-container">
        <?php if (isset($success_message)): ?>
            <div class="message success"><?= $success_message ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="message error"><?= $error_message ?></div>
        <?php endif; ?>

        <h1>Supprimer une <span>activité</span></h1>

        <div class="activities-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($activite = mysqli_fetch_assoc($result)): ?>
                    <div class="activity-card">
                        <img src="../<?= htmlspecialchars($activite['image']) ?>" alt="<?= htmlspecialchars($activite['titre']) ?>" class="activity-image">
                        <div class="activity-content">
                            <h2 class="activity-title"><?= htmlspecialchars($activite['titre']) ?></h2>

                            <div class="activity-info">
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?= htmlspecialchars($activite['nom_lieu']) ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-building"></i>
                                    <span><?= htmlspecialchars($activite['type_architecture']) ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-map"></i>
                                    <span><?= htmlspecialchars($activite['region']) ?></span>
                                </div>
                            </div>

                            <p class="activity-description"><?= htmlspecialchars($activite['description']) ?></p>
                        </div>
                        <div class="delete-form">
                            <form method="POST" action="dashboard.php#supp-activity-section" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?');">
                                <input type="hidden" name="activity_id" value="<?= htmlspecialchars($activite['id']) ?>">
                                <button type="submit" name="delete_activity" class="delete-button">Supprimer</button>
                            </form>
                        </div>
                    </div>
            <?php endwhile;
            } else {
                echo "<p class='no-activity-message'>Aucune activité trouvée.</p>";
            }
            ?>
        </div>
    </div>
</div>