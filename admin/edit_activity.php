<?php require_once '../includes/auth.php'; ?>

<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");
if (mysqli_connect_errno()) {
    die("Échec de la connexion à MySQL: " . mysqli_connect_error());
}

require_once '../algorithme/geocode.php'; // Include geocoding script

$activity_id = null;
$activity_data = null;
$success_message = null;
$error_message = null;

// Récupérer toutes les activités pour le select
$query_all = "SELECT id, titre FROM activites ORDER BY titre ASC";
$result_all = mysqli_query($link, $query_all);
$activities = [];
while ($row = mysqli_fetch_assoc($result_all)) {
    $activities[] = $row;
}

// Handle GET request to load activity data for editing
if (isset($_GET['id'])) {
    $activity_id = mysqli_real_escape_string($link, $_GET['id']);
    $query = "SELECT * FROM activites WHERE id = '$activity_id'";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $activity_data = mysqli_fetch_assoc($result);
    } else {
        $error_message = "Activité introuvable.";
    }
}

// Handle POST request to update activity data
if (isset($_POST['update_activity'])) {
    // Escape all input data
    $activity_id = mysqli_real_escape_string($link, $_POST['activity_id']);
    $titre = mysqli_real_escape_string($link, $_POST['titre']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $date_activite = mysqli_real_escape_string($link, $_POST['date_activite']);
    $ville = mysqli_real_escape_string($link, $_POST['ville']);
    $age_min = mysqli_real_escape_string($link, $_POST['age_min']);
    $age_max = mysqli_real_escape_string($link, $_POST['age_max']);
    $prix = mysqli_real_escape_string($link, $_POST['prix']);
    $abonnement_id = mysqli_real_escape_string($link, $_POST['abonnement_id']);
    $lien_video = mysqli_real_escape_string($link, $_POST['video']);
    $lien_podcast = mysqli_real_escape_string($link, $_POST['podcast']);

    $latitude = null;
    $longitude = null;

    // Get existing activity data to retain location if city isn't changed
    $existing_query = "SELECT lieu, latitude, longitude FROM activites WHERE id = '$activity_id'";
    $existing_result = mysqli_query($link, $existing_query);
    $existing_data = mysqli_fetch_assoc($existing_result);

    // Only re-geocode if the city has changed or if coordinates are missing
    if ($ville !== $existing_data['lieu'] || empty($existing_data['latitude']) || empty($existing_data['longitude'])) {
        $geocode_result = geocodeCity($_POST['ville']); // Use original POST value
        if ($geocode_result && isset($geocode_result['latitude']) && isset($geocode_result['longitude'])) {
            $latitude = mysqli_real_escape_string($link, $geocode_result['latitude']);
            $longitude = mysqli_real_escape_string($link, $geocode_result['longitude']);
        } else {
            $error_message = "Impossible de géolocaliser la nouvelle ville. L'activité sera mise à jour avec les anciennes coordonnées si disponibles.";
            // Keep old coordinates if geocoding fails for the new city
            $latitude = mysqli_real_escape_string($link, $existing_data['latitude']);
            $longitude = mysqli_real_escape_string($link, $existing_data['longitude']);
        }
    } else {
        // Keep old coordinates if city hasn't changed
        $latitude = mysqli_real_escape_string($link, $existing_data['latitude']);
        $longitude = mysqli_real_escape_string($link, $existing_data['longitude']);
    }

    $image_url = mysqli_real_escape_string($link, $_POST['existing_image']); // Start with existing image URL
    $image_url_2 = mysqli_real_escape_string($link, $_POST['existing_image_2'] ?? null);
    $image_url_3 = mysqli_real_escape_string($link, $_POST['existing_image_3'] ?? null);

    // Handle new image uploads
    $upload_dir = '../assets/uploads/activities/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    function processImage($file, $upload_dir, $existing_url)
    {
        if (isset($file) && $file['error'] === 0) {
            $filename = basename($file['name']);
            $filename = preg_replace("/[^a-zA-Z0-9.-]/", "_", $filename);
            $destination = $upload_dir . uniqid() . '_' . $filename;
            $file_type = mime_content_type($file['tmp_name']);
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    // Delete old image if it exists
                    if ($existing_url && file_exists($existing_url)) {
                        unlink($existing_url);
                    }
                    return $destination;
                }
            }
        }
        return $existing_url;
    }

    // Process main image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_url = processImage($_FILES['image'], $upload_dir, $image_url);
    }

    // Process second image
    if (isset($_FILES['image_2']) && $_FILES['image_2']['error'] === 0) {
        $image_url_2 = processImage($_FILES['image_2'], $upload_dir, $image_url_2);
    }

    // Process third image
    if (isset($_FILES['image_3']) && $_FILES['image_3']['error'] === 0) {
        $image_url_3 = processImage($_FILES['image_3'], $upload_dir, $image_url_3);
    }

    // Using direct mysqli_query with escaped variables
    $query = "UPDATE activites SET
                abonnement_id = '$abonnement_id',
                titre = '$titre',
                description = '$description',
                date_activite = '$date_activite',
                lieu = '$ville',
                latitude = " . ($latitude !== null ? "'$latitude'" : "NULL") . ",
                longitude = " . ($longitude !== null ? "'$longitude'" : "NULL") . ",
                age_min = '$age_min',
                age_max = '$age_max',
                prix = '$prix',
                image_url = " . ($image_url !== null ? "'$image_url'" : "NULL") . ",
                image_url_2 = " . ($image_url_2 !== null ? "'$image_url_2'" : "NULL") . ",
                image_url_3 = " . ($image_url_3 !== null ? "'$image_url_3'" : "NULL") . ",
                video_url = '$lien_video',
                podcast_url = '$lien_podcast'
              WHERE id = '$activity_id'";

    if (mysqli_query($link, $query)) {
        $success_message = "Activité mise à jour avec succès !";
        // Re-fetch updated data to display in the form
        $query_updated = "SELECT * FROM activites WHERE id = '$activity_id'";
        $result_updated = mysqli_query($link, $query_updated);
        if ($result_updated && mysqli_num_rows($result_updated) > 0) {
            $activity_data = mysqli_fetch_assoc($result_updated);
        }
    } else {
        $error_message = "Erreur lors de la mise à jour en base de données: " . mysqli_error($link);
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

    .edit-activity-component .edit-activity-container {
        flex: 1;
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .edit-activity-component .edit-activity-container h1 {
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
        color: #151717;
        position: relative;
        padding-bottom: 10px;
    }

    .edit-activity-component .edit-activity-container h1 span {
        color: var(--primary-color);
        position: relative;
    }

    .edit-activity-component .edit-activity-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }

    .edit-activity-component .edit-activity-form-container {
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

    .edit-activity-component .edit-activity-form-group {
        margin-bottom: 0;
    }

    .edit-activity-component label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-color);
        font-weight: 500;
        font-size: 13px;
    }

    .edit-activity-component input[type="text"],
    .edit-activity-component input[type="number"],
    .edit-activity-component input[type="datetime-local"],
    .edit-activity-component textarea,
    .edit-activity-component select {
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

    .edit-activity-component textarea {
        min-height: 100px;
        resize: vertical;
        grid-column: span 2 / auto;
    }


    .edit-activity-component input[type="text"]:focus,
    .edit-activity-component input[type="number"]:focus,
    .edit-activity-component input[type="datetime-local"]:focus,
    .edit-activity-component textarea:focus,
    .edit-activity-component select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.1);
    }


    .edit-activity-component .edit-activity-form-group input[type="file"] {
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        background-color: white;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .edit-activity-component .edit-activity-form-group input[type="file"]:hover {
        border-color: var(--primary-color);
        background-color: rgba(46, 204, 113, 0.05);
    }

    .edit-activity-component .btn {
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

    .edit-activity-component .btn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    .edit-activity-component .btn:active {
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
        .edit-activity-component .edit-activity-container {
            padding: 15px;
            margin: 10px auto;
        }

        .edit-activity-component .edit-activity-form-container {
            padding: 20px;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .edit-activity-component .edit-activity-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .edit-activity-component textarea {
            grid-column: auto;
        }


        .edit-activity-component .btn {
            grid-column: auto;
            width: 100%;
            justify-self: stretch;
        }

        .edit-activity-component input[type="text"],
        .edit-activity-component input[type="number"],
        .edit-activity-component input[type="datetime-local"],
        .edit-activity-component textarea,
        .edit-activity-component select,
        .edit-activity-component input[type="file"] {
            padding: 10px;
        }
    }

    .edit-activity-component .activity-select-form {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        padding: 30px 40px;
        width: 100%;
        max-width: 600px;
        margin: 0 auto 40px auto;
    }

    .edit-activity-component .activity-select-form select {
        width: 100%;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .edit-activity-component .activity-select-form button {
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

    .edit-activity-component .activity-select-form button:hover {
        background-color: var(--secondary-color);
    }
</style>

<div class="edit-activity-component">
    <div class="edit-activity-container">
        <?php if (isset($success_message)): ?>
            <div class="message success"><?= $success_message ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="message error"><?= $error_message ?></div>
        <?php endif; ?>

        <h1>Modifier une <span>activité</span></h1>

        <!-- Nouveau formulaire de sélection -->
        <div class="activity-select-form">
            <form method="GET" action="dashboard.php#edit-activity-section">
                <select name="id" required>
                    <option value="">Sélectionnez une activité à modifier</option>
                    <?php foreach ($activities as $activity): ?>
                        <option value="<?= htmlspecialchars($activity['id']) ?>" <?= (isset($_GET['id']) && $_GET['id'] == $activity['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($activity['titre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Modifier cette activité</button>
            </form>
        </div>

        <?php if (!is_null($activity_data)): ?>
            <div class="edit-activity-form-container">
                <form method="POST" enctype="multipart/form-data" action="dashboard.php#edit-activity-section">
                    <input type="hidden" name="activity_id" value="<?= htmlspecialchars($activity_data['id']) ?>">
                    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($activity_data['image_url']) ?>">
                    <input type="hidden" name="existing_image_2" value="<?= htmlspecialchars($activity_data['image_url_2']) ?>">
                    <input type="hidden" name="existing_image_3" value="<?= htmlspecialchars($activity_data['image_url_3']) ?>">

                    <div class="edit-activity-form-group">
                        <label for="titre">Titre de l'activité</label>
                        <input type="text" id="titre" name="titre" placeholder="Entrez le titre de l'activité" value="<?= htmlspecialchars($activity_data['titre']) ?>" required>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Décrivez l'activité en détail" required><?= htmlspecialchars($activity_data['description']) ?></textarea>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="date_activite">Date et heure de l'activité</label>
                        <input type="datetime-local" id="date_activite" name="date_activite" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($activity_data['date_activite']))) ?>" required>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="ville">Ville</label>
                        <input type="text" id="ville" name="ville" placeholder="Entrez la ville" autocomplete="off" list="ville-list" value="<?= htmlspecialchars($activity_data['lieu']) ?>" required>
                        <datalist id="ville-list"></datalist>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="age_min">Âge minimum</label>
                        <input type="number" id="age_min" name="age_min" min="0" placeholder="Âge minimum requis" value="<?= htmlspecialchars($activity_data['age_min']) ?>" required>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="age_max">Âge maximum</label>
                        <input type="number" id="age_max" name="age_max" min="0" placeholder="Âge maximum requis" value="<?= htmlspecialchars($activity_data['age_max']) ?>" required>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="prix">Prix (€)</label>
                        <input type="number" id="prix" name="prix" step="0.01" min="0" placeholder="Prix de l'activité" value="<?= htmlspecialchars($activity_data['prix']) ?>" required>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="abonnement_id">Abonnement requis</label>
                        <select id="abonnement_id" name="abonnement_id" required>
                            <option value="">Sélectionnez un abonnement</option>
                            <option value="1" <?= $activity_data['abonnement_id'] == 1 ? 'selected' : '' ?>>Standard</option>
                            <option value="2" <?= $activity_data['abonnement_id'] == 2 ? 'selected' : '' ?>>Gold</option>
                            <option value="3" <?= $activity_data['abonnement_id'] == 3 ? 'selected' : '' ?>>Platine</option>
                        </select>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="image">Image de l'activité</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <?php if (!empty($activity_data['image_url'])): ?>
                            <p>Image actuelle: <img src="<?= htmlspecialchars($activity_data['image_url']) ?>" alt="Current Image" style="max-width: 100px; vertical-align: middle; margin-left: 10px;"></p>
                        <?php endif; ?>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="image_2">Image 2 de l'activité</label>
                        <input type="file" id="image_2" name="image_2" accept="image/*">
                        <?php if (!empty($activity_data['image_url_2'])): ?>
                            <p>Image 2 actuelle: <img src="<?= htmlspecialchars($activity_data['image_url_2']) ?>" alt="Current Image 2" style="max-width: 100px; vertical-align: middle; margin-left: 10px;"></p>
                        <?php endif; ?>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="image_3">Image 3 de l'activité</label>
                        <input type="file" id="image_3" name="image_3" accept="image/*">
                        <?php if (!empty($activity_data['image_url_3'])): ?>
                            <p>Image 3 actuelle: <img src="<?= htmlspecialchars($activity_data['image_url_3']) ?>" alt="Current Image 3" style="max-width: 100px; vertical-align: middle; margin-left: 10px;"></p>
                        <?php endif; ?>
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="titre">Lien vidéo</label>
                        <input type="text" id="video" name="video" placeholder="Entrez le lien vers la vidéo" value="<?= htmlspecialchars($activity_data['video_url']) ?>">
                    </div>

                    <div class="edit-activity-form-group">
                        <label for="titre">Lien podcast</label>
                        <input type="text" id="podcast" name="podcast" placeholder="Entrez le lien vers le podcast" value="<?= htmlspecialchars($activity_data['podcast_url']) ?>">
                    </div>

                    <button type="submit" name="update_activity" class="btn">
                        Modifier l'activité
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    document.getElementById('ville').addEventListener('input', function() {
        let query = this.value;
        if (query.length < 2) return;

        fetch('../../algorithme/autocomplete.php?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                let datalist = document.getElementById('ville-list');
                datalist.innerHTML = '';
                data.forEach(ville => {
                    let option = document.createElement('option');
                    option.value = ville;
                    datalist.appendChild(option);
                });
            });
    });
</script>