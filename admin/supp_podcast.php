<?php require_once '../includes/auth.php'; ?>

<?php

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$podcast_id = null;
$podcast_data = null;
$success_message = null;
$error_message = null;

// Récupérer tous les podcasts pour le select
$query_all = "SELECT id, titre FROM podcasts ORDER BY titre ASC";
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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    :root {
        --primary-color: #2ECC71;
        --secondary-color: #25a25a;
        --danger-color: #e74c3c;
        --danger-hover: #c0392b;
        --text-color: #333;
        --light-bg: #f0f0f0;
        --white: #ffffff;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .delete-podcast-component .delete-podcast-container {
        flex: 1;
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
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
        color: var(--danger-color);
        position: relative;
    }

    .delete-podcast-component .delete-podcast-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--danger-color);
        border-radius: 3px;
    }

    .delete-podcast-component .podcast-select-form {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        padding: 30px 40px;
        width: 100%;
        max-width: 600px;
        margin: 0 auto 40px auto;
    }

    .delete-podcast-component .podcast-select-form select {
        width: 100%;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .delete-podcast-component .podcast-select-form button {
        background-color: var(--primary-color);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.2s ease;
        width: 100%;
    }

    .delete-podcast-component .podcast-select-form button:hover {
        background-color: var(--secondary-color);
    }

    .delete-podcast-component .confirmation-container {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        padding: 30px 40px;
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .delete-podcast-component .confirmation-container h2 {
        color: var(--danger-color);
        margin-bottom: 20px;
    }

    .delete-podcast-component .confirmation-container p {
        margin-bottom: 30px;
        color: var(--text-color);
    }

    .delete-podcast-component .btn-danger {
        background-color: var(--danger-color);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.2s ease;
        width: 100%;
    }

    .delete-podcast-component .btn-danger:hover {
        background-color: var(--danger-hover);
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
        .delete-podcast-component .delete-podcast-container {
            padding: 15px;
            margin: 10px auto;
        }

        .delete-podcast-component .podcast-select-form,
        .delete-podcast-component .confirmation-container {
            padding: 20px;
        }

        .delete-podcast-component .delete-podcast-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
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

        <!-- Formulaire de sélection du podcast -->
        <div class="podcast-select-form">
            <form method="GET" action="dashboard.php#delete-podcast-section">
                <select name="id" required>
                    <option value="">Sélectionnez un podcast à supprimer</option>
                    <?php foreach ($podcasts as $podcast): ?>
                        <option value="<?= htmlspecialchars($podcast['id']) ?>" <?= (isset($_GET['id']) && $_GET['id'] == $podcast['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($podcast['titre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Sélectionner ce podcast</button>
            </form>
        </div>

        <?php if (!is_null($podcast_data)): ?>
            <div class="confirmation-container">
                <h2>Confirmer la suppression</h2>
                <p>Êtes-vous sûr de vouloir supprimer le podcast "<?= htmlspecialchars($podcast_data['titre']) ?>" ?</p>
                <p>Cette action est irréversible et supprimera également les fichiers audio et images associés.</p>

                <form method="POST" action="dashboard.php#delete-podcast-section">
                    <input type="hidden" name="podcast_id" value="<?= htmlspecialchars($podcast_data['id']) ?>">
                    <button type="submit" name="delete_podcast" class="btn-danger">
                        Confirmer la suppression
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>