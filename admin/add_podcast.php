<?php require_once '../includes/auth.php'; ?>

<?php

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

if (isset($_POST['ajt_podcast'])) {
    // Escape all input data
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

    // Process image file
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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    :root {
        --primary-color: #2ECC71;
        --secondary-color: #25a25a;
        --text-color: #333;
        --light-bg: #f0f0f0;
        --white: #ffffff;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .add-podcast-component .add-podcast-container {
        flex: 1;
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
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
        color: var(--primary-color);
        position: relative;
    }

    .add-podcast-component .add-podcast-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }

    .add-podcast-component .add-podcast-form-container {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        padding: 30px 40px;
        width: 100%;
        max-width: 900px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px 30px;
    }

    .add-podcast-component .add-podcast-form-group {
        margin-bottom: 0;
    }

    .add-podcast-component label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-color);
        font-weight: 500;
        font-size: 13px;
    }

    .add-podcast-component input[type="text"],
    .add-podcast-component textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        background-color: white;
        font-size: 0.9rem;
        color: #4b5563;
        font-family: "Poppins", sans-serif;
        transition: all 0.2s ease;
    }

    .add-podcast-component input[type="text"]:focus,
    .add-podcast-component textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.1);
    }

    .add-podcast-component textarea {
        min-height: 100px;
        resize: vertical;
        grid-column: span 2 / auto;
    }

    .add-podcast-component .add-podcast-form-group input[type="file"] {
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        background-color: white;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .add-podcast-component .add-podcast-form-group input[type="file"]:hover {
        border-color: var(--primary-color);
        background-color: rgba(46, 204, 113, 0.05);
    }

    .add-podcast-component .btn {
        background-color: var(--primary-color);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.2s ease;
        width: auto;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        grid-column: span 2 / auto;
        margin-top: 15px;
        justify-self: end;
    }

    .add-podcast-component .btn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    .add-podcast-component .btn:active {
        transform: translateY(0);
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
        box-shadow: var(--shadow-sm);
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
            padding: 15px;
            margin: 10px auto;
        }

        .add-podcast-component .add-podcast-form-container {
            padding: 20px;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .add-podcast-component .add-podcast-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .add-podcast-component textarea {
            grid-column: auto;
        }

        .add-podcast-component .btn {
            grid-column: auto;
            width: 100%;
            justify-self: stretch;
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

            <form method="POST" enctype="multipart/form-data" action="dashboard.php#add-podcast-section">
                <div class="add-podcast-form-group">
                    <label for="titre">Titre du podcast</label>
                    <input type="text" id="titre" name="titre" placeholder="Entrez le titre du podcast" required>
                </div>

                <div class="add-podcast-form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Décrivez le podcast en détail" required></textarea>
                </div>

                <div class="add-podcast-form-group">
                    <label for="image">Image du podcast</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <div class="add-podcast-form-group">
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