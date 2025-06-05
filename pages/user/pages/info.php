<?php

require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

// $abonnement_query = "SELECT a.* FROM abonnements a JOIN users u ON a.id = u.abonnement_id WHERE u.id = '$user_id'";
// $abonnement_result = mysqli_query($link, $abonnement_query);
// $abonnement = mysqli_fetch_assoc($abonnement_result);

if (isset($_POST['update_profile'])) {
    $fullname = mysqli_real_escape_string($link, $_POST['nom']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $ville = mysqli_real_escape_string($link, $_POST['ville']);
    $age = mysqli_real_escape_string($link, $_POST['age']);
    $avatar = mysqli_real_escape_string($link, $_POST['avatar']);

    require_once '../../algorithme/geocode.php';
    $geocode_result = geocodeCity($ville);

    $latitude = $geocode_result ? $geocode_result['latitude'] : 'NULL';
    $longitude = $geocode_result ? $geocode_result['longitude'] : 'NULL';

    $delete_query = "DELETE FROM user_interet WHERE user_id = '$user_id'";
    mysqli_query($link, $delete_query);

    $update_query = "UPDATE users SET
            fullname='$fullname',
            email='$email',
            photo_profil='$avatar.svg',
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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section Profil Utilisateur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
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

        /* Section profil */
        .profile-section {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .profile-container {
            background-color: #ffffff;
            border-radius: 30px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        /* Section choix d'avatar */
        .avatar-section {
            margin-bottom: 50px;
        }

        .avatar-selection {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            margin-bottom: 40px;
        }

        .avatar-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .placeholder-circle {
            width: 120px;
            height: 120px;
            background-color: #D0D0D0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .placeholder-icon {
            width: 60px;
            height: 60px;
            background-color: #ffffff;
            border-radius: 50%;
            position: relative;
        }

        .placeholder-icon::before {
            content: '';
            width: 30px;
            height: 30px;
            background-color: #D0D0D0;
            border-radius: 50%;
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
        }

        .placeholder-icon::after {
            content: '';
            width: 45px;
            height: 25px;
            background-color: #D0D0D0;
            border-radius: 25px 25px 0 0;
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
        }

        .avatar-text {
            font-size: 16px;
            font-weight: 500;
            color: #000000;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .avatar-options {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .avatar-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .avatar-option:hover {
            transform: scale(1.05);
        }

        .avatar-option.selected {
            transform: scale(1.1);
        }

        .avatar-option.selected .avatar-image {
            box-shadow: 0 0 0 4px #FF3131;
        }

        .avatar-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            transition: box-shadow 0.3s ease;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-image img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .avatar-name {
            font-size: 14px;
            font-weight: 500;
            color: #000000;
            font-family: 'Poppins', sans-serif;
        }

        .or-text {
            font-size: 16px;
            font-weight: 500;
            color: #666666;
            font-family: 'Poppins', sans-serif;
        }

        /* Formulaire */
        .form-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-input {
            padding: 18px 20px;
            border: none;
            border-radius: 15px;
            background-color: #F0F0F0;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            color: #000000;
            transition: background-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            background-color: #E8E8E8;
        }

        .form-input::placeholder {
            color: #999999;
            font-weight: 400;
        }

        /* Checkbox newsletter */
        .newsletter-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
        }

        .checkbox-container {
            position: relative;
        }

        .checkbox-input {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #D0D0D0;
            border-radius: 4px;
            background-color: #ffffff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-input:checked {
            background-color: #8E44AD;
            border-color: #8E44AD;
        }

        .checkbox-input:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .newsletter-text {
            font-size: 14px;
            color: #666666;
            font-family: 'Poppins', sans-serif;
            line-height: 1.4;
        }

        /* Bouton de soumission */
        .submit-section {
            margin-top: 30px;
            text-align: center;
        }

        .submit-button {
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
        }

        .submit-button:hover {
            background-color: #e02828;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .profile-section {
                padding: 0 20px;
            }

            .profile-container {
                padding: 30px;
                border-radius: 20px;
            }

            .avatar-selection {
                flex-direction: column;
                gap: 30px;
            }

            .avatar-options {
                gap: 20px;
            }

            .placeholder-circle {
                width: 100px;
                height: 100px;
            }

            .avatar-image {
                width: 70px;
                height: 70px;
            }

            .avatar-image img {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            .profile-container {
                padding: 20px;
            }

            .form-input {
                padding: 15px 18px;
                font-size: 14px;
            }

            .submit-button {
                padding: 15px 30px;
                font-size: 14px;
            }

            .newsletter-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
</head>

<body>
    <!-- Section profil utilisateur -->
    <section class="profile-section">
        <div class="profile-container">
            <!-- Section choix d'avatar -->
            <div class="avatar-section">
                <div class="avatar-selection">
                    <div class="avatar-placeholder">
                        <div class="placeholder-circle">
                            <div class="placeholder-icon"></div>
                        </div>
                        <span class="avatar-text">Choisis ton avatar</span>
                    </div>

                    <div class="avatar-options">
                        <div class="avatar-option <?php echo ($user['photo_profil'] == 'jardi.svg') ? 'selected' : ''; ?>" onclick="selectAvatar('jardi')" id="jardi-option">
                            <div class="avatar-image">
                                <img src="../../assets/images/mascottes/jardi.svg" alt="Jardi">
                            </div>
                            <span class="avatar-name">Jardi</span>
                        </div>

                        <span class="or-text">ou</span>

                        <div class="avatar-option <?php echo ($user['photo_profil'] == 'archi.svg') ? 'selected' : ''; ?>" onclick="selectAvatar('archi')" id="archi-option">
                            <div class="avatar-image">
                                <img src="../../assets/images/mascottes/archi.svg" alt="Archi">
                            </div>
                            <span class="avatar-name">Archi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
            <form class="form-section" method="POST" action="me.php#info-section">
                <input type="hidden" name="avatar" id="selected-avatar" value="<?php echo str_replace('.svg', '', $user['photo_profil']); ?>">

                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Nom complet" name="nom" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>

                <div class="form-group">
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
                    <input type="text" id="ville" name="ville" placeholder="Ville d'habitation" value="<?php echo htmlspecialchars($user['ville'] ?? ''); ?>" class="form-input" autocomplete="off" list="ville-list">
                    <datalist id="ville-list"></datalist>
                </div>

                <div class="newsletter-section">
                    <div class="checkbox-container">
                        <input type="checkbox" class="checkbox-input" id="newsletter" name="newsletter">
                    </div>
                    <label for="newsletter" class="newsletter-text">
                        J'accepte de participer à la newsletter à deux pas
                    </label>
                </div>

                <div class="submit-section">
                    <button type="submit" name="update_profile" class="submit-button">Mettre à jour</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        let selectedAvatar = '<?php echo str_replace('.svg', '', $user['photo_profil']); ?>';

        function selectAvatar(avatarName) {
            document.querySelectorAll('.avatar-option').forEach(option => {
                option.classList.remove('selected');
            });

            document.getElementById(avatarName + '-option').classList.add('selected');
            selectedAvatar = avatarName;
            document.getElementById('selected-avatar').value = avatarName;
        }

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