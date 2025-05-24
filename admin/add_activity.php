<?php require_once '../includes/auth.php'; ?>

<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");
if (mysqli_connect_errno()) {
    die("Échec de la connexion à MySQL: " . mysqli_connect_error());
}

if (isset($_POST['ajt_activite'])) {
    $titre = mysqli_real_escape_string($link, $_POST['titre']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $date_activite = mysqli_real_escape_string($link, $_POST['date_activite']);
    $ville = mysqli_real_escape_string($link, $_POST['ville']);
    $age_min = intval($_POST['age_min']);
    $age_max = intval($_POST['age_max']);
    $prix = floatval($_POST['prix']);
    $abonnement_id = intval($_POST['abonnement_id']);

    // Improved geocoding handling inspired by profile.php
    require_once '../algorithme/geocode.php';
    $geocode_result = geocodeCity($ville);

    // Handle geocoding result more carefully
    if ($geocode_result && isset($geocode_result['latitude']) && isset($geocode_result['longitude'])) {
        $latitude = $geocode_result['latitude'];
        $longitude = $geocode_result['longitude'];
    } else {
        // If geocoding fails, set default values or handle error
        $latitude = null;
        $longitude = null;
        $error = "Impossible de géolocaliser la ville spécifiée. Veuillez vérifier le nom de la ville.";
    }

    $image_url = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $upload_dir = '../assets/uploads/activities/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $filename = basename($_FILES['image']['name']);
        $destination = $upload_dir . uniqid() . '_' . $filename;
        $file_type = mime_content_type($_FILES['image']['tmp_name']);

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $image_url = $destination;
            } else {
                $error = "Erreur lors du déplacement de l'image.";
            }
        } else {
            $error = "Type de fichier non autorisé. Seuls les JPG, PNG et GIF sont acceptés.";
        }
    }

    if (!isset($error)) {
        $query = "INSERT INTO activites (
                    abonnement_id, titre, description, date_activite, lieu, latitude, longitude,
                    age_min, age_max, prix, image_url
                  ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                  )";

        $stmt = mysqli_prepare($link, $query);
        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "issssddiids",
                $abonnement_id,
                $titre,
                $description,
                $date_activite,
                $ville,
                $latitude,
                $longitude,
                $age_min,
                $age_max,
                $prix,
                $image_url
            );

            if (mysqli_stmt_execute($stmt)) {
                $success = "Activité ajoutée avec succès !";
                // Clear form after successful submission
                $_POST = array();
            } else {
                $error = "Erreur lors de l'insertion en base de données: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "Erreur de préparation de la requête: " . mysqli_error($link);
        }
    }
}
?>

<style>
    body {
        font-family: "Space Grotesk", sans-serif;
        background-color: #ffffff;
        margin: 0;
        padding: 0;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 20px;
        padding: 20px;
    }

    .container h1 {
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
        color: #151717;
    }

    .container h1 span {
        color: #2ECC71;
        position: relative;
    }

    .container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #2ECC71;
        border-radius: 3px;
    }

    .form-container {
        border: 1px lightgreen solid;
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #111827;
        font-weight: 500;
    }

    input[type="text"],
    textarea,
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        background-color: white;
        font-size: 0.9rem;
        color: #4b5563;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .btn {
        background-color: #2ECC71;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 600;
        transition: background 0.2s ease;
    }

    .btn:hover {
        background-color: rgb(118, 244, 171);
    }

    .message {
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        background-color: white;
    }

    .language-icon {
        width: 50px;
        height: 50px;
        margin: 5px;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 5px;
        transition: border-color 0.2s ease;
    }

    .language-icon.selectionne {
        border-color: #2ECC71;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 16px;
        max-width: 600px;
    }

    * Add any additional styles needed for the new form */
</style>

<div class="container">
    <h1>Ajouter une <span>activité</span></h1>
    <div class="form-container">
        <?php if (isset($success)): ?>
            <div class="message success"><?= $success ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre de l'activité</label>
                <input type="text" id="titre" name="titre" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="date_activite">Date et heure de l'activité</label>
                <input type="datetime-local" id="date_activite" name="date_activite" required>
            </div>

            <div class="form-group">
                <label for="ville">ville</label>
                <input type="text" id="ville" name="ville" autocomplete="off" list="ville-list">
                <datalist id="ville-list"></datalist>
            </div>

            <div class="form-group">
                <label for="age_min">Âge minimum</label>
                <input type="number" id="age_min" name="age_min" min="0">
            </div>

            <div class="form-group">
                <label for="age_max">Âge maximum</label>
                <input type="number" id="age_max" name="age_max" min="0">
            </div>

            <div class="form-group">
                <label for="prix">Prix (€)</label>
                <input type="number" id="prix" name="prix" step="0.01" min="0">
            </div>

            <div class="form-group">
                <label for="abonnement_id">Abonnement requis</label>
                <select id="abonnement_id" name="abonnement_id">
                    <option value="1">Standard</option>
                    <option value="2">Gold</option>
                    <option value="3">Platine</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image de l'activité</label>
                <input type="file" id="image" name="image">
            </div>

            <button type="submit" name="ajt_activite" class="btn">Ajouter l'activité</button>
        </form>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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

    <?php if (!empty($user['latitude']) && !empty($user['longitude'])): ?>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('user-map').setView([<?php echo $user['latitude']; ?>, <?php echo $user['longitude']; ?>], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([<?php echo $user['latitude']; ?>, <?php echo $user['longitude']; ?>])
                .addTo(map)
                .bindPopup('<?php echo htmlspecialchars($user['ville']); ?>')
                .openPopup();
        });
    <?php endif; ?>
</script>