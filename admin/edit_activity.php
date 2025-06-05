<?php require_once '../includes/auth.php'; ?>

<?php

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

require_once '../algorithme/geocode.php';

$activity_id = null;
$activity_data = null;
$success_message = null;
$error_message = null;
$current_interests = [];

// Récupérer toutes les activités pour le select
$query_all = "SELECT id, titre FROM all_activites ORDER BY titre ASC";
$result_all = mysqli_query($link, $query_all);
$activities = [];
while ($row = mysqli_fetch_assoc($result_all)) {
    $activities[] = $row;
}


$all_interests_query = "SELECT id, nom FROM interets";
$all_interests_result = mysqli_query($link, $all_interests_query);
$all_interests = [];
while ($row = mysqli_fetch_assoc($all_interests_result)) {
    $all_interests[$row['id']] = $row['nom'];
}


if (isset($_GET['id'])) {
    $activity_id = mysqli_real_escape_string($link, $_GET['id']);
    $query = "SELECT * FROM all_activites WHERE id = '$activity_id'";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $activity_data = mysqli_fetch_assoc($result);

        // Récupérer les centres d'intérêt actuels de l'activité
        $current_interests_query = "SELECT interet_id FROM activite_interet WHERE activite_id = '$activity_id'";
        $current_interests_result = mysqli_query($link, $current_interests_query);
        $current_interests = [];
        while ($row = mysqli_fetch_assoc($current_interests_result)) {
            $current_interests[] = $row['interet_id'];
        }
    } else {
        $error_message = "Activité introuvable.";
    }
}


