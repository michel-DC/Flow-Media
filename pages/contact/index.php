<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Flow Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../../assets/icons/icon-test.svg" type="image/svg+xml">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 200px;
            padding: 0 80px;
        }

        section {
            padding: 80px 0;
        }

        h1 {
            text-align: center;
            color: #3a791f;
            font-size: 2.7rem;
            font-weight: 800;
            margin-bottom: 36px;
            letter-spacing: -1px;
        }

        h2 {
            font-size: 1.9rem;
            color: #333;
            margin-bottom: 40px;
        }

        .grid {
            display: flex;
            gap: 50px;
        }

        .contact-info,
        .contact-form {
            background: #fff;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
            flex: 1;
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .contact-info-item i {
            font-size: 1.5rem;
            margin-right: 20px;
            color: #4e8c2b;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: inherit;
        }

        .form-group textarea {
            min-height: 150px;
        }

        button[type="submit"] {
            background: #3a791f;
            color: #fff;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }

        button[type="submit"]:hover {
            background: #4e8c2b;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 40px;
            }

            .grid {
                flex-direction: column;
                gap: 30px;
            }

            h1 {
                font-size: 2.5rem;
            }

            h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 25px;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <section class="container">
        <?php include '../../animations/buisson-rose/index.php'; ?>
        <h1>Contactez-nous</h1>
        <div class="grid">
            <div class="contact-info">
                <h2>Nos coordonnées</h2>

                <div class="contact-info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h3>Adresse</h3>
                        <p>123 Rue de la Culture<br>75000 Paris, France</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <h3>Téléphone</h3>
                        <p>+33 1 23 45 67 89</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h3>Email</h3>
                        <p>contact@flowmedia.fr</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <h3>Horaires d'ouverture</h3>
                        <p>Lundi - Vendredi: 9h - 18h<br>Samedi: 10h - 15h</p>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h2>Envoyez-nous un message</h2>
                <form action="/contact-form-handler.php" method="POST">
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Sujet</label>
                        <select id="subject" name="subject" required>
                            <option value="">Sélectionnez un sujet</option>
                            <option value="question">Question générale</option>
                            <option value="partnership">Partenariat</option>
                            <option value="feedback">Retour d'expérience</option>
                            <option value="technical">Problème technique</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>

                    <button type="submit">Envoyer le message</button>
                </form>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Nous trouver</h2>
        <div class="contact-info">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.75769373476!2d2.2770205!3d48.8589503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis%2C%20France!5e0!3m2!1sen!2sus!4v1712345678901!5m2!1sen!2sus" width="100%" height="400" style="border:0; border-radius: 16px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

</body>

</html>