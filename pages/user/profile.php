<?php
session_start();

if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true) {
    header('Location: ../../connexion/login.php?erreur=non_connecte');
    exit();
}

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update_profile'])) {
    $fullname = mysqli_real_escape_string($link, $_POST['fullname']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $ville = mysqli_real_escape_string($link, $_POST['ville']);

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
            }
        }
    }

    // pour convetrir le nom d'une ville en coordonée GPS et ensuite les inserer dans ma BDD
$latitude = null;
$longitude = null;

// Appel à l'API Nominatim pour géocoder la ville
$q = urlencode($ville);
$url = "https://nominatim.openstreetmap.org/search?country=France&format=json&limit=1&city=$q";

$options = [
    "http" => [
        "header" => "User-Agent: FlowMediaApp"
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$data = json_decode($response, true);

if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
    $latitude = $data[0]['lat'];
    $longitude = $data[0]['lon'];
}


$update_query = " UPDATE users 
                SET fullname='$fullname', email='$email', photo_profil='$photo_profil', ville='$ville',
                latitude=' . ($latitude ? "'$latitude'" : "NULL") . ',
                longitude=' . ($longitude ? "'$longitude'" : "NULL") . '
                WHERE id='$user_id' ";


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
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil | Flow Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');

        body {
            font-family: "Space Grotesk", sans-serif;
            background-color: #FFFFFF;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .navbar {
            position: sticky;
            top: 0;
            background: var(--white);
            padding: 0.50rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .nav-links a {
            color: var(--soft-black);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-links a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #000000;
        }

        .profile-form {
            background: #FFFFFF;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #000000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #000000;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn {
            background: #000000;
            color: #FFFFFF;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #333333;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }

        .error {
            background-color: #FFEBEE;
            color: #C62828;
            border: 1px solid #EF9A9A;
        }

        .success {
            background-color: #E8F5E9;
            color: #2E7D32;
            border: 1px solid #A5D6A7;
        }
    </style>
</head>
<body>

<nav class="navbar">
        <div class="logo">
            <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8ZM9.25 3.75C9.25 4.44036 8.69036 5 8 5C7.30964 5 6.75 4.44036 6.75 3.75C6.75 3.05964 7.30964 2.5 8 2.5C8.69036 2.5 9.25 3.05964 9.25 3.75ZM12 8H9.41901L11.2047 13H9.081L8 9.97321L6.91901 13H4.79528L6.581 8H4V6H12V8Z" fill="#000000"/>
            </svg>
        </div>
        <div class="nav-links">
            <a href="../../index.php" style="display: flex; align-items: center;"><i class="fas fa-home"></i></a>
            
            <div class="nav-dropdown">
                <button class="nav-dropbtn">Découvrir <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/pages/about"><i class="fas fa-question-circle"></i> Qui sommes-nous</a>
                    <a href="/pages/domaines-culturels"><i class="fas fa-landmark"></i> Domaines culturels</a>
                    <a href="/pages/patenaires"><i class="fas fa-handshake"></i> Partenaires</a>
                    <a href="/pages/contact"><i class="fas fa-envelope"></i> Nous contacter</a>
                </div>
            </div>
            
            <div class="nav-dropdown">
                <button class="nav-dropbtn">Expériences <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                <a href="/pages/agenda"><i class="fas fa-calendar-alt"></i> Agenda</a>
                    <a href="/pages/activites"><i class="fas fa-landmark"></i> Activités</a>
                    <a href="/pages/podcast"><i class="fas fa-podcast"></i> Podcasts & interview</a>
                    <a href="/pages/temoignages"><i class="fas fa-comment-alt"></i> Témoignages</a>
                </div>
            </div>
            
            <?php if (isset($_SESSION['connecté']) && $_SESSION['connecté'] === true && $_SESSION['role'] == 'user'): ?>
            <div class="nav-dropdown">
                <button class="nav-dropbtn"><i class="fas fa-user-alt"></i> <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/connexion/login.php">Mon profil</a>
                    <a href="/connexion/register.php">Mes réservations</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true): ?>
                <div class="nav-dropdown">
                <button class="nav-dropbtn"><i class="fas fa-user-alt"></i> <i class="fa fa-caret-down"></i></button>
                <div class="nav-dropdown-content">
                    <a href="/connexion/login.php">Me connecter</a>
                    <a href="/connexion/register.php">M'inscrire</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <style>
            .nav-dropdown {
                position: relative;
                display: inline-block;
            }
            
            .nav-dropbtn {
                background-color: transparent;
                color: var(--soft-black);
                padding: 12px 16px;
                font-size: inherit;
                font-family: inherit;
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 5px;
            }
            
            .nav-dropdown-content {
                display: none;
                position: absolute;
                background-color: var(--white);
                min-width: 200px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
                border-radius: 4px;
                right: 0;
            }
            
            .nav-dropdown-content a {
                color: var(--soft-black);
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
                transition: background-color 0.3s ease;
            }
            
            .nav-dropdown-content a:hover {
                background-color: #f1f1f1;
            }
            
            .nav-dropdown:hover .nav-dropdown-content {
                display: block;
            }
            
            .nav-dropdown:hover .nav-dropbtn {
                opacity: 0.8;
            }
        </style>
    </nav>

    <div class="container">
        <div class="profile-header">
            <h1>Mon Profil</h1>
            <?php if (!empty($user['photo_profil'])): ?>
                <img src="../../assets/uploads/profiles/<?php echo $user['photo_profil']; ?>" alt="Photo de profil" class="profile-picture">
            <?php else: ?>
                <div class="profile-picture" style="background-color: #e0e0e0; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 50px;">👤</span>
                </div>
            <?php endif; ?>
        </div>

        <?php if (isset($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form class="profile-form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profile_picture">Photo de profil</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            </div>

            <div class="form-group">
                <label for="fullname">Nom complet</label>
                <input type="text" id="fullname" name="fullname" class="input-field" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="input-field" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" class="input-field" autocomplete="off" list="ville-list" value="<?php echo htmlspecialchars($user['ville'] ?? ''); ?>">
                <datalist id="ville-list"></datalist>
            </div>

            <button type="submit" name="update_profile" class="btn">Mettre à jour</button>
        </form>
    </div>

    <!-- javascript pour fetch l'api pour l'autocompletion du nom des villes -->
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



</body>
</html>
