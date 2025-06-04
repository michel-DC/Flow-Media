<?php
require_once '../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Mentions Légales</title>
    <link rel="shortcut icon" href="/assets/icons/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style/index.css">
    <style>
        .legal-container {
            max-width: 1200px;
            margin: 150px auto 50px;
            padding: 40px;
            background: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow-md);
        }

        .legal-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .legal-title {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .legal-subtitle {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .legal-section {
            margin-bottom: 40px;
        }

        .section-title {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-content {
            color: #444;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .section-content p {
            margin-bottom: 15px;
        }

        .contact-info {
            background: var(--light-bg);
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .contact-info strong {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .legal-container {
                margin: 120px 20px 30px;
                padding: 20px;
            }

            .legal-title {
                font-size: 2rem;
            }

            .legal-subtitle {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .section-content {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <?php include '../includes/layout/navbar.php'; ?>

    <div class="legal-container">
        <div class="legal-header">
            <h1 class="legal-title">Mentions Légales</h1>
            <p class="legal-subtitle">Conformément à la loi n° 2004-575 du 21 juin 2004 pour la confiance en l'économie numérique</p>
        </div>

        <div class="legal-section">
            <h2 class="section-title">
                <i class="fas fa-edit"></i>
                Édition du site
            </h2>
            <div class="section-content">
                <p>Le présent site, accessible à l'URL <strong>https://flowmedia.michel.djoumessi.mmi-velizy.fr</strong>, est édité par :</p>
                <div class="contact-info">
                    <p><strong>Michel Christ DJOUMESSI</strong></p>
                    <p>2 rue de la culture</p>
                    <p>75010 PARIS</p>
                    <p>France</p>
                </div>
            </div>
        </div>

        <div class="legal-section">
            <h2 class="section-title">
                <i class="fas fa-server"></i>
                Hébergement
            </h2>
            <div class="section-content">
                <p>Le Site est hébergé par :</p>
                <div class="contact-info">
                    <p><strong>O2Switch</strong></p>
                    <p>222 Boulevard Gustave Flaubert</p>
                    <p>63000 Clermont-Ferrand</p>
                    <p>Contact : (+33) 4 44 44 60 40</p>
                </div>
            </div>
        </div>

        <div class="legal-section">
            <h2 class="section-title">
                <i class="fas fa-user-tie"></i>
                Directeur de publication
            </h2>
            <div class="section-content">
                <p>Le Directeur de la publication du Site est <strong>Michel Christ DJOUMESSI</strong>.</p>
            </div>
        </div>

        <div class="legal-section">
            <h2 class="section-title">
                <i class="fas fa-envelope"></i>
                Nous contacter
            </h2>
            <div class="section-content">
                <div class="contact-info">
                    <p><i class="fas fa-phone"></i> +33 6 01 02 03 04</p>
                    <p><i class="fas fa-envelope"></i> flowmedia@contact.fr</p>
                    <p><i class="fas fa-map-marker-alt"></i> 2 rue de la culture, 75010 PARIS</p>
                </div>
            </div>
        </div>

        <div class="legal-section">
            <h2 class="section-title">
                <i class="fas fa-shield-alt"></i>
                Données personnelles
            </h2>
            <div class="section-content">
                <p>Le traitement de vos données à caractère personnel est régi par notre Politique de confidentialité, disponible dans la section correspondante, conformément au Règlement Général sur la Protection des Données 2016/679 du 27 avril 2016 («RGPD»).</p>
            </div>
        </div>
    </div>

    <?php include '../includes/layout/footer.php'; ?>
</body>

</html>