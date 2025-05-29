<?php
require_once '../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Media | Politique de Confidentialité</title>
    <link rel="shortcut icon" href="/assets/icons/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style/index.css">
    <style>
        .privacy-container {
            max-width: 1200px;
            margin: 150px auto 50px;
            padding: 40px;
            background: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow-md);
        }

        .privacy-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .privacy-title {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .privacy-subtitle {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .privacy-section {
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

        .section-content ul {
            list-style-type: none;
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .section-content li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 25px;
        }

        .section-content li:before {
            content: "•";
            color: var(--primary-color);
            font-size: 1.5rem;
            position: absolute;
            left: 0;
            top: -5px;
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
            .privacy-container {
                margin: 120px 20px 30px;
                padding: 20px;
            }

            .privacy-title {
                font-size: 2rem;
            }

            .privacy-subtitle {
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

    <div class="privacy-container">
        <div class="privacy-header">
            <h1 class="privacy-title">Politique de Confidentialité</h1>
            <p class="privacy-subtitle">Dernière mise à jour : <?php echo date('d/m/Y'); ?></p>
        </div>

        <div class="privacy-section">
            <h2 class="section-title">
                <i class="fas fa-shield-alt"></i>
                Protection de vos données
            </h2>
            <div class="section-content">
                <p>Flow Media s'engage en faveur de la protection de vos données personnelles et de votre vie privée. À ce titre, et en application du Règlement Général de Protection des Données (RGPD), nous vous communiquons ci-après les conditions dans lesquelles vos données personnelles sont appelées à être traitées par nos soins.</p>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title">
                <i class="fas fa-database"></i>
                Données personnelles traitées
            </h2>
            <div class="section-content">
                <h3>Finalités :</h3>
                <ul>
                    <li>Traiter et répondre à vos messages</li>
                    <li>Créer et gérer l'accès à vos comptes</li>
                    <li>Rédiger un avis/commentaire publié sur le site</li>
                    <li>Gérer le bon fonctionnement et la personnalisation des services</li>
                    <li>Mémoriser vos choix quant à l'utilisation des cookies</li>
                    <li>Répondre aux exigences réglementaires en vigueur</li>
                </ul>

                <h3>Catégories des données :</h3>
                <ul>
                    <li>Des coordonnées (nom, prénom, numéro de téléphone, email)</li>
                    <li>Des informations techniques et de localisations générées dans le cadre de l'utilisation de nos services</li>
                </ul>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title">
                <i class="fas fa-cookie-bite"></i>
                Politique de Cookies
            </h2>
            <div class="section-content">
                <p>Les cookies sont de petits fichiers texte qu'un site web enregistre sur votre ordinateur ou votre appareil mobile lorsque vous visitez le site. Ils facilitent votre expérience en ligne en sauvegardant les informations de navigation.</p>

                <h3>Types de cookies utilisés :</h3>
                <ul>
                    <li><strong>Cookies strictement nécessaires :</strong> Requis pour le fonctionnement du site</li>
                    <li><strong>Cookies de préférences :</strong> Mémorisent vos choix</li>
                    <li><strong>Cookies de statistiques :</strong> Aident à comprendre l'utilisation du site</li>
                    <li><strong>Cookies marketing :</strong> Permettent de diffuser des publicités pertinentes</li>
                </ul>

                <p>Quand vous arrivez pour la première fois sur le site, un bandeau cookie vous propose d'accepter ou de refuser les Cookies qui ne sont pas essentiels au fonctionnement du site. Vous pouvez refuser/désactiver les Cookies à tout moment, à l'exception des Cookies nécessaires au fonctionnement stable du site.</p>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title">
                <i class="fas fa-user-shield"></i>
                Vos droits
            </h2>
            <div class="section-content">
                <p>Conformément au RGPD, vous disposez des droits suivants :</p>
                <ul>
                    <li>Droit d'accès à vos données</li>
                    <li>Droit de rectification</li>
                    <li>Droit à l'effacement</li>
                    <li>Droit à la limitation du traitement</li>
                    <li>Droit à la portabilité des données</li>
                    <li>Droit d'opposition au traitement</li>
                    <li>Droit de retirer votre consentement</li>
                </ul>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title">
                <i class="fas fa-envelope"></i>
                Nous contacter
            </h2>
            <div class="section-content">
                <p>Pour exercer vos droits ou pour toute question concernant notre politique de confidentialité, vous pouvez nous contacter :</p>
                <div class="contact-info">
                    <p><strong>Flow Media</strong></p>
                    <p><i class="fas fa-envelope"></i> contact@flowmedia.fr</p>
                </div>
                <p>Si vous estimez que vos droits ne sont pas respectés, vous pouvez adresser une réclamation à la CNIL :</p>
                <div class="contact-info">
                    <p><strong>CNIL</strong></p>
                    <p>3 Place de Fontenoy</p>
                    <p>TSA 80715</p>
                    <p>75334 Paris Cedex 07</p>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/layout/footer.php'; ?>
</body>

</html>