<?php
require_once '../../../includes/auth.php';
require_once '../../../includes/reservation_auth.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$user_query = "SELECT fullname, email FROM users WHERE id = " . $_SESSION['user_id'];
$user_result = mysqli_query($link, $user_query);
$user = mysqli_fetch_assoc($user_result);

$query = "SELECT * FROM all_activites WHERE id = " . $_GET['id'];
$result = mysqli_query($link, $query);
$activity = mysqli_fetch_assoc($result);

if (!$activity) {
    header('Location: index.php');
    exit;
}

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth_result = checkReservationAuth($_SESSION['user_id']);
    if (!$auth_result['authorized']) {
        $error_message = $auth_result['message'];
        if (isset($auth_result['upgrade_link'])) {
            $error_message .= ' <a href="' . $auth_result['upgrade_link'] . '" style="color: var(--primary-color); text-decoration: underline;">Cliquez ici pour changer d\'abonnement</a>';
        }
    } else {
        $places = isset($_POST['spots']) ? (int)$_POST['spots'] : 1;
        $date_reservation = date('Y-m-d H:i:s');

        $insert_query = "INSERT INTO reservations (user_id, activite_id, date_reservation, places) 
                        VALUES (" . $_SESSION['user_id'] . ", " . $_GET['id'] . ", '" . $date_reservation . "', " . $places . ")";

        if (mysqli_query($link, $insert_query)) {
            header('Location: resume.php');
            exit;
        } else {
            $error_message = "Une erreur est survenue lors de la réservation.";
        }
    }
}

if (isset($error_message)):
    echo "<div class='message error'>$error_message</div>";
endif;

if (isset($success_message)):
    echo "<div class='message success'>$success_message</div>";
