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

// Get user interests
$interests_query = "SELECT i.id, i.nom FROM interets i 
                   JOIN user_interet ui ON i.id = ui.interet_id 
                   WHERE ui.user_id = '$user_id'";
$interests_result = mysqli_query($link, $interests_query);
$user_interests = [];
while ($row = mysqli_fetch_assoc($interests_result)) {
    $user_interests[$row['id']] = $row['nom'];
}

// Get all available interests
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

    // Handle interests update
    // Delete all existing interests for this user first
    $delete_query = "DELETE FROM user_interet WHERE user_id = '$user_id'";
    mysqli_query($link, $delete_query);
    
    // If interests are selected, insert them
    if (isset($_POST['interests']) && !empty($_POST['interests'])) {
        $selected_interests = $_POST['interests'];
        
        foreach ($selected_interests as $interest_id) {
            $interest_id = mysqli_real_escape_string($link, $interest_id);
            $insert_query = "INSERT INTO user_interet (user_id, interet_id) VALUES ('$user_id', '$interest_id')";
            mysqli_query($link, $insert_query);
        }
    }
    // If no interests are selected, the DELETE query above already removed all interests

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

    $update_query = "UPDATE users SET fullname='$fullname', email='$email', photo_profil='$photo_profil', ville='$ville' WHERE id='$user_id'";

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
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');

        body {
            font-family: "Space Grotesk", sans-serif;
            background-color: #FFFFFF;
            color: #000000;
            margin: 0;
            padding: 0;
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
        
        .interests-section {
            margin: 30px 0;
            padding: 20px;
            border: 1px solid #000000;
            border-radius: 8px;
        }
        
        .interests-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }
        
        .interest-item {
            display: flex;
            align-items: center;
        }
        
        .interest-item input {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<?php include '../../includes/layout/navbar.php'; ?>

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

            <div class="interests-section">
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

            <button type="submit" name="update_profile" class="btn">Mettre à jour</button>
        </form>
    </div>

    <?php include '../../includes/layout/footer.php'; ?>

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
