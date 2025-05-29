<?php
require_once '../../includes/auth.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Récupérer les détails de la réservation
$query = "SELECT r.*, a.titre, a.date_activite, a.lieu, a.prix, a.image_url 
          FROM reservations r 
          JOIN activites a ON r.activite_id = a.id 
          WHERE r.id = " . $_GET['id'] . " AND r.user_id = " . $_SESSION['user_id'];
$result = mysqli_query($link, $query);
$reservation = mysqli_fetch_assoc($result);

if (!$reservation) {
    header('Location: index.php');
    exit;
}

// Traitement de l'annulation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_query = "DELETE FROM reservations WHERE id = " . $_GET['id'] . " AND user_id = " . $_SESSION['user_id'];
    if (mysqli_query($link, $delete_query)) {
        header('Location: index.php?success=1');
        exit;
    } else {
        $error = "Une erreur est survenue lors de l'annulation de la réservation.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Annuler une réservation</title>
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
            --danger-color: #dc3545;
        }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: var(--light-bg);
            min-height: 100vh;
        }

        .page-title {
            color: var(--primary-color);
            text-align: center;
            margin: 150px 0 30px;
            font-size: 2.5rem;
        }

        .cancel-container {
            max-width: 800px;
            margin: 0 auto 100px;
            padding: 20px;
        }

        .cancel-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-sm);
        }

        .warning-icon {
            text-align: center;
            font-size: 4rem;
            color: var(--danger-color);
            margin-bottom: 20px;
        }

        .cancel-title {
            text-align: center;
            color: var(--danger-color);
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .reservation-details {
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

        .buttons-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }

        .cancel-button {
            padding: 12px 24px;
            background: var(--danger-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .cancel-button:hover {
            background: #c82333;
        }

        .back-button {
            padding: 12px 24px;
            background: var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 8px;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .back-button:hover {
            background: var(--secondary-color);
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
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
            animation: fadeOut 3s forwards;
            font-size: 14px;
            z-index: 9999;
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
            color: var(--danger-color);
            filter: drop-shadow(0 0 10px rgba(220, 53, 69, 0.3));
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
            color: var(--danger-color);
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: -5s;
            color: var(--danger-color);
        }

        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 15%;
            animation-delay: -10s;
            color: var(--danger-color);
        }

        .floating-element:nth-child(4) {
            bottom: 20%;
            right: 20%;
            animation-delay: -15s;
            color: var(--danger-color);
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
    <?php include '../../includes/layout/navbar.php' ?>

    <div class="floating-elements">
        <i class="fas fa-exclamation-triangle floating-element"></i>
        <i class="fas fa-times-circle floating-element"></i>
        <i class="fas fa-ban floating-element"></i>
        <i class="fas fa-calendar-times floating-element"></i>
    </div>

    <h1 class="page-title">Annuler une réservation</h1>

    <?php if (isset($error)): ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
        <div class="message success">Réservation annulée avec succès !</div>
    <?php endif; ?>

    <div class="cancel-container">
        <div class="cancel-card">
            <div class="warning-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h2 class="cancel-title">Êtes-vous sûr de vouloir annuler cette réservation ?</h2>

            <div class="reservation-details">
                <div class="detail-item">
                    <span class="detail-label">Activité</span>
                    <span class="detail-value"><?php echo htmlspecialchars($reservation['titre']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date de l'activité</span>
                    <span class="detail-value"><?php echo date('d/m/Y', strtotime($reservation['date_activite'])); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Lieu</span>
                    <span class="detail-value"><?php echo htmlspecialchars($reservation['lieu']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Nombre de places</span>
                    <span class="detail-value"><?php echo $reservation['places']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Prix total</span>
                    <span class="detail-value"><?php echo number_format($reservation['prix'] * $reservation['places'], 2); ?> €</span>
                </div>
            </div>

            <div class="buttons-container">
                <form method="POST" style="display: inline;">
                    <button type="submit" class="cancel-button">
                        Confirmer l'annulation
                    </button>
                </form>
                <a href="index.php" class="back-button">
                    Retour aux réservations
                </a>
            </div>
        </div>
    </div>

    <?php include '../../includes/layout/footer.php'; ?>
</body>

</html>