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

    require_once '../algorithme/geocode.php';
    $geocode_result = geocodeCity($_POST['region']);

    $latitude = null;
    $longitude = null;

    if ($geocode_result && isset($geocode_result['latitude']) && isset($geocode_result['longitude'])) {
        $latitude = mysqli_real_escape_string($link, $geocode_result['latitude']);
        $longitude = mysqli_real_escape_string($link, $geocode_result['longitude']);
    } else {
        $error = "Impossible de géolocaliser la ville";
    }

    $image_url = null;
    $upload_dir = '../assets/uploads/activities/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = basename($_FILES['image']['name']);
        $destination = $upload_dir . uniqid() . '_' . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            $image_url = $destination;
        } else {
            $error = "Erreur lors de l'upload de l'image.";
        }
    }

    if (!isset($error)) {
        $query = "INSERT INTO all_activites (
                    image, titre, nom_lieu, type_lieu, type_architecture, region, 
                    adresse, architecte, description, lien_plus, fun_fact,
                    latitude, longitude, age_min, age_max
                  ) VALUES (
                    " . ($image_url !== null ? "'$image_url'" : "NULL") . ",
                    '$titre',
                    '$nom_lieu',
                    '$type_lieu',
                    '$type_architecture',
                    '$region',
                    '$adresse',
                    '$architecte',
                    '$description',
                    '$lien_plus',
                    '$fun_fact',
                    " . ($latitude !== null ? "'$latitude'" : "NULL") . ",
                    " . ($longitude !== null ? "'$longitude'" : "NULL") . ",
                    '$age_min',
                    '$age_max'
                  )";

        if (mysqli_query($link, $query)) {
            $success = "Activité ajoutée avec succès !";
            $_POST = array();
        } else {
            $error = "Erreur lors de l'insertion en base de données: " . mysqli_error($link);
        }
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

    .add-activity-component .add-activity-container {
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .add-activity-component .add-activity-container h1 {
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
        color: #151717;
        position: relative;
        padding-bottom: 10px;
    }

    .add-activity-component .add-activity-container h1 span {
        color: #FF3131;
        position: relative;
    }

    .add-activity-component .add-activity-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #FF3131;
        border-radius: 3px;
    }

    .add-activity-component .add-activity-form-container {
        background-color: #ffffff;
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .add-activity-component .form-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .add-activity-component .form-group {
        display: flex;
        flex-direction: column;
    }

    .add-activity-component label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
        font-size: 13px;
    }

    .add-activity-component input[type="text"],
    .add-activity-component input[type="number"],
    .add-activity-component input[type="url"],
    .add-activity-component textarea,
    .add-activity-component select {
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

    .add-activity-component input[type="text"]:focus,
    .add-activity-component input[type="number"]:focus,
    .add-activity-component input[type="url"]:focus,
    .add-activity-component textarea:focus,
    .add-activity-component select:focus {
        outline: none;
        background-color: #E8E8E8;
    }

    .add-activity-component textarea {
        min-height: 100px;
        resize: vertical;
    }

    .add-activity-component input[type="file"] {
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

    .add-activity-component input[type="file"]:hover {
        background-color: #E8E8E8;
    }

    .add-activity-component .btn {
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

    .add-activity-component .btn:hover {
        background-color: #e02828;
        transform: translateY(-2px);
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
        .add-activity-component .add-activity-container {
            padding: 0 20px;
        }

        .add-activity-component .add-activity-form-container {
            padding: 30px;
            border-radius: 20px;
        }

        .add-activity-component .add-activity-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .add-activity-component input[type="text"],
        .add-activity-component input[type="number"],
        .add-activity-component input[type="url"],
        .add-activity-component textarea,
        .add-activity-component select,
        .add-activity-component input[type="file"] {
            padding: 15px 18px;
            font-size: 14px;
        }

        .add-activity-component .btn {
            padding: 15px 30px;
            font-size: 14px;
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

            <form method="POST" enctype="multipart/form-data" class="form-section">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="nom_lieu">Nom du lieu</label>
                    <input type="text" id="nom_lieu" name="nom_lieu" required>
                </div>

                <div class="form-group">
                    <label for="type_lieu">Type de lieu</label>
                    <input type="text" id="type_lieu" name="type_lieu" required>
                </div>

                <div class="form-group">
                    <label for="type_architecture">Type d'architecture</label>
                    <input type="text" id="type_architecture" name="type_architecture" required>
                </div>

                <div class="form-group">
                    <label for="region">Ville</label>
                    <input type="text" id="region" name="region" autocomplete="off" list="ville-list" required>
                    <datalist id="ville-list"></datalist>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" name="adresse" required>
                </div>

                <div class="form-group">
                    <label for="architecte">Architecte</label>
                    <input type="text" id="architecte" name="architecte">
                </div>

                <div class="form-group">
                    <label for="lien_plus">Lien pour plus d'informations</label>
                    <input type="url" id="lien_plus" name="lien_plus">
                </div>

                <div class="form-group">
                    <label for="fun_fact">Fun fact</label>
                    <textarea id="fun_fact" name="fun_fact"></textarea>
                </div>

                <div class="form-group">
                    <label for="age_min">Âge minimum</label>
                    <input type="number" id="age_min" name="age_min">
                </div>

                <div class="form-group">
                    <label for="age_max">Âge maximum</label>
                    <input type="number" id="age_max" name="age_max">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <button type="submit" name="ajt_activite" class="btn">Ajouter l'activité</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('region').addEventListener('input', function() {
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