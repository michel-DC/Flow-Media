<?php
require_once '../../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Récupérer la dernière réservation de l'utilisateur
$query = "SELECT r.*, a.titre, a.adresse, a.region 
          FROM reservations r 
          JOIN all_activites a ON r.activite_id = a.id 
          WHERE r.user_id = " . $_SESSION['user_id'] . " 
          ORDER BY r.date_reservation DESC 
          LIMIT 1";
$result = mysqli_query($link, $query);
$reservation = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Résumé de votre réservation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #3a791f;
            --secondary-color: #8ac571;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: var(--light-bg);
            min-height: 100vh;
        }

        .resume-container {
            max-width: 800px;
            margin: 150px auto 100px;
            padding: 20px;
        }

        .resume-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-sm);
        }

        .success-icon {
            text-align: center;
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .resume-title {
            text-align: center;
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .resume-details {
            margin-bottom: 30px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #666;
            font-weight: 500;
        }

        .detail-value {
            color: var(--text-color);
            font-weight: 600;
        }

        .total-price {
            text-align: right;
            font-size: 1.5rem;
            color: var(--primary-color);
            font-weight: 600;
            margin-top: 20px;
        }

        .back-button {
            display: inline-block;
            padding: 12px 24px;
            background: var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 8px;
            margin-top: 30px;
            transition: background 0.3s ease;
        }

        .back-button:hover {
            background: var(--secondary-color);
        }

        .sms-confirmation {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .sms-confirmation i {
            font-size: 24px;
            color: var(--primary-color);
        }

        .sms-confirmation p {
            margin: 0;
            color: var(--text-color);
            font-size: 1.1rem;
        }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            font-size: clamp(3rem, 8vw, 8rem);
            opacity: 0.15;
            animation: float 20s linear infinite;
            color: var(--primary-color);
            filter: drop-shadow(0 0 10px rgba(58, 121, 31, 0.3));
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
            color: var(--primary-color);
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: -5s;
            color: var(--secondary-color);
        }

        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 15%;
            animation-delay: -10s;
            color: var(--primary-color);
        }

        .floating-element:nth-child(4) {
            bottom: 20%;
            right: 20%;
            animation-delay: -15s;
            color: var(--secondary-color);
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg) scale(1);
            }

            50% {
                transform: translate(30px, 30px) rotate(180deg) scale(1.1);
            }

            100% {
                transform: translate(0, 0) rotate(360deg) scale(1);
            }
        }
    </style>
</head>

<body>
    <?php include '../../../includes/layout/navbar.php' ?>

    <div class="floating-elements">
        <i class="fas fa-check-circle floating-element"></i>
        <i class="fas fa-calendar-check floating-element"></i>
        <i class="fas fa-ticket-alt floating-element"></i>
        <i class="fas fa-thumbs-up floating-element"></i>
    </div>

    <div class="resume-container">
        <div class="resume-card">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="resume-title">Réservation confirmée !</h1>

            <div class="resume-details">
                <div class="detail-item">
                    <span class="detail-label">Activité</span>
                    <span class="detail-value"><?php echo htmlspecialchars($reservation['titre']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Adresse</span>
                    <span class="detail-value"><?php echo htmlspecialchars($reservation['adresse']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Région</span>
                    <span class="detail-value"><?php echo htmlspecialchars($reservation['region']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date de réservation</span>
                    <span class="detail-value"><?php echo date('d/m/Y H:i', strtotime($reservation['date_reservation'])); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Nombre de places</span>
                    <span class="detail-value"><?php echo $reservation['places']; ?></span>
                </div>
            </div>

            <div class="sms-confirmation">
                <i class="fas fa-mobile-alt"></i>
                <p>Vous allez recevoir un SMS de confirmation avec les détails de votre réservation.</p>
            </div>

            <a href="index.php" class="back-button">
                Retour aux activités
            </a>
        </div>
    </div>

    <?php include '../../../includes/layout/footer.php'; ?>
</body>

</html>