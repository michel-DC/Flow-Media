<?php require_once '../includes/auth.php'; ?>

<?php
// Connexion à la base de données
$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

// Gestion de la suppression d'un utilisateur
if (isset($_POST['delete_user'])) {
    $user_id = mysqli_real_escape_string($link, $_POST['user_id']);
    
    // Supprimer d'abord les enregistrements liés dans user_abonnement
    $delete_abonnement = "DELETE FROM user_abonnement WHERE user_id = '$user_id'";
    mysqli_query($link, $delete_abonnement);
    
    // Ensuite supprimer l'utilisateur
    $delete_user = "DELETE FROM users WHERE id = '$user_id'";
    if (mysqli_query($link, $delete_user)) {
        $success_message = "Utilisateur supprimé avec succès !";
    } else {
        $error_message = "Erreur lors de la suppression de l'utilisateur";
    }
}

// Default query to get all users
$query = "SELECT * FROM users ORDER BY id DESC";

// Traitement de la recherche
if (isset($_POST['search_users'])) {
    $search = mysqli_real_escape_string($link, $_POST['search']);
    $query = "SELECT * FROM users WHERE 
              fullname LIKE '%$search%' OR 
              email LIKE '%$search%' OR 
              abonnement_id LIKE '%$search%'
              ORDER BY id DESC";
}

if (isset($_POST['see_users'])) {
    // Reset to default query
    $query = "SELECT * FROM users ORDER BY id DESC";
}

$result = mysqli_query($link, $query);
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    :root {
        --primary-color: #2ECC71;
        --secondary-color: #25a25a;
        --text-color: #333;
        --light-bg: #f0f0f0;
        --white: #ffffff;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .user-component .user-list-container {
        font-family: "Poppins", sans-serif;
        max-width: 1200px;
        margin: 0 auto;
        margin-top: 20px;
        padding: 20px;
    }

    .user-component .user-list-container h1 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 45px;
        color: #151717;
        text-align: center;
        position: relative;
        padding-bottom: 10px;
    }

    .user-component .user-list-container h1 span {
        color: var(--primary-color);
        position: relative;
    }

    .user-component .user-list-container h1 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }

    .user-component .user-search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
        justify-content: center;
    }

    .user-component .user-search-form input[type="text"] {
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-family: "Poppins", sans-serif;
        flex-grow: 1;
        max-width: 400px;
    }

    .user-component .user-search-form button {
        padding: 10px 20px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .user-component .user-search-form button:hover {
        background-color: var(--secondary-color);
    }

    .user-component .users-table {
        width: 100%;
        border-collapse: collapse;
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .user-component .users-table th,
    .user-component .users-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    .user-component .users-table th {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .user-component .users-table tr:hover {
        background-color: #f9fafb;
    }

    .user-component .users-table td {
        font-size: 0.95rem;
        color: var(--text-color);
    }

    .user-component .delete-icon {
        cursor: pointer;
        width: 20px;
        height: 20px;
        transition: transform 0.2s ease;
    }

    .user-component .delete-icon:hover {
        transform: scale(1.1);
    }

    .user-component .delete-icon path {
        fill: #e74c3c;
    }

    .user-component .delete-icon:hover path {
        fill: #c0392b;
    }

    .user-component .no-user-message {
        text-align: center;
        font-size: 1.1rem;
        color: var(--text-color);
        margin-top: 20px;
    }

    .user-component .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .user-component .status-active {
        background-color: #dcfce7;
        color: #166534;
    }

    .user-component .status-inactive {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .user-component .message {
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

    .user-component .error {
        background-color: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .user-component .success {
        background-color: #f0fdf4;
        color: #166534;
        border: 1px solid #dcfce7;
    }

    @keyframes fadeOut {
        0% { opacity: 1; }
        90% { opacity: 1; }
        100% { opacity: 0; display: none; }
    }

    @media (max-width: 768px) {
        .user-component .user-search-form {
            flex-direction: column;
            align-items: center;
        }

        .user-component .user-search-form input[type="text"] {
            max-width: 100%;
        }

        .user-component .user-search-form button {
            width: 100%;
        }

        .user-component .user-list-container h1 {
            font-size: 28px;
        }

        .user-component .users-table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }
</style>

<div class="user-component">
    <div class="user-list-container">
        <?php if (isset($success_message)): ?>
            <div class="message success"><?= $success_message ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="message error"><?= $error_message ?></div>
        <?php endif; ?>

        <h1>Liste des <span>utilisateurs</span></h1>

        <form method="POST" action="dashboard.php#see-user-section" class="user-search-form">
            <input type="text" name="search" placeholder="Rechercher un utilisateur...">
            <button type="submit" name="search_users">Rechercher</button>
            <button type="submit" name="see_users">Voir tous les utilisateurs</button>
        </form>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Ville</th>
                        <th>Nombre de réservations</th>
                        <th>ID Abonnement</th>
                        <th>Date d'inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id'] ?? 'non renseigné') ?></td>
                            <td><?= htmlspecialchars($user['fullname'] ?? 'non renseigné') ?></td>
                            <td><?= htmlspecialchars($user['email'] ?? 'non renseigné') ?></td>
                            <td><?= intval($user['age'] ?? 'non renseigné') ?></td>
                            <td><?= htmlspecialchars($user['ville'] ?? 'non renseigné') ?></td>
                            <td><?= intval($user['nombre_reservation'] ?? 'non renseigné') ?></td>
                            <td><?= intval($user['abonnement_id'] ?? 'non renseigné') ?></td>
                            <td><?= $user['date_creation'] ? date('d/m/Y', strtotime($user['date_creation'])) : 'inconnu' ?></td>
                            <td>
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                                    <button type="submit" name="delete_user" style="background: none; border: none; padding: 0; cursor: pointer;">
                                        <svg class="delete-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-user-message">Aucun utilisateur trouvé pour votre recherche.</p>
        <?php endif; ?>
    </div>
</div>
