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
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: var(--light-bg);
            position: relative;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 80px;
            position: relative;
        }

        .contact-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../../assets/images/flowmedia-icon.svg');
            background-size: 73%;
            background-position: center;
            padding: 140px 0 80px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            opacity: 0.3;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 0.1;
            }

            50% {
                opacity: 0.2;
            }

            100% {
                opacity: 0.1;
            }
        }

        .contact-hero-content {
            text-align: center;
            color: var(--white);
            position: relative;
            z-index: 1;
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: -1px;
            animation: fadeInUp 1s ease forwards;
        }

        .contact-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 1s ease forwards 0.2s;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 60px;
            animation: fadeInUp 1s ease forwards 0.4s;
        }

        .contact-info {
            background: var(--white);
            border-radius: 24px;
            padding: 40px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .contact-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color-red), var(--secondary-color-red));
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .contact-info-item:hover {
            transform: translateX(10px);
        }

        .contact-info-item i {
            font-size: 1.5rem;
            margin-right: 20px;
            color: var(--primary-color);
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(58, 121, 31, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .contact-info-item:hover i {
            background: var(--primary-color);
            color: var(--white);
        }

        .contact-form {
            background: var(--white);
            border-radius: 24px;
            padding: 40px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .contact-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 15px;
            border: 2px solid #eee;
            border-radius: 12px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--secondary-color-red);
            outline: none;
            box-shadow: 0 0 0 4px rgba(58, 121, 31, 0.1);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        button[type="submit"] {
            background: var(--primary-color-red);
            color: var(--white);
            border: none;
            padding: 15px 30px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        button[type="submit"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        button[type="submit"]:hover::before {
            left: 100%;
        }

        button[type="submit"]:hover {
            background: var(--secondary-color-red);
            transform: translateY(-2px);
        }

        .map-section {
            margin-top: 80px;
            position: relative;
        }

        .map-container {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            position: relative;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s infinite linear;
        }

        .shape-1 {
            top: 10%;
            left: 5%;
            width: 100px;
            height: 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="%233a791f"/></svg>') no-repeat;
            animation-delay: 0s;
        }

        .shape-2 {
            top: 20%;
            right: 10%;
            width: 80px;
            height: 80px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect x="20" y="20" width="60" height="60" fill="%238ac571"/></svg>') no-repeat;
            animation-delay: -5s;
        }

        .shape-3 {
            bottom: 15%;
            left: 15%;
            width: 60px;
            height: 60px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><polygon points="50,20 80,80 20,80" fill="%233a791f"/></svg>') no-repeat;
            animation-delay: -10s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            50% {
                transform: translate(20px, 20px) rotate(180deg);
            }

            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 40px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            h1 {
                font-size: 2.5rem;
            }

            .contact-hero {
                padding: 80px 0 60px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 25px;
            }

            h1 {
                font-size: 2rem;
            }

            .contact-info,
            .contact-form {
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <section class="contact-hero">
        <div class="container">
            <div class="contact-hero-content">
                <h1>Contactez-nous</h1>
                <p class="contact-subtitle">Nous sommes là pour vous aider et répondre à toutes vos questions. N'hésitez pas à nous contacter !</p>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="contact-grid">
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
                <form action="" method="POST">
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

    <section class="container map-section" style="margin-bottom: 20px;">
        <h2>Nous trouver</h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.75769373476!2d2.2770205!3d48.8589503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis%2C%20France!5e0!3m2!1sen!2sus!4v1712345678901!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <?php include '../../includes/layout/footer.php' ?>
</body>

</html>