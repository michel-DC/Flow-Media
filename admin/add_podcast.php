<?php require_once '../includes/auth.php'; ?>

<?php

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (isset($_POST['ajt_podcast'])) {
    $titre = mysqli_real_escape_string($link, $_POST['titre']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $youtube_url = mysqli_real_escape_string($link, $_POST['youtube_url']);

    $image_url = null;
    $upload_dir = '../assets/uploads/podcasts/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    function processFile($file, $upload_dir, $allowed_types)
    {
        if (isset($file) && $file['error'] === 0) {
            $filename = basename($file['name']);
            $filename = preg_replace("/[^a-zA-Z0-9.-]/", "_", $filename);
            $destination = $upload_dir . uniqid() . '_' . $filename;
            $file_type = mime_content_type($file['tmp_name']);

            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return $destination;
                }
            }
        }
        return false;
    }

    $image_url = processFile($_FILES['image'], $upload_dir, ['image/jpeg', 'image/png', 'image/gif']);
    if ($image_url === false) {
        $error = "Erreur avec l'image. Seuls les JPG, PNG et GIF sont acceptés.";
    } else {
        $image_url = mysqli_real_escape_string($link, $image_url);
    }

    if (!isset($error)) {
        $query = "INSERT INTO podcasts (
                    titre, description, youtube_url, image_url
                  ) VALUES (
                    '$titre',
                    '$description',
                    '$youtube_url',
                    " . ($image_url !== null ? "'$image_url'" : "NULL") . "
                  )";

        if (mysqli_query($link, $query)) {
            $success = "Podcast ajouté avec succès !";
            $_POST = array();
        } else {
            $error = "Erreur lors de l'insertion en base de données: " . mysqli_error($link);
        }
    }
}
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f5f5;
        padding: 80px 0;
    }

    .add-podcast-component .add-podcast-container {
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .add-podcast-component .add-podcast-container h1 {
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
        color: #151717;
        position: relative;
        padding-bottom: 10px;
    }

    .add-podcast-component .add-podcast-container h1 span {
        color: #FF3131;
        position: relative;
    }

    .add-podcast-component .add-podcast-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #FF3131;
        border-radius: 3px;
    }

    .add-podcast-component .add-podcast-form-container {
        background-color: #ffffff;
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .add-podcast-component .form-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .add-podcast-component .form-group {
        display: flex;
        flex-direction: column;
    }

    .add-podcast-component label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
        font-size: 13px;
    }

    .add-podcast-component input[type="text"],
    .add-podcast-component textarea {
        padding: 18px 20px;
        border: none;
        border-radius: 15px;
        background-color: #F0F0F0;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        color: #000000;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .add-podcast-component input[type="text"]:focus,
    .add-podcast-component textarea:focus {
        outline: none;
        background-color: #E8E8E8;
    }

    .add-podcast-component textarea {
        min-height: 100px;
        resize: vertical;
    }

    .add-podcast-component input[type="file"] {
        padding: 18px 20px;
        border: none;
        border-radius: 15px;
        background-color: #F0F0F0;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        color: #000000;
        transition: background-color 0.3s ease;
        width: 100%;
        cursor: pointer;
    }

    .add-podcast-component input[type="file"]:hover {
        background-color: #E8E8E8;
    }

    .add-podcast-component .btn {
        background-color: #FF3131;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 18px 40px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        margin-top: 20px;
        width: 100%;
    }

    .add-podcast-component .btn:hover {
        background-color: #e02828;
        transform: translateY(-2px);
    }

    .message {
        padding: 12px;
        border-radius: 4px;
        margin: 10px auto;
        text-align: center;
        width: 90%;
        max-width: 400px;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        animation: fadeOut 5s forwards;
        font-size: 14px;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .error {
        background-color: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .success {
        background-color: #f0fdf4;
        color: #166534;
        border: 1px solid #dcfce7;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        90% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            display: none;
        }
    }

    @media (max-width: 768px) {
        .add-podcast-component .add-podcast-container {
            padding: 0 20px;
        }

        .add-podcast-component .add-podcast-form-container {
            padding: 30px;
            border-radius: 20px;
        }

        .add-podcast-component .add-podcast-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .add-podcast-component input[type="text"],
        .add-podcast-component textarea,
        .add-podcast-component input[type="file"] {
            padding: 15px 18px;
            font-size: 14px;
        }

        .add-podcast-component .btn {
            padding: 15px 30px;
            font-size: 14px;
        }
    }
</style>

<div class="add-podcast-component">
    <div class="add-podcast-container">
        <h1>Ajouter un <span>podcast</span></h1>
        <div class="add-podcast-form-container">
            <?php if (isset($success)): ?>
                <div class="message success"><?= $success ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="message error"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" action="dashboard.php#add-podcast-section" class="form-section">
                <div class="form-group">
                    <label for="titre">Titre du podcast</label>
                    <input type="text" id="titre" name="titre" placeholder="Entrez le titre du podcast" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Décrivez le podcast en détail" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image du podcast</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="youtube_url">Lien YouTube</label>
                    <input type="text" id="youtube_url" name="youtube_url" placeholder="Entrez le lien YouTube du podcast" required>
                </div>

                <button type="submit" name="ajt_podcast" class="btn">
                    Ajouter le podcast
                </button>
            </form>
        </div>
    </div>
</div>