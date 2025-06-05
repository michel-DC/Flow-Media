<?php require_once '../includes/auth.php'; ?>

<?php

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");


if (isset($_POST['ajt_fun_fact'])) {
    $nom = mysqli_real_escape_string($link, $_POST['nom']);
    $adresse = mysqli_real_escape_string($link, $_POST['adresse']);
    $createur = mysqli_real_escape_string($link, $_POST['createur']);
    $style = mysqli_real_escape_string($link, $_POST['style']);
    $histoire = mysqli_real_escape_string($link, $_POST['histoire']);

    $image_url = null;
    $upload_dir = '../assets/uploads/fun_facts/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    function processImage($file, $upload_dir)
    {
        if (isset($file) && $file['error'] === 0) {
            $filename = basename($file['name']);
            $filename = preg_replace("/[^a-zA-Z0-9.-]/", "_", $filename);
            $destination = $upload_dir . uniqid() . '_' . $filename;
            $file_type = mime_content_type($file['tmp_name']);
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return $destination;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        return false;
    }

    $image_url = processImage($_FILES['image'], $upload_dir);
    if ($image_url === false) {
        $error = "Erreur avec l'image. Seuls les JPG, PNG et GIF sont acceptés.";
    } else {
        $image_url = mysqli_real_escape_string($link, $image_url);
    }

    if (!isset($error)) {
        $query = "INSERT INTO fun_fact (nom, adresse, createur, image_url, style, histoire) VALUES (
            '$nom',
            '$adresse',
            '$createur',
            " . ($image_url !== null ? "'$image_url'" : "NULL") . ",
            '$style',
            '$histoire'
        )";

        if (mysqli_query($link, $query)) {
            $success = "Fun fact ajouté avec succès !";
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

    .add-fun-fact-component .add-fun-fact-container {
        flex: 1;
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .add-fun-fact-component .add-fun-fact-container h1 {
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
        color: #151717;
        position: relative;
        padding-bottom: 10px;
    }

    .add-fun-fact-component .add-fun-fact-container h1 span {
        color: var(--primary-color);
        position: relative;
    }

    .add-fun-fact-component .add-fun-fact-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }

    .add-fun-fact-component .add-fun-fact-container h1 span::before {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .add-fun-fact-component .add-fun-fact-container h1:hover span::before {
        transform: scaleX(1);
    }

    .add-fun-fact-component .add-fun-fact-form-container {
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

    .add-fun-fact-component label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-color);
        font-weight: 500;
        font-size: 13px;
    }

    .add-fun-fact-component input[type="text"],
    .add-fun-fact-component textarea,
    .add-fun-fact-component input[type="file"] {
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

    .add-fun-fact-component textarea {
        min-height: 100px;
        resize: vertical;
        grid-column: span 2 / auto;
    }

    .add-fun-fact-component .btn {
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

    .add-fun-fact-component .btn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
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
        .add-fun-fact-component .add-fun-fact-container {
            padding: 15px;
            margin: 10px auto;
        }

        .add-fun-fact-component .add-fun-fact-form-container {
            padding: 20px;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .add-fun-fact-component .add-fun-fact-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .add-fun-fact-component textarea {
            grid-column: auto;
        }

        .add-fun-fact-component .btn {
            grid-column: auto;
            width: 100%;
            justify_self: stretch;
        }
    }
</style>

<div class="add-fun-fact-component">
    <div class="add-fun-fact-container">
        <h1>Ajouter un <span>fun fact</span></h1>
        <div class="add-fun-fact-form-container">
            <?php if (isset($success)): ?>
                <div class="message success"><?= $success ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="message error"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="dashboard.php#add-fun-fact-section" enctype="multipart/form-data">
                <div class="add-fun-fact-form-group">
                    <label for="nom">Nom du lieu</label>
                    <input type="text" id="nom" name="nom" placeholder="Entrez le nom du lieu" required>
                </div>

                <div class="add-fun-fact-form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" name="adresse" placeholder="Entrez l'adresse" required>
                </div>

                <div class="add-fun-fact-form-group">
                    <label for="createur">Créateur</label>
                    <input type="text" id="createur" name="createur" placeholder="Entrez le nom du créateur" required>
                </div>

                <div class="add-fun-fact-form-group">
                    <label for="style">Style</label>
                    <input type="text" id="style" name="style" placeholder="Entrez le style" required>
                </div>

                <div class="add-fun-fact-form-group">
                    <label for="histoire">Histoire</label>
                    <textarea id="histoire" name="histoire" placeholder="Racontez l'histoire du lieu" required></textarea>
                </div>

                <div class="add-fun-fact-form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <button type="submit" name="ajt_fun_fact" class="btn">
                    Ajouter le fun fact
                </button>
            </form>
        </div>
    </div>
</div>