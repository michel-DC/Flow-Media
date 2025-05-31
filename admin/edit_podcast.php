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

if (isset($_POST['edit_podcast'])) {
    $podcast_id = mysqli_real_escape_string($link, $_POST['podcast_id']);
    $titre = mysqli_real_escape_string($link, $_POST['titre']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $youtube_url = mysqli_real_escape_string($link, $_POST['youtube_url']);

    $audio_url = $podcast_data['fichier_audio_url'];
    $image_url = $podcast_data['image_url'];
    $upload_dir = '../assets/uploads/podcasts/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    function processFile($file, $upload_dir, $allowed_types)
    {
        if (isset($file) && $file['error'] === 0) {
            $filename = basename($file['name']);
            $filename = preg_replace("/[^a-zA-Z0-9.-]/", "_", $filename);
            $destination = $upload_dir . uniqid() . '_' . $filename;
            $file_type = mime_content_type($file['tmp_name']);

            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return $destination;
                }
            }
        }
        return false;
    }

    if (isset($_FILES['audio']) && $_FILES['audio']['error'] === 0) {
        $new_audio_url = processFile($_FILES['audio'], $upload_dir, ['audio/mpeg', 'audio/mp3', 'audio/wav']);
        if ($new_audio_url === false) {
            $error_message = "Erreur avec le fichier audio. Seuls les MP3 et WAV sont acceptés.";
        } else {
            // Supprimer l'ancien fichier audio s'il existe
            if ($audio_url && file_exists($audio_url)) {
                unlink($audio_url);
            }
            $audio_url = mysqli_real_escape_string($link, $new_audio_url);
        }
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $new_image_url = processFile($_FILES['image'], $upload_dir, ['image/jpeg', 'image/png', 'image/gif']);
        if ($new_image_url === false) {
            $error_message = "Erreur avec l'image. Seuls les JPG, PNG et GIF sont acceptés.";
        } else {
            // Supprimer l'ancienne image si elle existe
            if ($image_url && file_exists($image_url)) {
                unlink($image_url);
            }
            $image_url = mysqli_real_escape_string($link, $new_image_url);
        }
    }

    if (!isset($error_message)) {
        $query = "UPDATE podcast SET 
                    titre = '$titre',
                    description = '$description',
                    fichier_audio_url = " . ($audio_url !== null ? "'$audio_url'" : "NULL") . ",
                    youtube_url = '$youtube_url',
                    image_url = " . ($image_url !== null ? "'$image_url'" : "NULL") . "
                  WHERE id = '$podcast_id'";

        if (mysqli_query($link, $query)) {
            $success_message = "Podcast mis à jour avec succès !";
            $query_updated = "SELECT * FROM podcast WHERE id = '$podcast_id'";
            $result_updated = mysqli_query($link, $query_updated);
            if ($result_updated && mysqli_num_rows($result_updated) > 0) {
                $podcast_data = mysqli_fetch_assoc($result_updated);
            }
        } else {
            $error_message = "Erreur lors de la mise à jour en base de données: " . mysqli_error($link);
        }
    }
}
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    :root {
        --primary-color: #2ECC71;
        --secondary-color: #25a25a;
        --text-color: #333;
        --light-bg: #f0f0f0;
        --white: #ffffff;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .edit-podcast-component .edit-podcast-container {
        flex: 1;
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .edit-podcast-component .edit-podcast-container h1 {
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
        color: #151717;
        position: relative;
        padding-bottom: 10px;
    }

    .edit-podcast-component .edit-podcast-container h1 span {
        color: var(--primary-color);
        position: relative;
    }

    .edit-podcast-component .edit-podcast-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }

    .edit-podcast-component .edit-podcast-form-container {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        padding: 30px 40px;
        width: 100%;
        max-width: 900px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px 30px;
    }

    .edit-podcast-component .edit-podcast-form-group {
        margin-bottom: 0;
    }

    .edit-podcast-component label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-color);
        font-weight: 500;
        font-size: 13px;
    }

    .edit-podcast-component input[type="text"],
    .edit-podcast-component textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        background-color: white;
        font-size: 0.9rem;
        color: #4b5563;
        font-family: "Poppins", sans-serif;
        transition: all 0.2s ease;
    }

    .edit-podcast-component input[type="text"]:focus,
    .edit-podcast-component textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.1);
    }

    .edit-podcast-component textarea {
        min-height: 100px;
        resize: vertical;
        grid-column: span 2 / auto;
    }

    .edit-podcast-component .edit-podcast-form-group input[type="file"] {
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        background-color: white;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .edit-podcast-component .edit-podcast-form-group input[type="file"]:hover {
        border-color: var(--primary-color);
        background-color: rgba(46, 204, 113, 0.05);
    }

    .edit-podcast-component .btn {
        background-color: var(--primary-color);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.2s ease;
        width: auto;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        grid-column: span 2 / auto;
        margin-top: 15px;
        justify-self: end;
    }

    .edit-podcast-component .btn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    .edit-podcast-component .btn:active {
        transform: translateY(0);
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

    .current-file {
        font-size: 0.9rem;
        color: #666;
        margin-top: 5px;
    }

    .edit-podcast-component .podcast-select-form {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        padding: 30px 40px;
        width: 100%;
        max-width: 600px;
        margin: 0 auto 40px auto;
    }

    .edit-podcast-component .podcast-select-form select {
        width: 100%;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .edit-podcast-component .podcast-select-form button {
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

    .edit-podcast-component .podcast-select-form button:hover {
        background-color: var(--secondary-color);
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
        .edit-podcast-component .edit-podcast-container {
            padding: 15px;
            margin: 10px auto;
        }

        .edit-podcast-component .edit-podcast-form-container {
            padding: 20px;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .edit-podcast-component .edit-podcast-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .edit-podcast-component textarea {
            grid-column: auto;
        }

        .edit-podcast-component .btn {
            grid-column: auto;
            width: 100%;
            justify-self: stretch;
        }
    }
</style>

<div class="edit-podcast-component">
    <div class="edit-podcast-container">
        <?php if (isset($success_message)): ?>
            <div class="message success"><?= $success_message ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="message error"><?= $error_message ?></div>
        <?php endif; ?>

        <h1>Modifier un <span>podcast</span></h1>

        <!-- Formulaire de sélection du podcast -->
        <div class="podcast-select-form">
            <form method="GET" action="dashboard.php#edit-podcast-section">
                <select name="id" required>
                    <option value="">Sélectionnez un podcast à modifier</option>
                    <?php foreach ($podcasts as $podcast): ?>
                        <option value="<?= htmlspecialchars($podcast['id']) ?>" <?= (isset($_GET['id']) && $_GET['id'] == $podcast['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($podcast['titre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Modifier ce podcast</button>
            </form>
        </div>

        <?php if (!is_null($podcast_data)): ?>
            <div class="edit-podcast-form-container">
                <form method="POST" enctype="multipart/form-data" action="dashboard.php#edit-podcast-section">
                    <input type="hidden" name="podcast_id" value="<?= htmlspecialchars($podcast_data['id']) ?>">

                    <div class="edit-podcast-form-group">
                        <label for="titre">Titre du podcast</label>
                        <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($podcast_data['titre']) ?>" required>
                    </div>

                    <div class="edit-podcast-form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" required><?= htmlspecialchars($podcast_data['description']) ?></textarea>
                    </div>

                    <div class="edit-podcast-form-group">
                        <label for="audio">Fichier audio</label>
                        <input type="file" id="audio" name="audio" accept="audio/*">
                        <?php if ($podcast_data['fichier_audio_url']): ?>
                            <div class="current-file">Fichier actuel : <?= basename($podcast_data['fichier_audio_url']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="edit-podcast-form-group">
                        <label for="image">Image du podcast</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <?php if ($podcast_data['image_url']): ?>
                            <div class="current-file">
                                Image actuelle : <img src="<?= htmlspecialchars($podcast_data['image_url']) ?>" alt="Current Image" style="max-width: 100px; vertical-align: middle; margin-left: 10px;">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="edit-podcast-form-group">
                        <label for="youtube_url">Lien YouTube</label>
                        <input type="text" id="youtube_url" name="youtube_url" value="<?= htmlspecialchars($podcast_data['youtube_url']) ?>" placeholder="Entrez le lien YouTube du podcast">
                    </div>

                    <button type="submit" name="edit_podcast" class="btn">
                        Mettre à jour le podcast
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>