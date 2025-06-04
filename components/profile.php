<?php
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);
    $avatar = str_replace('.svg', '', $user['photo_profil']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur avec Badges</title>
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
            padding: 40px 0;
        }

        /* Section profil */
        .profile-section {
            max-width: 70%;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* En-tête profil */
        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 60px 0 30px;
        }

        .avatar-container {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background-color: #FFB6B9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .avatar-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Personnage stylisé */
        .character-head {
            width: 40px;
            height: 40px;
            background-color: #F5D0C5;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .character-eyes {
            position: absolute;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        .eye {
            width: 6px;
            height: 6px;
            background-color: #333;
            border-radius: 50%;
        }

        .character-hair {
            width: 50px;
            height: 25px;
            background-color: #8B4513;
            border-radius: 25px 25px 0 0;
            position: absolute;
            top: -5px;
            left: 50%;
            transform: translateX(-50%);
        }

        .character-body {
            width: 60px;
            height: 70px;
            background-color: #FF3131;
            border-radius: 15px 15px 0 0;
            position: absolute;
            top: 35px;
            left: 50%;
            transform: translateX(-50%);
        }

        .character-collar {
            width: 20px;
            height: 20px;
            background-color: #FF3131;
            clip-path: polygon(0% 0%, 100% 0%, 50% 100%);
            position: absolute;
            top: 35px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
        }

        .username {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-top: 15px;
            font-family: 'Poppins', sans-serif;
        }

        /* Section informations */
        .info-section {
            padding: 40px 50px;
            border-bottom: 1px solid #f0f0f0;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
            font-family: 'Poppins', sans-serif;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .info-label {
            font-size: 18px;
            color: #999;
            font-family: 'Poppins', sans-serif;
        }

        .info-value {
            font-size: 18px;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }

        .edit-button {
            background: none;
            border: none;
            color: #FF3131;
            font-size: 16px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }

        /* Section badges */
        .badges-section {
            padding: 40px 50px;
        }

        .badge-row {
            display: flex;
            align-items: center;
            margin-bottom: 35px;
        }

        .badge-icon {
            width: 80px;
            height: 80px;
            background-color: #f0f0f0;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 30px;
            transform: rotate(45deg);
            position: relative;
        }

        .badge-icon-inner {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .badge-info {
            flex: 1;
        }

        .badge-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
            margin-bottom: 8px;
            font-family: 'Poppins', sans-serif;
        }

        .badge-stats {
            font-size: 16px;
            color: #666;
            font-family: 'Poppins', sans-serif;
        }

        .total-points {
            font-size: 20px;
            font-weight: 500;
            color: #333;
            margin: 30px 0;
            font-family: 'Poppins', sans-serif;
        }

        .points-highlight {
            font-weight: 600;
        }

        .no-rewards {
            font-size: 18px;
            color: #666;
            margin: 40px 0 30px;
            font-family: 'Poppins', sans-serif;
        }

        .locked-badges {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .locked-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 30%;
        }

        .locked-icon {
            width: 80px;
            height: 80px;
            background-color: #d0d0d0;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            transform: rotate(45deg);
        }

        .locked-icon-inner {
            width: 100%;
            height: 100%;
            object-fit: contain;
            opacity: 0.5;
        }

        .locked-name {
            font-size: 16px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 8px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .locked-points {
            font-size: 14px;
            color: #999;
            font-family: 'Poppins', sans-serif;
        }

        @media (max-width: 1200px) {
            .profile-section {
                max-width: 85%;
            }
        }

        @media (max-width: 768px) {
            .profile-section {
                max-width: 95%;
            }

            .avatar-container {
                width: 140px;
                height: 140px;
            }

            .info-section,
            .badges-section {
                padding: 30px;
            }

            .badge-icon {
                width: 60px;
                height: 60px;
                margin-right: 20px;
            }

            .locked-badges {
                flex-wrap: wrap;
                gap: 30px;
                justify-content: center;
            }

            .locked-badge {
                width: 40%;
            }
        }

        @media (max-width: 480px) {
            .profile-section {
                max-width: 100%;
                border-radius: 0;
            }

            .avatar-container {
                width: 120px;
                height: 120px;
            }

            .info-section,
            .badges-section {
                padding: 20px;
            }

            .badge-icon {
                width: 50px;
                height: 50px;
                margin-right: 15px;
            }

            .locked-badge {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Section profil utilisateur avec badges -->
    <section class="profile-section">
        <!-- En-tête profil -->
        <div class="profile-header">
            <div class="avatar-container">
                <?php if (!empty($avatar) && ($avatar == 'jardi' || $avatar == 'archi')): ?>
                    <img src="../../assets/images/mascottes/<?php echo $avatar; ?>.svg" alt="<?php echo ucfirst($avatar); ?>" class="avatar-image">
                <?php else: ?>
                    <img src="../../assets/images/mascottes/jardi.svg" alt="Jardi" class="avatar-image">
                <?php endif; ?>
            </div>
            <h1 class="username"><?php echo htmlspecialchars($user['fullname']); ?></h1>
        </div>

        <!-- Section informations -->
        <div class="info-section">
            <h2 class="section-title">Vos informations</h2>

            <div class="info-row">
                <div>
                    <div class="info-label">Votre age</div>
                    <div class="info-value"><?php echo htmlspecialchars($user['age']); ?> ans</div>
                </div>
                <a href="me.php#info-section">
                    <button class="edit-button">Modifier</button>
                </a>
            </div>

            <div class="info-row">
                <div>
                    <div class="info-label">Adresse mail</div>
                    <div class="info-value"><?php echo htmlspecialchars($user['email']); ?></div>
                </div>
                <a href="me.php#info-section">
                    <button class="edit-button">Modifier</button>
                </a>
            </div>
        </div>

        <!-- Section badges -->
        <div class="badges-section">
            <!-- Badge Curieux -->
            <div class="badge-row">
                <div class="badge-icon">
                    <img src="../../assets/images/quizz/loupe.svg" alt="Badge Curieux" class="badge-icon-inner">
                </div>
                <div class="badge-info">
                    <div class="badge-name">Badge Curieux</div>
                    <div class="badge-stats">Nombre : 5 &nbsp;&nbsp; Points : 5</div>
                </div>
            </div>

            <!-- Badge Explorateur -->
            <div class="badge-row">
                <div class="badge-icon">
                    <img src="../../assets/images/quizz/boussole.svg" alt="Badge Explorateur" class="badge-icon-inner">
                </div>
                <div class="badge-info">
                    <div class="badge-name">Badge Explorateur</div>
                    <div class="badge-stats">Nombre : 1 &nbsp;&nbsp; Points : 2</div>
                </div>
            </div>

            <!-- Badge Architecte -->
            <div class="badge-row">
                <div class="badge-icon">
                    <img src="../../assets/images/badges/maison.svg" alt="Badge Architecte" class="badge-icon-inner">
                </div>
                <div class="badge-info">
                    <div class="badge-name">Badge Architecte</div>
                    <div class="badge-stats">Nombre : 3 &nbsp;&nbsp; Points : 9</div>
                </div>
            </div>

            <!-- Total des points -->
            <div class="total-points">
                Nombre total de points : <span class="points-highlight">17 points</span>
            </div>

            <!-- Message pas de récompense -->
            <div class="no-rewards">
                Vous n'avez aucun badge de récompense...
            </div>

            <!-- Badges verrouillés -->
            <div class="locked-badges">
                <!-- Badge Pro -->
                <div class="locked-badge">
                    <div class="locked-icon">
                        <img src="../../assets/images/badges/pro.svg" alt="Badge Pro" class="locked-icon-inner">
                    </div>
                    <div class="locked-name">Badge Pro</div>
                    <div class="locked-points">25 points</div>
                </div>

                <!-- Badge Maître -->
                <div class="locked-badge">
                    <div class="locked-icon">
                        <img src="../../assets/images/badges/maitre.svg" alt="Badge Maître" class="locked-icon-inner">
                    </div>
                    <div class="locked-name">Badge Maître</div>
                    <div class="locked-points">50 points</div>
                </div>

                <!-- Badge Légende -->
                <div class="locked-badge">
                    <div class="locked-icon">
                        <img src="../../assets/images/badges/legende.svg" alt="Badge Légende" class="locked-icon-inner">
                    </div>
                    <div class="locked-name">Badge Légende</div>
                    <div class="locked-points">100 points</div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>