<?php
require_once '../../includes/auth.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['connecté']) || $_SESSION['connecté'] !== true) {
    header('Location: ../../connexion/login.php?erreur=non_connecte');
    exit();
}

// Vérifier si l'ID de l'utilisateur est fourni et correspond à l'utilisateur connecté
if (!isset($_GET['user_id']) || $_GET['user_id'] != $_SESSION['user_id']) {
    header('Location: ../user/profile.php?erreur=acces_non_autorise');
    exit();
}

$user_id = $_GET['user_id'];

// Connexion à la base de données
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Récupérer l'abonnement actuel de l'utilisateur
$current_sub_query = "SELECT abonnement_id FROM users WHERE id = '$user_id'";
$current_sub_result = mysqli_query($link, $current_sub_query);
$current_sub = mysqli_fetch_assoc($current_sub_result);

// Récupérer les abonnements disponibles (id 2 et 3)
$query = "SELECT * FROM abonnements WHERE id IN (1, 2, 3)";
$result = mysqli_query($link, $query);
$abonnements = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Traitement du changement d'abonnement
if (isset($_POST['changer_abonnement'])) {
    $nouvel_abonnement_id = $_POST['abonnement_id'];

    // Vérifier que l'utilisateur modifie bien son propre abonnement
    if ($_POST['user_id'] != $user_id) {
        $error = "Action non autorisée.";
    } else {
        // Vérifier si l'utilisateur essaie de choisir son abonnement actuel
        if ($nouvel_abonnement_id == $current_sub['abonnement_id']) {
            $error = "Vous possédez déjà cet abonnement.";
        } else {
            // Mettre à jour l'abonnement de l'utilisateur
            $update_query = "UPDATE users SET abonnement_id = $nouvel_abonnement_id WHERE id = $user_id";
            if (mysqli_query($link, $update_query)) {
                $success = "Votre abonnement a été mis à jour avec succès !";
                // Rediriger vers le profil après 2 secondes
                header("refresh:2;url=../user/profile.php");
            } else {
                $error = "Une erreur est survenue lors de la mise à jour de votre abonnement.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnements | Flow Media</title>
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
        }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: var(--light-bg);
            color: var(--text-color);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 150px auto 100px;
            padding: 2rem;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--primary-color-red);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .abonnements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .abonnement-card {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(229, 62, 62, 0.1);
            position: relative;
            overflow: hidden;
        }

        .abonnement-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .abonnement-card h2 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--primary-color-red);
        }

        .prix {
            font-size: 2rem;
            font-weight: bold;
            margin: 1rem 0;
            color: var(--primary-color);
        }

        .avantages {
            list-style-type: none;
            padding: 0;
            margin: 1.5rem 0;
        }

        .avantages li {
            margin-bottom: 0.8rem;
            padding-left: 1.5rem;
            position: relative;
            color: var(--text-color);
        }

        .avantages li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--primary-color-red);
            font-weight: bold;
        }

        .btn-abonnement {
            display: block;
            width: 100%;
            padding: 12px;
            background: var(--primary-color-red);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: 500;
        }

        .btn-abonnement:hover {
            background: var(--secondary-color-red);
        }

        .message {
            padding: 15px;
            border-radius: 8px;
            margin: 1rem auto;
            text-align: center;
            max-width: 600px;
            font-weight: 500;
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

        @media (max-width: 768px) {
            .container {
                margin: 120px auto 50px;
                padding: 1rem;
            }

            .abonnements-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <div class="container">
        <h1>
            <i class="fas fa-crown"></i>
            Choisissez votre abonnement
        </h1>

        <?php if (isset($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>

        <div class="abonnements-grid">
            <?php foreach ($abonnements as $abonnement): ?>
                <div class="abonnement-card">
                    <h2><?php echo htmlspecialchars($abonnement['nom']); ?></h2>
                    <div class="prix"><?php echo htmlspecialchars($abonnement['prix']); ?> €/mois</div>
                    <ul class="avantages">
                        <?php if ($abonnement['id'] == 1): ?>
                            <li>Accès aux contenus de base</li>
                            <li>1 activité réservable par mois</li>
                        <?php endif; ?>
                        <?php if ($abonnement['id'] == 2): ?>
                            <li>Accès à tous les contenus premium</li>
                            <li>5 activités réservables par mois</li>
                            <li>Podcasts exclusifs</li>
                            <li>Codes promo mensuels</li>
                        <?php endif; ?>
                        <?php if ($abonnement['id'] == 3): ?>
                            <li>Accès à tous les contenus premium</li>
                            <li>Nombre illimité d'activités réservables par mois</li>
                            <li>Podcasts exclusifs</li>
                            <li>Codes promo mensuels</li>
                            <li>Accès prioritaire aux événements</li>
                            <li>Invitations VIP</li>
                        <?php endif; ?>

                    </ul>
                    <form method="POST">
                        <input type="hidden" name="abonnement_id" value="<?php echo $abonnement['id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <button type="submit" name="changer_abonnement" class="btn-abonnement">
                            Choisir cet abonnement
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include '../../includes/layout/footer.php'; ?>
</body>

</html>