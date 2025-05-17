<?php
require_once '../../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page introuvable | Flow Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="/assets/icons/icon-test.svg" type="image/svg+xml">
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        h1 {
            font-size: 5rem;
            margin-bottom: 1rem;
            color: #e74c3c;
        }
        
        h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
        }
        
        .btn-home {
            display: inline-block;
            padding: 12px 24px;
            background-color: var(--soft-black);
            color: var(--white);
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: background-color 0.3s;
            margin-top: 2rem;
        }
        
        .btn-home:hover {
            background-color: #333;
        }
        
        .error-icon {
            font-size: 8rem;
            color: #e74c3c;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <?php include '../../includes/layout/navbar.php'; ?>

    <div class="container">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1>404</h1>
        <h2>Oups ! La page que vous cherchez n'existe pas.</h2>
        <p>Il semble que la page que vous essayez d'atteindre a été déplacée, supprimée ou n'existe pas.</p>
        <a href="/index.php" class="btn-home">Retour à l'accueil</a>
    </div>

    <?php include '../../includes/layout/footer.php'; ?>
</body>
</html>

<?php
// Set the 404 status code
http_response_code(404);
?>