<?php

require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

$abonnement_query = "SELECT a.* FROM abonnements a JOIN users u ON a.id = u.abonnement_id WHERE u.id = '$user_id'";
$abonnement_result = mysqli_query($link, $abonnement_query);
$abonnement = mysqli_fetch_assoc($abonnement_result);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Abonnement | Flow Media</title>
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

        .profile-section {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .profile-container {
            background-color: #ffffff;
            border-radius: 30px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .subscription-section {
            margin-bottom: 40px;
        }

        .subscription-title {
            font-size: 24px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 20px;
            text-align: center;
        }

        .subscription-description {
            font-size: 16px;
            color: #666666;
            margin-bottom: 30px;
            text-align: center;
        }

        .subscription-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .subscription-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
        }

        .subscription-name {
            font-size: 28px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 15px;
        }

        .subscription-price {
            font-size: 36px;
            font-weight: 800;
            color: #FF3131;
            margin-bottom: 30px;
        }

        .subscription-features {
            list-style: none;
            padding: 0;
            margin: 0 0 30px 0;
            text-align: left;
        }

        .subscription-features li {
            padding: 12px 0;
            border-bottom: 1px solid #F0F0F0;
            font-size: 16px;
            color: #666666;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .subscription-features li:last-child {
            border-bottom: none;
        }

        .subscription-features li::before {
            content: '✓';
            color: #FF3131;
            font-weight: bold;
        }

        .change-subscription {
            background-color: #FF3131;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 18px 40px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .change-subscription:hover {
            background-color: #e02828;
            transform: translateY(-2px);
        }

        .subscription-info {
            text-align: center;
            color: #666666;
            font-size: 14px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .profile-section {
                padding: 0 20px;
            }

            .profile-container {
                padding: 30px;
                border-radius: 20px;
            }

            .subscription-card {
                padding: 30px;
            }

            .subscription-name {
                font-size: 24px;
            }

            .subscription-price {
                font-size: 32px;
            }

            .subscription-features li {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <section class="profile-section">
        <div class="profile-container">
            <div class="subscription-section">
                <h2 class="subscription-title">Mon Abonnement</h2>
                <p class="subscription-description">Gérez votre abonnement actuel et découvrez les avantages de chaque formule</p>

                <div class="subscription-card">
                    <?php if ($user['abonnement_id'] == 1): ?>
                        <img src="../../assets/icons/black-star.svg" alt="Gratuit" class="subscription-icon">
                        <h3 class="subscription-name">Formule Gratuite</h3>
                        <div class="subscription-price">Gratuit</div>
                        <ul class="subscription-features">
                            <li>Accès aux contenus de base</li>
                            <li>1 activité réservable par mois</li>
                        </ul>
                    <?php elseif ($user['abonnement_id'] == 2): ?>
                        <img src="../../assets/icons/gold-star.svg" alt="Gold" class="subscription-icon">
                        <h3 class="subscription-name">Formule Gold</h3>
                        <div class="subscription-price" style="color: #FFD700;">Gold</div>
                        <ul class="subscription-features">
                            <li>Accès à tous les contenus premium</li>
                            <li>5 activités réservables par mois</li>
                            <li>Podcasts exclusifs</li>
                            <li>Codes promo mensuels</li>
                        </ul>
                    <?php elseif ($user['abonnement_id'] == 3): ?>
                        <img src="../../assets/icons/plat-star.png" alt="Platine" class="subscription-icon">
                        <h3 class="subscription-name">Formule Platine</h3>
                        <div class="subscription-price" style="color: #A8A8A8;">Platine</div>
                        <ul class="subscription-features">
                            <li>Accès à tous les contenus premium</li>
                            <li>Nombre illimité d'activités réservables par mois</li>
                            <li>Podcasts exclusifs</li>
                            <li>Codes promo mensuels</li>
                            <li>Accès prioritaire aux événements</li>
                            <li>Invitations VIP</li>
                        </ul>
                    <?php endif; ?>

                    <a href="../abonnement/index.php?user_id=<?php echo $user_id; ?>" class="change-subscription">Changer d'abonnement</a>
                    <p class="subscription-info">Vous pouvez changer d'abonnement à tout moment. Le changement prendra effet immédiatement.</p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>