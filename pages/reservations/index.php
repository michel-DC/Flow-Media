<?php
require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Récupérer toutes les réservations de l'utilisateur
$query = "SELECT r.*, a.titre, a.date_activite, a.lieu, a.prix, a.image_url 
          FROM reservations r 
          JOIN activites a ON r.activite_id = a.id 
          WHERE r.user_id = " . $_SESSION['user_id'] . " 
          ORDER BY r.date_reservation DESC";
$result = mysqli_query($link, $query);

// Traitement de l'annulation
if (isset($_POST['cancel_reservation'])) {
    $reservation_id = $_POST['reservation_id'];
    $delete_query = "DELETE FROM reservations WHERE id = " . $reservation_id . " AND user_id = " . $_SESSION['user_id'];
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
    <title>Flow Media | Mes réservations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
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

        .reservations-container {
            max-width: 1200px;
            margin: 0 auto 100px;
            padding: 20px;
        }

        .reservations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .reservation-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease;
        }

        .reservation-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .reservation-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .reservation-content {
            padding: 20px;
        }

        .reservation-title {
            font-size: 1.2rem;
            color: var(--text-color);
            margin-bottom: 15px;
        }

        .reservation-details {
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            color: #666;
            font-size: 0.9rem;
        }

        .detail-item i {
            color: var(--primary-color);
            width: 20px;
        }

        .reservation-price {
            font-size: 1.2rem;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 15px;
        }

        .cancel-button {
            text-align: center;
            display: block;
            width: 50%;
            margin: 0 auto;
            padding: 10px;
            background: var(--danger-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.3s ease;
            text-decoration: none;
        }

        .cancel-button:hover {
            background: #c82333;
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

        .no-reservations {
            text-align: center;
            color: #666;
            font-size: 1.2rem;
            margin-top: 50px;
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
    <?php include '../../includes/layout/navbar.php' ?>

    <div class="floating-elements">
        <i class="fas fa-calendar-check floating-element"></i>
        <i class="fas fa-ticket-alt floating-element"></i>
        <i class="fas fa-clock floating-element"></i>
        <i class="fas fa-calendar-times floating-element"></i>
    </div>

    <h1 class="page-title">Mes réservations</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="message success">Réservation annulée avec succès !</div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="reservations-container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="reservations-grid">
                <?php while ($reservation = mysqli_fetch_assoc($result)): ?>
                    <div class="reservation-card">
                        <img src="../../<?php echo htmlspecialchars($reservation['image_url']); ?>" alt="<?php echo htmlspecialchars($reservation['titre']); ?>" class="reservation-image">
                        <div class="reservation-content">
                            <h3 class="reservation-title"><?php echo htmlspecialchars($reservation['titre']); ?></h3>
                            <div class="reservation-details">
                                <div class="detail-item">
                                    <i class="far fa-calendar"></i>
                                    <?php echo date('d/m/Y', strtotime($reservation['date_activite'])); ?>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo htmlspecialchars($reservation['lieu']); ?>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-user"></i>
                                    <?php echo $reservation['places']; ?> place(s)
                                </div>
                            </div>
                            <div class="reservation-price">
                                Total: <?php echo number_format($reservation['prix'] * $reservation['places'], 2); ?> €
                            </div>
                            <a href="annuler.php?id=<?php echo $reservation['id']; ?>" class="cancel-button">

                                Annuler la réservation
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-reservations">
                Vous n'avez aucune réservation pour le moment.
            </div>
        <?php endif; ?>
    </div>

    <?php include '../../includes/layout/footer.php'; ?>
</body>

</html>