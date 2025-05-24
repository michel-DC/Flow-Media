<?php require_once '../includes/auth.php'; ?>

<?php
// Connexion à la base de données
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Récupérer tous les développeurs
$query = "SELECT * FROM activites";
$result = mysqli_query($link, $query);

// Traitement de la recherche
if (isset($_POST['search_activites'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM activites WHERE titre LIKE '%$search%' ";
    $result = mysqli_query($link, $query);
}

if (isset($_POST['see_activites'])) {
    $query = "SELECT * FROM activites";
    $result = mysqli_query($link, $query);
}
?>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
        .container {
            font-family: "Space Grotesk", sans-serif; 
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
        }

        .container h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 45px;
            color: #151717;
        }

        .container h1 span {
            color: #2ECC71;
            position: relative;
        }

        .container h1 span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #2ECC71;
            border-radius: 3px;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 60px;
        }

        form input[type="text"] {
            padding: 10px 15px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-family: "Space Grotesk", sans-serif;
            flex-grow: 1;
        }

        form button {
            padding: 10px 20px;
            background-color: #2ECC71;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Space Grotesk", sans-serif;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        form button:hover {
            background-color: #25a25a;
        }
        
        .developers-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .dev-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
            display: flex;
            flex-direction: column row-reverse;
            width: calc(33.33% - 14px); 
            height: 100%;
        }
        
        .dev-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .dev-content {
            padding: 20px 15px 15px;
            flex-grow: 1;
        }
        
        .dev-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: #111827;
        }
        
        .dev-description {
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 12px;
            line-height: 1.4;
        }
        
        .dev-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            position: absolute;
            top: 10px;
            right: 10px;
            border: 2px solid white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .dev-stack {
            font-size: 0.8rem;
            font-weight: bolder;
            color: #6b7280;
            margin-bottom: 10px;
        }
    </style>

<div class="container">
    <h1>Les activités <span>disponibles</span></h1>
    
    <form method="POST" action="dashboard.php#see-dev-section">
        <input type="text" name="search" placeholder="Rechercher une activité...">
        <button type="submit" name="search_activites">Rechercher</button>
        <button type="submit" name="see_activites">Voir toutes les activités</button>
    </form>

    <div class="developers-grid">
        <?php 
        if (mysqli_num_rows($result) > 0) {
            while($activite = mysqli_fetch_assoc($result)): ?>
                <div class="dev-card">
                    <img src="<?= $activite['image_url'] ?>" alt="<?= $activite['titre'] ?>">
                    <h1><?= $activite['titre'] ?></h1>
                    <textarea name="text" id="activity-description"><?= $activite['description'] ?></textarea>
                    <div><?= $activite['description'] ?></div>
                    <h3><?= $activite['ville'] ?></h3>
                    <h4><?= $activite['age_min'] ?></h4>
                    <h4><?= $activite['age_max'] ?></h4>
                    <h2><?= $activite['prix'] ?></h2>

                </div>
            <?php endwhile; 
        } else {
            echo "<p>Aucune activité trouvé pour votre recherche.</p>";
        }
        ?>
    </div>
</div>