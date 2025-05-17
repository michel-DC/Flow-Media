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
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
        
        :root {
            --soft-black: #1a1a1a;
            --white: #f9f9f9;
        }
        
        body {
            font-family: "Space Grotesk", sans-serif;
            margin: 0;
            padding: 0;
            color: var(--soft-black);
            background: var(--white);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        section {
            padding: 5rem 0;
        }
        
        h1, h2, h3 {
            font-weight: 600;
        }
        
        h1 {
            font-size: 3rem;
            margin-bottom: 2rem;
        }
        
        h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .contact-info {
            background: var(--white);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .contact-info-item i {
            font-size: 1.5rem;
            margin-right: 1rem;
            color: var(--soft-black);
        }
        
        .contact-form {
            background: var(--white);
            border-radius: 8px;
            padding: 2rem;
            padding-right: 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
        }
        
        .form-group textarea {
            min-height: 150px;
        }
        
        button[type="submit"] {
            background: var(--soft-black);
            color: var(--white);
            border: none;
            padding: 1rem 2rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        button[type="submit"]:hover {
            opacity: 0.8;
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <section class="container">
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
            <div class="image-placeholder" style="height: 400px; display: flex; align-items: center; justify-content: center;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.75769373476!2d2.2770205!3d48.8589503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis%2C%20France!5e0!3m2!1sen!2sus!4v1712345678901!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <?php include '../../includes/layout/footer.php'; ?>
</body>
</html>
