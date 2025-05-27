<?php
require_once '../../includes/auth.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$query = "SELECT * FROM activites WHERE id = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$activity = mysqli_fetch_assoc($result);

if (!$activity) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Réserver <?php echo htmlspecialchars($activity['titre']); ?></title>
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

        .page-title {
            color: var(--primary-color);
            text-align: center;
            margin: 150px 0 30px;
            font-size: 2.5rem;
        }

        .reservation-container {
            max-width: 800px;
            margin: 0 auto 100px;
            padding: 20px;
        }

        .activity-summary {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-sm);
        }

        .activity-title {
            font-size: 1.5rem;
            color: var(--text-color);
            margin-bottom: 20px;
        }

        .activity-meta {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
        }

        .meta-item i {
            color: var(--primary-color);
        }

        .activity-price {
            font-size: 1.2rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .reservation-form {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-sm);
        }

        .form-title {
            font-size: 1.5rem;
            color: var(--text-color);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
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
            gap: 10px;
            align-items: center;
        }

        .spots-button {
            width: 40px;
            height: 40px;
            border: 2px solid var(--primary-color);
            background: var(--white);
            color: var(--primary-color);
            border-radius: 8px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .spots-button:hover {
            background: var(--primary-color);
            color: var(--white);
        }

        .spots-button:disabled {
            border-color: #ddd;
            color: #ddd;
            cursor: not-allowed;
        }

        .spots-display {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-color);
            min-width: 40px;
            text-align: center;
        }

        .total-price {
            font-size: 1.2rem;
            color: var(--primary-color);
            font-weight: 600;
            margin-top: 20px;
            text-align: right;
        }

        .submit-button {
            display: block;
            width: 100%;
            padding: 15px;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 30px;
        }

        .submit-button:hover {
            background: var(--secondary-color);
        }

        .submit-button:disabled {
            background: #ddd;
            cursor: not-allowed;
        }

        .bottom-illustrations {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            pointer-events: none;
            z-index: 1;
        }

        .bottom-illustration {
            width: 300px;
            height: auto;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
                margin: 100px 0 20px;
            }

            .bottom-illustrations {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php' ?>

    <h1 class="page-title">Réserver une activité</h1>

    <div class="reservation-container">
        <div class="activity-summary">
            <h2 class="activity-title"><?php echo htmlspecialchars($activity['titre']); ?></h2>
            <div class="activity-meta">
                <div class="meta-item">
                    <i class="far fa-calendar"></i>
                    <?php echo date('d/m/Y', strtotime($activity['date_activite'])); ?>
                </div>
                <div class="meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo htmlspecialchars($activity['lieu']); ?>
                </div>
                <div class="meta-item">
                    <i class="fas fa-user"></i>
                    <?php echo $activity['age_min']; ?>-<?php echo $activity['age_max']; ?> ans
                </div>
                <div class="meta-item activity-price">
                    <i class="fas fa-euro-sign"></i>
                    <?php echo number_format($activity['prix'], 2); ?> par personne
                </div>
            </div>
        </div>

        <form class="reservation-form" id="reservationForm">
            <h3 class="form-title">Vos informations</h3>

            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
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
                </div>
            </div>

            <div class="total-price">
                Total: <span id="totalPrice"><?php echo number_format($activity['prix'], 2); ?></span> €
            </div>

            <button type="submit" class="submit-button">
                Confirmer la réservation
            </button>
        </form>
    </div>
    <?php include '../../includes/layout/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reservationForm');
            const decreaseButton = document.getElementById('decreaseSpots');
            const increaseButton = document.getElementById('increaseSpots');
            const spotsCount = document.getElementById('spotsCount');
            const totalPrice = document.getElementById('totalPrice');
            const pricePerPerson = <?php echo $activity['prix']; ?>;
            let spots = 1;

            function updateSpots() {
                spotsCount.textContent = spots;
                totalPrice.textContent = (spots * pricePerPerson).toFixed(2);
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
                formData.append('activity_id', <?php echo $activity['id']; ?>);
                formData.append('total_price', (spots * pricePerPerson).toFixed(2));

                // Here you would typically send the form data to your server
                // For now, we'll just show a success message
                alert('Réservation confirmée ! Nous vous contacterons bientôt pour finaliser les détails.');
                window.location.href = 'index.php';
            });
        });
    </script>
</body>

</html>