<?php
require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");
if (mysqli_connect_errno()) {
    die("Échec de la connexion à MySQL: " . mysqli_connect_error());
}

// Requête principale
$query = "SELECT * FROM fun_fact ORDER BY id DESC";
$result = mysqli_query($link, $query);

// Ajout du débogage
if (!$result) {
    die("Erreur de requête : " . mysqli_error($link));
}

// // Stocker le nombre de résultats pour le débogage
// $num_rows = mysqli_num_rows($result);
// echo "Nombre de fun facts trouvés : " . $num_rows;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Fun facts</title>
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
        }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: var(--light-bg);
            min-height: 100vh;
        }

        .fun-facts-container {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px;
        }

        .fun-fact-card {
            min-height: 400px;
            background: var(--white);
            border-radius: 24px;
            margin-bottom: 40px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            position: relative;
            transition: transform 0.3s ease;
        }

        .fun-fact-card:hover {
            transform: translateY(-5px);
        }

        .fun-fact-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            position: relative;
            display: block;
        }

        .fun-fact-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: var(--white);
            z-index: 2;
        }

        .fun-fact-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .fun-fact-details {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .fun-fact-detail {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .fun-fact-detail i {
            color: var(--secondary-color);
        }

        .fun-fact-story {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-top: 15px;
        }

        .scroll-indicator {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--primary-color);
            font-size: 2rem;
            animation: bounce 2s infinite;
            cursor: pointer;
            z-index: 100;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }

        @media (max-width: 768px) {
            .fun-facts-container {
                margin: 60px auto;
                padding: 15px;
            }

            .fun-fact-image {
                height: 300px;
            }

            .fun-fact-title {
                font-size: 1.5rem;
            }

            .fun-fact-details {
                flex-direction: column;
                gap: 10px;
            }
        }

        /* Ajout de styles de débogage */
        .debug-info {
            background: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <div class="fun-facts-container">
        <?php
        mysqli_data_seek($result, 0);
        while ($row = mysqli_fetch_assoc($result)):
            // Afficher les données brutes pour le débogage
            echo '<div class="debug-info">';
            echo '<pre>';
            print_r($row);
            echo '</pre>';
            echo '</div>';
        ?>
            <div class="fun-fact-card">
                <?php if (isset($row['image_url']) && !empty($row['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>"
                        alt="<?php echo htmlspecialchars($row['nom']); ?>"
                        class="fun-fact-image"
                        onerror="this.src='../../assets/images/placeholder.jpg'">
                <?php endif; ?>
                <div class="fun-fact-content">
                    <h2 class="fun-fact-title"><?php echo htmlspecialchars($row['nom']); ?></h2>
                    <div class="fun-fact-details">
                        <div class="fun-fact-detail">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo htmlspecialchars($row['adresse']); ?></span>
                        </div>
                        <div class="fun-fact-detail">
                            <i class="fas fa-user"></i>
                            <span><?php echo htmlspecialchars($row['createur']); ?></span>
                        </div>
                        <div class="fun-fact-detail">
                            <i class="fas fa-palette"></i>
                            <span><?php echo htmlspecialchars($row['style']); ?></span>
                        </div>
                    </div>
                    <p class="fun-fact-story"><?php echo htmlspecialchars($row['histoire']); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="scroll-indicator">
        <i class="fas fa-chevron-down"></i>
    </div>

    <?php include '../../includes/layout/footer.php'; ?>

    <script>
        document.querySelector('.scroll-indicator').addEventListener('click', () => {
            window.scrollBy({
                top: window.innerHeight,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>