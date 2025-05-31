<?php require_once '../includes/auth.php'; ?>

<?php


$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");


$all_interests_query = "SELECT id, nom FROM interets";
$all_interests_result = mysqli_query($link, $all_interests_query);
$all_interests = [];
while ($row = mysqli_fetch_assoc($all_interests_result)) {
    $all_interests[$row['id']] = $row['nom'];
}

if (isset($_POST['ajt_activite'])) {

    $titre = mysqli_real_escape_string($link, $_POST['titre']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $date_activite = mysqli_real_escape_string($link, $_POST['date_activite']);
    $ville = mysqli_real_escape_string($link, $_POST['ville']);
    $age_min = mysqli_real_escape_string($link, $_POST['age_min']);
    $age_max = mysqli_real_escape_string($link, $_POST['age_max']);
    $prix = mysqli_real_escape_string($link, $_POST['prix']);
    $abonnement_id = mysqli_real_escape_string($link, $_POST['abonnement_id']);
    $lien_video = mysqli_real_escape_string($link, $_POST['lien_video']);
    $lien_podcast = mysqli_real_escape_string($link, $_POST['lien_podcast']);

    require_once '../algorithme/geocode.php';
    $geocode_result = geocodeCity($_POST['ville']);

    $latitude = null;
    $longitude = null;

    if ($geocode_result && isset($geocode_result['latitude']) && isset($geocode_result['longitude'])) {
        $latitude = mysqli_real_escape_string($link, $geocode_result['latitude']);
        $longitude = mysqli_real_escape_string($link, $geocode_result['longitude']);
    } else {
        $error = "Impossible de géolocaliser la ville spécifiée. Veuillez vérifier le nom de la ville.";
    }

    $image_url = null;
    $image_url_2 = null;
    $image_url_3 = null;
    $upload_dir = '../assets/uploads/activities/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    function processImage($file, $upload_dir)
    {
        if (isset($file) && $file['error'] === 0) {
            $filename = basename($file['name']);
            $filename = preg_replace("/[^a-zA-Z0-9.-]/", "_", $filename);
            $destination = $upload_dir . uniqid() . '_' . $filename;
            $file_type = mime_content_type($file['tmp_name']);
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return $destination;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        return false;
    }

    $image_url = processImage($_FILES['image'], $upload_dir);
    if ($image_url === false) {
        $error = "Erreur avec l'image principale. Seuls les JPG, PNG et GIF sont acceptés.";
    } else {
        $image_url = mysqli_real_escape_string($link, $image_url);
    }

    if (isset($_FILES['image_2']) && $_FILES['image_2']['error'] === 0) {
        $image_url_2 = processImage($_FILES['image_2'], $upload_dir);
        if ($image_url_2 !== false) {
            $image_url_2 = mysqli_real_escape_string($link, $image_url_2);
        }
    }

    if (isset($_FILES['image_3']) && $_FILES['image_3']['error'] === 0) {
        $image_url_3 = processImage($_FILES['image_3'], $upload_dir);
        if ($image_url_3 !== false) {
            $image_url_3 = mysqli_real_escape_string($link, $image_url_3);
        }
    }

    if (!isset($error)) {
        $query = "INSERT INTO activites (
                    abonnement_id, titre, description, date_activite, lieu, latitude, longitude,
                    age_min, age_max, prix, image_url, image_url_2, image_url_3, video_url, podcast_url
                  ) VALUES (
                    '$abonnement_id',
                    '$titre',
                    '$description',
                    '$date_activite',
                    '$ville',
                    " . ($latitude !== null ? "'$latitude'" : "NULL") . ",
                    " . ($longitude !== null ? "'$longitude'" : "NULL") . ",
                    '$age_min',
                    '$age_max',
                    '$prix',
                    " . ($image_url !== null ? "'$image_url'" : "NULL") . ",
                    " . ($image_url_2 !== null ? "'$image_url_2'" : "NULL") . ",
                    " . ($image_url_3 !== null ? "'$image_url_3'" : "NULL") . ",
                    '$lien_video',
                    '$lien_podcast'
                  )";

        if (mysqli_query($link, $query)) {
            $activite_id = mysqli_insert_id($link);

            $delete_query = "DELETE FROM activite_interet WHERE activite_id = '$activite_id'";
            mysqli_query($link, $delete_query);

            if (isset($_POST['interests']) && !empty($_POST['interests'])) {
                $selected_interests = $_POST['interests'];

                foreach ($selected_interests as $interest_id) {
                    $interest_id = mysqli_real_escape_string($link, $interest_id);
                    $insert_query = "INSERT INTO activite_interet (activite_id, interet_id) VALUES ('$activite_id', '$interest_id')";
                    mysqli_query($link, $insert_query);
                }
            }

            $success = "Activité ajoutée avec succès !";
            $_POST = array();
        } else {
            $error = "Erreur lors de l'insertion en base de données: " . mysqli_error($link);
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
        /* Adjusted to match the background */
        --white: #ffffff;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.05);
        /* Less prominent shadow */
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
        /* Less prominent shadow */
    }

    .add-activity-component .add-activity-container {
        flex: 1;
        max-width: 1000px;
        /* Increased max-width */
        margin: 40px auto;
        /* Adjusted margin */
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .add-activity-component .add-activity-container h1 {
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
        color: #151717;
        position: relative;
        padding-bottom: 10px;
        /* Adjusted padding */
    }

    .add-activity-component .add-activity-container h1 span {
        color: var(--primary-color);
        position: relative;
    }

    .add-activity-component .add-activity-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }

    .add-activity-component .add-activity-container h1 span::before {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .add-activity-component .add-activity-container h1:hover span::before {
        transform: scaleX(1);
    }

    .add-activity-component .add-activity-form-container {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        padding: 30px 40px;
        /* Adjusted padding */
        width: 100%;
        max-width: 900px;
        /* Adjusted max-width */
        margin: 0 auto;
        display: grid;
        /* Use grid for the form layout */
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        /* Responsive columns */
        gap: 20px 30px;
        /* Adjusted gap */
    }

    .add-activity-component .add-activity-form-group {
        margin-bottom: 0;
        /* Remove margin-bottom from form-group when using grid */
    }

    .add-activity-component label {
        display: block;
        margin-bottom: 8px;
        /* Adjusted margin */
        color: var(--text-color);
        font-weight: 500;
        font-size: 13px;
        /* Slightly smaller font size */
    }

    .add-activity-component input[type="text"],
    .add-activity-component input[type="number"],
    .add-activity-component input[type="datetime-local"],
    .add-activity-component textarea,
    .add-activity-component select {
        width: 100%;
        padding: 10px 12px;
        /* Adjusted padding */
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        /* Slightly smaller border radius */
        background-color: white;
        font-size: 0.9rem;
        /* Slightly smaller font size */
        color: #4b5563;
        font-family: "Poppins", sans-serif;
        transition: all 0.2s ease;
    }

    .add-activity-component input[type="text"]:focus,
    .add-activity-component input[type="number"]:focus,
    .add-activity-component input[type="datetime-local"]:focus,
    .add-activity-component textarea:focus,
    .add-activity-component select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.1);
        /* Adjusted shadow */
    }

    .add-activity-component textarea {
        min-height: 100px;
        /* Adjusted min-height */
        resize: vertical;
        grid-column: span 2 / auto;
        /* Make textarea span two columns if needed */
    }

    /* Specific style for the file input label and input */
    .add-activity-component .add-activity-form-group input[type="file"] {
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        background-color: white;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .add-activity-component .add-activity-form-group input[type="file"]:hover {
        border-color: var(--primary-color);
        background-color: rgba(46, 204, 113, 0.05);
    }

    .add-activity-component .btn {
        background-color: var(--primary-color);
        color: white;
        padding: 12px 24px;
        /* Adjusted padding */
        border: none;
        border-radius: 4px;
        /* Slightly smaller border radius */
        cursor: pointer;
        font-size: 0.95rem;
        /* Adjusted font size */
        font-weight: 600;
        transition: all 0.2s ease;
        width: auto;
        /* Auto width */
        height: 40px;
        /* Adjusted height */
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        /* Adjusted gap */
        grid-column: span 2 / auto;
        /* Make button span two columns */
        margin-top: 15px;
        /* Add some top margin */
        justify-self: end;
        /* Align button to the end */
    }

    .add-activity-component .btn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-1px);
        /* Less prominent transform */
        box-shadow: var(--shadow-sm);
    }

    .add-activity-component .btn:active {
        transform: translateY(0);
    }

    .message {
        padding: 12px;
        /* Adjusted padding */
        border-radius: 4px;
        /* Adjusted border radius */
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
        .add-activity-component .add-activity-container {
            padding: 15px;
            margin: 10px auto;
        }

        .add-activity-component .add-activity-form-container {
            padding: 20px;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .add-activity-component .add-activity-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .add-activity-component textarea {
            grid-column: auto;
        }

        .add-activity-component .btn {
            grid-column: auto;
            width: 100%;
            justify_self: stretch;
        }

        .add-activity-component input[type="text"],
        .add-activity-component input[type="number"],
        .add-activity-component input[type="datetime-local"],
        .add-activity-component textarea,
        .add-activity-component select,
        .add-activity-component input[type="file"] {
            padding: 10px;
        }
    }
</style>

<div class="add-activity-component">
    <div class="add-activity-container">
        <h1>Ajouter une <span>activité</span></h1>
        <div class="add-activity-form-container">
            <?php if (isset($success)): ?>
                <div class="message success"><?= $success ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="message error"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" action="dashboard.php#add-activity-section">
                <div class="add-activity-form-group">
                    <label for="titre">Titre de l'activité</label>
                    <input type="text" id="titre" name="titre" placeholder="Entrez le titre de l'activité" required>
                </div>

                <div class="add-activity-form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Décrivez l'activité en détail" required></textarea>
                </div>

                <div class="add-activity-form-group">
                    <label for="date_activite">Date et heure de l'activité</label>
                    <input type="datetime-local" id="date_activite" name="date_activite" required>
                </div>

                <div class="add-activity-form-group">
                    <label for="ville">Ville</label>
                    <input type="text" id="ville" name="ville" placeholder="Entrez la ville" autocomplete="off" list="ville-list" required>
                    <datalist id="ville-list"></datalist>
                </div>

                <div class="add-activity-form-group">
                    <label for="age_min">Âge minimum</label>
                    <input type="number" id="age_min" name="age_min" min="0" placeholder="Âge minimum requis" required>
                </div>

                <div class="add-activity-form-group">
                    <label for="age_max">Âge maximum</label>
                    <input type="number" id="age_max" name="age_max" min="0" placeholder="Âge maximum requis" required>
                </div>

                <div class="add-activity-form-group">
                    <label for="prix">Prix (€)</label>
                    <input type="number" id="prix" name="prix" step="0.01" min="0" placeholder="Prix de l'activité" required>
                </div>

                <div class="add-activity-form-group" style="grid-column: span 2;">
                    <label>Centres d'intérêt</label>
                    <div class="interests-container" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                        <?php foreach ($all_interests as $id => $nom): ?>
                            <div class="interest-item" style="display: flex; align-items: center; padding: 8px 16px; background: #f1f5f9; border-radius: 6px;">
                                <input type="checkbox" id="interest-<?php echo $id; ?>" name="interests[]" value="<?php echo $id; ?>" style="margin-right: 8px;">
                                <label for="interest-<?php echo $id; ?>" style="margin: 0;"><?php echo htmlspecialchars($nom); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="add-activity-form-group">
                    <label for="abonnement_id">Abonnement requis</label>
                    <select id="abonnement_id" name="abonnement_id" required>
                        <option value="">Sélectionnez un abonnement</option>
                        <option value="1">Standard</option>
                        <option value="2">Gold</option>
                        <option value="3">Platine</option>
                    </select>
                </div>

                <div class="add-activity-form-group">
                    <label for="image">Image de l'activité</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <div class="add-activity-form-group">
                    <label for="image">deuxieme image</label>
                    <input type="file" id="image" name="image_2" accept="image/*">
                </div>

                <div class="add-activity-form-group">
                    <label for="image">troisième image</label>
                    <input type="file" id="image" name="image_3" accept="image/*">
                </div>

                <div class="add-activity-form-group">
                    <label for="video">Lien vidéo</label>
                    <input type="text" id="video" name="lien_video" placeholder="Entrez le lien vers une vidéo youtube">
                </div>

                <div class="add-activity-form-group">
                    <label for="video">Lien podcast</label>
                    <input type="text" id="podcast" name="lien_podcast" placeholder="Entrez le lien vers un podcast">
                </div>

                <button type="submit" name="ajt_activite" class="btn">
                    Ajouter l'activité
                </button>
            </form>
        </div>
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