if (isset($_POST['update_activity'])) {
    $activity_id = mysqli_real_escape_string($link, $_POST['activity_id']);
    $titre = mysqli_real_escape_string($link, $_POST['titre']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $nom_lieu = mysqli_real_escape_string($link, $_POST['nom_lieu']);
    $type_lieu = mysqli_real_escape_string($link, $_POST['type_lieu']);
    $type_architecture = mysqli_real_escape_string($link, $_POST['type_architecture']);
    $region = mysqli_real_escape_string($link, $_POST['region']);
    $adresse = mysqli_real_escape_string($link, $_POST['adresse']);
    $architecte = mysqli_real_escape_string($link, $_POST['architecte']);
    $lien_plus = mysqli_real_escape_string($link, $_POST['lien_plus']);
    $fun_fact = mysqli_real_escape_string($link, $_POST['fun_fact']);
    $age_min = mysqli_real_escape_string($link, $_POST['age_min']);
    $age_max = mysqli_real_escape_string($link, $_POST['age_max']);

    $latitude = null;
    $longitude = null;

    $existing_query = "SELECT region, latitude, longitude FROM all_activites WHERE id = '$activity_id'";
    $existing_result = mysqli_query($link, $existing_query);
    $existing_data = mysqli_fetch_assoc($existing_result);

    if ($region !== $existing_data['region'] || empty($existing_data['latitude']) || empty($existing_data['longitude'])) {
        $geocode_result = geocodeCity($_POST['region']);
        if ($geocode_result && isset($geocode_result['latitude']) && isset($geocode_result['longitude'])) {
            $latitude = mysqli_real_escape_string($link, $geocode_result['latitude']);
            $longitude = mysqli_real_escape_string($link, $geocode_result['longitude']);
        } else {
            $error_message = "Impossible de géolocaliser la ville. L'activité sera mise à jour avec les anciennes coordonnées si disponibles.";
            $latitude = mysqli_real_escape_string($link, $existing_data['latitude']);
            $longitude = mysqli_real_escape_string($link, $existing_data['longitude']);
        }
    } else {
        $latitude = mysqli_real_escape_string($link, $existing_data['latitude']);
        $longitude = mysqli_real_escape_string($link, $existing_data['longitude']);
    }

    $image_url = mysqli_real_escape_string($link, $_POST['existing_image']);

    $upload_dir = '../assets/uploads/activities/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = basename($_FILES['image']['name']);
        $destination = $upload_dir . uniqid() . '_' . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            if ($image_url && file_exists($image_url)) {
                unlink($image_url);
            }
            $image_url = $destination;
        }
    }

    $query = "UPDATE all_activites SET
                titre = '$titre',
                description = '$description',
                nom_lieu = '$nom_lieu',
                type_lieu = '$type_lieu',
                type_architecture = '$type_architecture',
                region = '$region',
                adresse = '$adresse',
                architecte = '$architecte',
                lien_plus = '$lien_plus',
                fun_fact = '$fun_fact',
                latitude = " . ($latitude !== null ? "'$latitude'" : "NULL") . ",
                longitude = " . ($longitude !== null ? "'$longitude'" : "NULL") . ",
                age_min = '$age_min',
                age_max = '$age_max',
                image = " . ($image_url !== null ? "'$image_url'" : "NULL") . "
              WHERE id = '$activity_id'";

    if (mysqli_query($link, $query)) {
        // Supprimer les anciens centres d'intérêt
        $delete_query = "DELETE FROM activite_interet WHERE activite_id = '$activity_id'";
        mysqli_query($link, $delete_query);

        // Insérer les nouveaux centres d'intérêt sélectionnés
        if (isset($_POST['interests']) && !empty($_POST['interests'])) {
            $selected_interests = $_POST['interests'];

            foreach ($selected_interests as $interest_id) {
                $interest_id = mysqli_real_escape_string($link, $interest_id);
                $insert_query = "INSERT INTO activite_interet (activite_id, interet_id) VALUES ('$activity_id', '$interest_id')";
                mysqli_query($link, $insert_query);
            }
        }

        $success_message = "Activité mise à jour avec succès !";
        $query_updated = "SELECT * FROM all_activites WHERE id = '$activity_id'";
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

    .edit-activity-component .edit-activity-container {
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 40px;
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
        color: #FF3131;
        position: relative;
    }

    .edit-activity-component .edit-activity-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #FF3131;
        border-radius: 3px;
    }

    .edit-activity-component .activity-select-form {
        background-color: #ffffff;
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    .edit-activity-component .activity-select-form select {
        width: 100%;
        padding: 18px 20px;
        border: none;
        border-radius: 15px;
        background-color: #F0F0F0;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        color: #000000;
        transition: background-color 0.3s ease;
        margin-bottom: 20px;
    }

    .edit-activity-component .activity-select-form select:focus {
        outline: none;
        background-color: #E8E8E8;
    }

    .edit-activity-component .activity-select-form button {
        background-color: #FF3131;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 18px 40px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        width: 100%;
    }

    .edit-activity-component .activity-select-form button:hover {
        background-color: #e02828;
        transform: translateY(-2px);
    }

    .edit-activity-component .edit-activity-form-container {
        background-color: #ffffff;
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .edit-activity-component .form-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .edit-activity-component .form-group {
        display: flex;
        flex-direction: column;
    }

    .edit-activity-component label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
        font-size: 13px;
    }

    .edit-activity-component input[type="text"],
    .edit-activity-component input[type="number"],
    .edit-activity-component input[type="url"],
    .edit-activity-component textarea,
    .edit-activity-component select {
        padding: 18px 20px;
        border: none;
        border-radius: 15px;
        background-color: #F0F0F0;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        color: #000000;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .edit-activity-component input[type="text"]:focus,
    .edit-activity-component input[type="number"]:focus,
    .edit-activity-component input[type="url"]:focus,
    .edit-activity-component textarea:focus,
    .edit-activity-component select:focus {
        outline: none;
        background-color: #E8E8E8;
    }

    .edit-activity-component textarea {
        min-height: 100px;
        resize: vertical;
    }

    .edit-activity-component input[type="file"] {
        padding: 18px 20px;
        border: none;
        border-radius: 15px;
        background-color: #F0F0F0;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        color: #000000;
        transition: background-color 0.3s ease;
        width: 100%;
        cursor: pointer;
    }

    .edit-activity-component input[type="file"]:hover {
        background-color: #E8E8E8;
    }

    .edit-activity-component .btn {
        background-color: #FF3131;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 18px 40px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        margin-top: 20px;
        width: 100%;
    }

    .edit-activity-component .btn:hover {
        background-color: #e02828;
        transform: translateY(-2px);
    }

    .edit-activity-component .interests-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .edit-activity-component .interest-item {
        display: flex;
        align-items: center;
        padding: 8px 16px;
        background: #F0F0F0;
        border-radius: 15px;
        transition: background-color 0.3s ease;
    }

    .edit-activity-component .interest-item:hover {
        background: #E8E8E8;
    }

    .edit-activity-component .interest-item input[type="checkbox"] {
        margin-right: 8px;
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 2px solid #FF3131;
        appearance: none;
        cursor: pointer;
        position: relative;
    }

    .edit-activity-component .interest-item input[type="checkbox"]:checked {
        background-color: #FF3131;
    }

    .edit-activity-component .interest-item input[type="checkbox"]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 12px;
    }

    .edit-activity-component .interest-item label {
        margin: 0;
        cursor: pointer;
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
        .edit-activity-component .edit-activity-container {
            padding: 0 20px;
        }

        .edit-activity-component .edit-activity-form-container,
        .edit-activity-component .activity-select-form {
            padding: 30px;
            border-radius: 20px;
        }

        .edit-activity-component .edit-activity-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .edit-activity-component input[type="text"],
        .edit-activity-component input[type="number"],
        .edit-activity-component input[type="url"],
        .edit-activity-component textarea,
        .edit-activity-component select,
        .edit-activity-component input[type="file"] {
            padding: 15px 18px;
            font-size: 14px;
        }

        .edit-activity-component .btn,
        .edit-activity-component .activity-select-form button {
            padding: 15px 30px;
            font-size: 14px;
        }
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

        <h1>Modifier une <span>Activité</span></h1>

        <div class="activity-select-form">
            <form method="GET" action="dashboard.php#edit-activity-section">
                <div class="form-group">
                    <label for="activity">Sélectionner une activité :</label>
                    <select name="id" id="activity" required>
                        <option value="">Choisir une activité</option>
                        <?php foreach ($activities as $activity): ?>
                            <option value="<?= $activity['id'] ?>" <?= (isset($_GET['id']) && $_GET['id'] == $activity['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($activity['titre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="select-button">Sélectionner</button>
            </form>
        </div>

        <?php if (!is_null($activity_data)): ?>
            <div class="edit-activity-form-container">
                <form method="POST" action="dashboard.php#edit-activity-section" enctype="multipart/form-data">
                    <input type="hidden" name="activity_id" value="<?= htmlspecialchars($activity_data['id']) ?>">
                    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($activity_data['image']) ?>">

                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($activity_data['titre']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" required><?= htmlspecialchars($activity_data['description']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="nom_lieu">Nom du lieu</label>
                        <input type="text" id="nom_lieu" name="nom_lieu" value="<?= htmlspecialchars($activity_data['nom_lieu']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="type_lieu">Type de lieu</label>
                        <input type="text" id="type_lieu" name="type_lieu" value="<?= htmlspecialchars($activity_data['type_lieu']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="type_architecture">Type d'architecture</label>
                        <input type="text" id="type_architecture" name="type_architecture" value="<?= htmlspecialchars($activity_data['type_architecture']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="region">Ville</label>
                        <input type="text" id="region" name="region" autocomplete="off" list="ville-list" value="<?= htmlspecialchars($activity_data['region']) ?>" required>
                        <datalist id="ville-list"></datalist>
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($activity_data['adresse']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="architecte">Architecte</label>
                        <input type="text" id="architecte" name="architecte" value="<?= htmlspecialchars($activity_data['architecte']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="lien_plus">Lien pour plus d'informations</label>
                        <input type="url" id="lien_plus" name="lien_plus" value="<?= htmlspecialchars($activity_data['lien_plus']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="fun_fact">Fun fact</label>
                        <textarea id="fun_fact" name="fun_fact"><?= htmlspecialchars($activity_data['fun_fact']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="age_min">Âge minimum</label>
                        <input type="number" id="age_min" name="age_min" value="<?= htmlspecialchars($activity_data['age_min']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="age_max">Âge maximum</label>
                        <input type="number" id="age_max" name="age_max" value="<?= htmlspecialchars($activity_data['age_max']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <?php if (!empty($activity_data['image'])): ?>
                            <p>Image actuelle: <img src="../<?= htmlspecialchars($activity_data['image']) ?>" alt="Current Image" style="max-width: 100px; vertical-align: middle; margin-left: 10px;"></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Centres d'intérêt</label>
                        <div class="interests-container">
                            <?php foreach ($all_interests as $id => $nom): ?>
                                <div class="interest-item">
                                    <input type="checkbox"
                                        id="interest-<?php echo $id; ?>"
                                        name="interests[]"
                                        value="<?php echo $id; ?>"
                                        <?php echo in_array($id, $current_interests) ? 'checked' : ''; ?>>
                                    <label for="interest-<?php echo $id; ?>"><?php echo htmlspecialchars($nom); ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
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