endif;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Réserver <?php echo htmlspecialchars($activity['titre']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.png" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --primary-color: #3a791f;
            --secondary-color: #8ac571;
            --primary-color-red: #e53e3e;
            --secondary-color-red: #fc8181;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
            --error-color: #dc3545;
            --success-color: #28a745;
        }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: var(--light-bg);
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 10% 20%, rgba(252, 129, 129, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(255, 107, 107, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 50% 50%, rgba(229, 62, 62, 0.05) 0%, transparent 30%);
            pointer-events: none;
            z-index: -1;
        }

        .page-title {
            color: var(--primary-color-red);
            text-align: center;
            margin: 150px 0 30px;
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .reservation-container {
            max-width: 800px;
            margin: 0 auto 100px;
            padding: 20px;
        }

        .activity-summary {
            background: var(--white);
            border-radius: 30px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(58, 121, 31, 0.1);
        }

        .activity-title {
            font-size: 1.8rem;
            color: var(--text-color);
            margin-bottom: 30px;
            text-align: center;
        }

        .activity-meta {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin-bottom: 30px;
            justify-content: center;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .meta-item:hover {
            transform: translateY(-3px);
        }

        .meta-item i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .activity-price {
            font-size: 1.4rem;
            color: var(--primary-color-red);
            font-weight: 600;
            background: #fff3f3;
            padding: 10px 25px;
            border-radius: 15px;
        }

        .reservation-form {
            background: var(--white);
            border-radius: 30px;
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(58, 121, 31, 0.1);
        }

        .form-title {
            font-size: 1.8rem;
            color: var(--text-color);
            margin-bottom: 40px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: var(--text-color);
            font-weight: 500;
            font-size: 1.1rem;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 15px;
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(58, 121, 31, 0.1);
        }

        .form-control.error {
            border-color: var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .spots-selector {
            display: flex;
            gap: 15px;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
        }

        .spots-button {
            width: 50px;
            height: 50px;
            border: 2px solid var(--primary-color);
            background: var(--white);
            color: var(--primary-color);
            border-radius: 12px;
            font-size: 1.4rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spots-button:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
        }

        .spots-button:disabled {
            border-color: #ddd;
            color: #ddd;
            cursor: not-allowed;
            transform: none;
        }

        .spots-display {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-color);
            min-width: 50px;
            text-align: center;
            background: var(--white);
            padding: 10px 20px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .total-price {
            font-size: 1.4rem;
            color: var(--primary-color-red);
            font-weight: 600;
            margin-top: 30px;
            text-align: center;
            background: #fff3f3;
            padding: 15px;
            border-radius: 15px;
        }

        .submit-button {
            display: block;
            width: 100%;
            padding: 20px;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 40px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .submit-button:disabled {
            background: #ddd;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
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
            color: var(--primary-color-red);
            filter: drop-shadow(0 0 10px rgba(229, 62, 62, 0.3));
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: -5s;
            color: var(--secondary-color-red);
        }

        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 15%;
            animation-delay: -10s;
        }

        .floating-element:nth-child(4) {
            bottom: 20%;
            right: 20%;
            animation-delay: -15s;
            color: var(--secondary-color-red);
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

        .message {
            padding: 15px;
            border-radius: 12px;
            margin: 20px auto;
            text-align: center;
            width: 90%;
            max-width: 500px;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            animation: fadeOut 12s forwards;
            font-size: 1rem;
            z-index: 9999;
            box-shadow: var(--shadow-md);
        }

        .error {
            background-color: #fff3f3;
            color: var(--error-color);
            border: 1px solid #ffcdd2;
        }

        .success {
            background-color: #f0fff4;
            color: var(--success-color);
            border: 1px solid #c6f6d5;
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

        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
                margin: 120px 0 20px;
            }

            .reservation-container {
                padding: 15px;
            }

            .activity-summary,
            .reservation-form {
                padding: 25px;
            }

            .activity-title {
                font-size: 1.5rem;
            }

            .meta-item {
                padding: 8px 15px;
                font-size: 0.9rem;
            }

            .activity-price {
                font-size: 1.2rem;
                padding: 8px 20px;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .form-control {
                padding: 12px;
            }

            .spots-button {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }

            .spots-display {
                font-size: 1.2rem;
                padding: 8px 15px;
            }

            .submit-button {
                padding: 15px;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.8rem;
                margin: 100px 0 15px;
            }

            .activity-summary,
            .reservation-form {
                padding: 20px;
            }

            .activity-meta {
                gap: 15px;
            }

            .meta-item {
                width: 100%;
                justify-content: center;
            }

            .form-group label {
                font-size: 1rem;
            }

            .form-control {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <?php include '../../../includes/layout/navbar.php' ?>

    <div class="floating-elements">
        <i class="fas fa-calendar-check floating-element"></i>
        <i class="fas fa-ticket-alt floating-element"></i>
        <i class="fas fa-user-check floating-element"></i>
        <i class="fas fa-check-circle floating-element"></i>
    </div>

    <h1 class="page-title">
        <i class="fas fa-ticket-alt"></i>
        Réserver une activité
    </h1>

    <?php if ($success_message): ?>
        <div class="message success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="message error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="reservation-container">
        <div class="activity-summary">
            <h2 class="activity-title"><?php echo htmlspecialchars($activity['titre']); ?></h2>
            <div class="activity-meta">
                <div class="meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo htmlspecialchars($activity['adresse']); ?>
                </div>
            </div>
        </div>

        <form class="reservation-form" id="reservationForm" method="POST">
            <h3 class="form-title">Vos informations</h3>

            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($user['fullname'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nombre de places</label>
                <div class="spots-selector">
                    <button type="button" class="spots-button" id="decreaseSpots" disabled>-</button>
                    <span class="spots-display" id="spotsCount">1</span>
                    <button type="button" class="spots-button" id="increaseSpots">+</button>
                    <input type="hidden" name="spots" id="spotsInput" value="1">
                </div>
            </div>

            <button type="submit" class="submit-button">
                Confirmer la réservation
            </button>
        </form>
    </div>
    <?php include '../../../includes/layout/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reservationForm');
            const decreaseButton = document.getElementById('decreaseSpots');
            const increaseButton = document.getElementById('increaseSpots');
            const spotsCount = document.getElementById('spotsCount');
            let spots = 1;

            function updateSpots() {
                spotsCount.textContent = spots;
                document.getElementById('spotsInput').value = spots;
                decreaseButton.disabled = spots <= 1;
                increaseButton.disabled = spots >= 3;
            }

            decreaseButton.addEventListener('click', () => {
                if (spots > 1) {
                    spots--;
                    updateSpots();
                }
            });

            increaseButton.addEventListener('click', () => {
                if (spots < 3) {
                    spots++;
                    updateSpots();
                }
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                formData.append('spots', spots);

                fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url;
                        } else {
                            return response.text();
                        }
                    })
                    .then(html => {
                        if (html) {
                            document.documentElement.innerHTML = html;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
</body>

</html>