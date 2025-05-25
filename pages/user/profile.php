<?php

require_once '../../includes/auth.php';

if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true) {
    header('Location: ../../connexion/login.php?erreur=non_connecte');
    exit();
}

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

$abonnement_query = "SELECT a.* FROM abonnements a JOIN users u ON a.id = u.abonnement_id WHERE u.id = '$user_id'";
$abonnement_result = mysqli_query($link, $abonnement_query);
$abonnement = mysqli_fetch_assoc($abonnement_result);

$interests_query = "SELECT i.id, i.nom FROM interets i
                   JOIN user_interet ui ON i.id = ui.interet_id
                   WHERE ui.user_id = '$user_id'";
$interests_result = mysqli_query($link, $interests_query);
$user_interests = [];
while ($row = mysqli_fetch_assoc($interests_result)) {
    $user_interests[$row['id']] = $row['nom'];
}

$all_interests_query = "SELECT id, nom FROM interets";
$all_interests_result = mysqli_query($link, $all_interests_query);
$all_interests = [];
while ($row = mysqli_fetch_assoc($all_interests_result)) {
    $all_interests[$row['id']] = $row['nom'];
}

if (isset($_POST['update_profile'])) {
    $fullname = mysqli_real_escape_string($link, $_POST['fullname']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $ville = mysqli_real_escape_string($link, $_POST['ville']);
    $age = mysqli_real_escape_string($link, $_POST['age']);

    require_once '../../algorithme/geocode.php';
    $geocode_result = geocodeCity($ville);

    $latitude = $geocode_result ? $geocode_result['latitude'] : 'NULL';
    $longitude = $geocode_result ? $geocode_result['longitude'] : 'NULL';

    $delete_query = "DELETE FROM user_interet WHERE user_id = '$user_id'";
    mysqli_query($link, $delete_query);

    if (isset($_POST['interests']) && !empty($_POST['interests'])) {
        $selected_interests = $_POST['interests'];

        foreach ($selected_interests as $interest_id) {
            $interest_id = mysqli_real_escape_string($link, $interest_id);
            $insert_query = "INSERT INTO user_interet (user_id, interet_id) VALUES ('$user_id', '$interest_id')";
            mysqli_query($link, $insert_query);
        }
    }

    $photo_profil = $user['photo_profil'];

    if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name'])) {
        $upload_dir = __DIR__ . '/../../assets/uploads/profiles/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $filename = basename($_FILES["profile_picture"]["name"]);
        $target_file = $upload_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false && in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $photo_profil = $filename;
            } else {
                $error = "Erreur lors du téléchargement de l'image.";
            }
        } else {
            $error = "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés pour la photo de profil.";
        }
    }

    $update_query = "UPDATE users SET
            fullname='$fullname',
            email='$email',
            photo_profil='$photo_profil',
            ville='$ville',
            age='$age',
            latitude=$latitude,
            longitude=$longitude
            WHERE id='$user_id'";

    if (mysqli_query($link, $update_query)) {
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $success = "Profil mis à jour avec succès!";
        $result = mysqli_query($link, $query);
        $user = mysqli_fetch_assoc($result);
    } else {
        $error = "Erreur lors de la mise à jour du profil: " . mysqli_error($link);
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil | Flow Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --soft-black: #1a1a1a;
            --white: #f9f9f9;
            --border: #e2e8f0;
            --background: #ffffff;
            --card-background: #ffffff;
            --hover: #f1f5f9;
            --muted: #64748b;
            --selected-background: #e0e0e0;
            --primary: #3a791f;
            --primary-hover: #4e8c2b;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--background);
            color: var(--soft-black);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            min-height: 100vh;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .dashboard {
            display: flex;
            padding-top: 60px;
            margin-top: 120px;
        }

        .sidebar {
            margin-top: 120px;
            background: var(--card-background);
            border-right: 1px solid var(--border);
            padding: 2rem;
            width: 280px;
            flex-shrink: 0;
            position: fixed;
            top: 60px;
            bottom: 0;
            overflow-y: auto;
            box-sizing: border-box;
        }

        .main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 280px;
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
        }

        .profile-header h2 {
            font-size: 1.25rem;
            margin: 0;
        }

        .profile-header p {
            font-size: 0.875rem;
            color: var(--muted);
            margin: 0;
        }

        .sidebar nav a {
            display: block;
            text-decoration: none;
            color: var(--soft-black);
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 6px;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
        }

        .sidebar nav a:hover {
            background-color: var(--hover);
            color: var(--soft-black);
        }

        .card {
            background: var(--card-background);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 35px;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: var(--primary);
            margin: 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            align-items: start;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--soft-black);
        }

        .form-input {
            width: 100%;
            padding: 15px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.9rem;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: var(--background);
            color: var(--soft-black);
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(58, 121, 31, 0.2);
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            background: var(--primary);
            color: var(--white);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 1rem 0.5rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .interests-section {
            margin: 30px 0;
            padding: 35px;
            border: 1px solid var(--border);
            border-radius: 24px;
            background: var(--card-background);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
        }

        .interests-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }

        .interest-item {
            display: flex;
            align-items: center;
            padding: 8px 16px;
            background: var(--hover);
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .interest-item:hover {
            background: var(--selected-background);
        }

        .interest-item input {
            margin-right: 8px;
        }

        .subscription-card {
            text-align: center;
            background: var(--card-background);
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
        }

        .subscription-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1.5rem;
        }

        .subscription-title {
            font-size: 1.9rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        .subscription-price {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 1.5rem 0;
            color: var(--soft-black);
        }

        .subscription-features {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0;
            text-align: left;
        }

        .subscription-features li {
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            font-size: 1rem;
            padding-left: 2rem;
            position: relative;
        }

        .subscription-features li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
        }

        .subscription-features li:last-child {
            border-bottom: none;
        }

        .message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
            z-index: 999;
        }

        .error {
            background-color: #FEF2F2;
            color: #EF4444;
            border: 1px solid #FCA5A5;
            z-index: 999;
        }

        .success {
            background-color: #F0F9FF;
            color: #0284C7;
            border: 1px solid #7DD3FC;
            z-index: 999;
        }

        .map-placeholder {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--hover);
            border-radius: 8px;
            border: 1px solid var(--border);
            color: var(--muted);
            font-style: italic;
            text-align: center;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
                padding-top: 0;
            }

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--border);
                padding: 1rem;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .profile-header {
                flex-direction: row;
                text-align: left;
                align-items: center;
            }

            .profile-avatar {
                width: 60px;
                height: 60px;
            }

            .sidebar nav {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .sidebar nav a {
                flex-grow: 1;
                text-align: center;
                padding: 0.5rem;
            }

            .grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .card {
                padding: 1.5rem;
            }

            .subscription-card {
                padding: 1.5rem;
            }

            .interests-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }

            .interest-item {
                padding: 0.5rem;
                font-size: 0.8rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>

    <?php include '../../includes/layout/navbar.php'; ?>

    <div class="dashboard">
        <aside class="sidebar">
            <div class="profile-header">
                <?php if (!empty($user['photo_profil'])): ?>
                    <img src="../../assets/uploads/profiles/<?php echo $user['photo_profil']; ?>" alt="Photo de profil" class="profile-avatar">
                <?php else: ?>
                    <div class="profile-avatar" style="background-color: var(--border); display: flex; align-items: center; justify-content: center;">
                        <span style="font-size: 2rem;">👤</span>
                    </div>
                <?php endif; ?>
                <div>
                    <h2><?php echo htmlspecialchars($user['fullname']); ?></h2>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
            </div>

            <nav>
                <a href="#profile">Profil</a>
                <a href="#interests">Centres d'intérêt</a>
                <a href="#location">Localisation</a>
                <a href="#subscription">Abonnement</a>
            </nav>
        </aside>

        <main class="main-content">
            <?php if (isset($error)): ?>
                <div class="message error"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="message success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" action="profile.php">
                <div class="grid">
                    <div class="card" id="profile">
                        <div class="card-header">
                            <h3 class="card-title">Mes informations personnelles</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="profile_picture">Photo de profil</label>
                            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="fullname">Nom complet</label>
                            <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-input" required>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Détails supplémentaires</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="age">Âge</label>
                            <select id="age" name="age" class="form-input" required>
                                <option value="">Sélectionnez votre âge</option>
                                <?php for ($i = 15; $i <= 25; $i++): ?>
                                    <option value="<?php echo $i; ?>" <?php echo $user['age'] == $i ? 'selected' : ''; ?>>
                                        <?php echo $i; ?> ans
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="ville">Ville</label>
                            <input type="text" id="ville" name="ville" value="<?php echo htmlspecialchars($user['ville'] ?? ''); ?>" class="form-input" autocomplete="off" list="ville-list">
                            <datalist id="ville-list"></datalist>
                        </div>
                    </div>
                </div>

                <div class="interests-section" id="interests">
                    <h3>Mes centres d'intérêt</h3>
                    <p>Sélectionnez vos centres d'intérêt :</p>
                    <div class="interests-container">
                        <?php foreach ($all_interests as $id => $nom): ?>
                            <div class="interest-item">
                                <input type="checkbox" id="interest-<?php echo $id; ?>" name="interests[]" value="<?php echo $id; ?>"
                                    <?php echo isset($user_interests[$id]) ? 'checked' : ''; ?>>
                                <label for="interest-<?php echo $id; ?>"><?php echo htmlspecialchars($nom); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="card" id="location">
                    <div class="card-header">
                        <h3 class="card-title">Ma localisation</h3>
                    </div>
                    <?php if (!empty($user['latitude']) && !empty($user['longitude'])): ?>
                        <div id="user-map" style="height: 300px; border-radius: 6px;"></div>
                    <?php else: ?>
                        <div class="map-placeholder">
                            Aucune position enregistrée. Mettez à jour votre ville pour voir votre position sur la carte.
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" name="update_profile" class="btn btn-update" style="margin-top: 2rem; display: block; margin-left: auto; margin-right: auto; margin-bottom: 200px;">
                    Mettre à jour mon profil
                </button>
            </form>

            <div class="card subscription-card" id="subscription">
                <div class="card-header" style="border-bottom: none; padding-bottom: 0; margin-bottom: 0;">
                </div>
                <h3 class="subscription-title">Mon abonnement actuel</h3>
                <?php if ($user['abonnement_id'] == 1): ?>
                    <img src="../../assets/icons/black-star.svg" alt="Gratuit" class="subscription-icon">
                    <div class="subscription-price">Gratuit</div>
                    <ul class="subscription-features">
                        <li>Accès aux contenus de base</li>
                        <li>1 activité réservable par mois</li>
                    </ul>
                <?php elseif ($user['abonnement_id'] == 2): ?>
                    <img src="../../assets/icons/gold-star.svg" alt="Gold" class="subscription-icon">
                    <div class="subscription-price" style="color: #FFD700;">Gold</div>
                    <ul class="subscription-features">
                        <li>Accès à tous les contenus premium</li>
                        <li>5 activités réservables par mois</li>
                        <li>Podcasts exclusifs</li>
                        <li>Codes promo mensuels</li>
                    </ul>
                <?php elseif ($user['abonnement_id'] == 3): ?>
                    <img src="../../assets/icons/plat-star.png" alt="Platine" class="subscription-icon">
                    <div class="subscription-price" style="color: #A8A8A8;">Platine</div>
                    <ul class="subscription-features">
                        <li>Accès à tous les contenus premium</li>
                        <li>10 activités réservables par mois</li>
                        <li>Podcasts exclusifs</li>
                        <li>Codes promo mensuels</li>
                        <li>Accès prioritaire aux événements</li>
                        <li>Invitations VIP</li>
                    </ul>
                <?php endif; ?>
                <a href="../abonnement/index.php?user_id=<?php echo $user_id; ?>" class="btn" style="margin-top: 1.5rem;">Changer d'abonnement</a>
            </div>

        </main>
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

        document.querySelectorAll('.sidebar nav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    const navbarHeight = document.querySelector('.navbar').offsetHeight;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - navbarHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>


    <?php
    if (isset($error)):
        echo "<div class='message error'>$error</div>";
    endif;

    if (isset($success)):
        echo "<div class='message success'>$success</div>";
    endif;

    if (isset($_GET['erreur']) && $_GET['erreur'] === 'acces_refuse_user') {
        echo "<div class='message error'>Vous n'êtes pas un administrateur, cette page vous est interdite !</div>";
    }
    ?>

</body>

</html>