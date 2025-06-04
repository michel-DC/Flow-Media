<?php

require_once '../../includes/auth.php';

$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

$interests_query = "SELECT i.id, i.nom FROM interets i
                   JOIN user_interet ui ON i.id = ui.interet_id
                   WHERE ui.user_id = '$user_id'";
$interests_result = mysqli_query($link, $interests_query);
$user_interests = [];
while ($row = mysqli_fetch_assoc($interests_result)) {
    $user_interests[$row['id']] = $row['nom'];
}

$all_interests_query = "SELECT id, nom FROM interets";
$all_interests_result = mysqli_query($link, $all_interests_query);
$all_interests = [];
while ($row = mysqli_fetch_assoc($all_interests_result)) {
    $all_interests[$row['id']] = $row['nom'];
}

if (isset($_POST['update_interests'])) {
    $delete_query = "DELETE FROM user_interet WHERE user_id = '$user_id'";
    mysqli_query($link, $delete_query);

    if (isset($_POST['interests']) && !empty($_POST['interests'])) {
        $selected_interests = $_POST['interests'];

        foreach ($selected_interests as $interest_id) {
            $interest_id = mysqli_real_escape_string($link, $interest_id);
            $insert_query = "INSERT INTO user_interet (user_id, interet_id) VALUES ('$user_id', '$interest_id')";
            mysqli_query($link, $insert_query);
        }
    }

    $success = "Centres d'intérêt mis à jour avec succès!";
    $interests_result = mysqli_query($link, $interests_query);
    $user_interests = [];
    while ($row = mysqli_fetch_assoc($interests_result)) {
        $user_interests[$row['id']] = $row['nom'];
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centres d'intérêt | Flow Media</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
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

        .profile-section {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .profile-container {
            background-color: #ffffff;
            border-radius: 30px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .interests-section {
            margin-bottom: 40px;
        }

        .interests-title {
            font-size: 24px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 20px;
            text-align: center;
        }

        .interests-description {
            font-size: 16px;
            color: #666666;
            margin-bottom: 30px;
            text-align: center;
        }

        .selection-counter {
            text-align: center;
            font-size: 14px;
            color: #666666;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .selection-counter span {
            color: #FF3131;
            font-weight: 600;
        }

        .interests-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .interest-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            background: #F0F0F0;
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .interest-item:hover {
            background: #E8E8E8;
            transform: translateY(-2px);
        }

        .interest-item.selected {
            background: #FF3131;
            color: white;
            box-shadow: 0 4px 15px rgba(255, 49, 49, 0.3);
        }

        .interest-item.selected::after {
            content: '✓';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            font-weight: bold;
        }

        .interest-item input {
            display: none;
        }

        .interest-item label {
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            width: 100%;
            text-align: center;
        }

        .submit-section {
            margin-top: 30px;
            text-align: center;
        }

        .submit-button {
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
        }

        .submit-button:hover {
            background-color: #e02828;
            transform: translateY(-2px);
        }

        .message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
        }

        .success {
            background-color: #F0F9FF;
            color: #0284C7;
            border: 1px solid #7DD3FC;
        }

        .error {
            background-color: #FEF2F2;
            color: #EF4444;
            border: 1px solid #FCA5A5;
        }

        @media (max-width: 768px) {
            .profile-section {
                padding: 0 20px;
            }

            .profile-container {
                padding: 30px;
                border-radius: 20px;
            }

            .interests-container {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .interest-item {
                padding: 10px 15px;
            }

            .interest-item label {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <section class="profile-section">
        <div class="profile-container">
            <?php if (isset($success)): ?>
                <div class="message success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="message error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="me.php#interests-section">
                <div class="interests-section">
                    <h2 class="interests-title">Mes centres d'intérêt</h2>
                    <p class="interests-description">Sélectionnez vos centres d'intérêt pour personnaliser votre expérience</p>
                    <div class="selection-counter">Vous avez sélectionné <span id="selected-count">0</span> centre(s) d'intérêt</div>

                    <div class="interests-container">
                        <?php foreach ($all_interests as $id => $nom): ?>
                            <div class="interest-item <?php echo isset($user_interests[$id]) ? 'selected' : ''; ?>" style="<?php echo isset($user_interests[$id]) ? 'background: #FF3131; color: white; box-shadow: 0 4px 15px rgba(255, 49, 49, 0.3);' : ''; ?>">
                                <input type="checkbox" id="interest-<?php echo $id; ?>" name="interests[]" value="<?php echo $id; ?>"
                                    <?php echo isset($user_interests[$id]) ? 'checked' : ''; ?>>
                                <label for="interest-<?php echo $id; ?>"><?php echo htmlspecialchars($nom); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="submit-section">
                    <button type="submit" name="update_interests" class="submit-button">Mettre à jour mes centres d'intérêt</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        function updateSelectionCount() {
            const selectedCount = document.querySelectorAll('.interest-item.selected').length;
            document.getElementById('selected-count').textContent = selectedCount;
        }

        document.querySelectorAll('.interest-item').forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');
            const label = item.querySelector('label');

            // Gérer le clic sur l'élément entier
            item.addEventListener('click', function(e) {
                // Éviter la double exécution si on clique directement sur le label
                if (e.target === label) return;

                checkbox.checked = !checkbox.checked;
                this.classList.toggle('selected');
                updateSelectionCount();
            });

            // Gérer le clic sur le label
            label.addEventListener('click', function(e) {
                e.preventDefault();
                checkbox.checked = !checkbox.checked;
                item.classList.toggle('selected');
                updateSelectionCount();
            });
        });

        // Initial count
        updateSelectionCount();
    </script>
</body>

</html>