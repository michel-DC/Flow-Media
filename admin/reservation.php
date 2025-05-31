<?php
require_once '../includes/auth.php';


$link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");


$query = "SELECT r.*, u.fullname as nom_user, a.titre as nom_activite, a.date_activite as date_activite, places as nombre_place, prix as prix
          FROM reservations r 
          JOIN users u ON r.user_id = u.id 
          JOIN activites a ON r.activite_id = a.id 
          ORDER BY r.date_reservation DESC";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réservations | Flow Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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

        .reservations-component {
            font-family: "Poppins", sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
        }

        .reservations-component h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 45px;
            color: #151717;
            text-align: center;
            position: relative;
            padding-bottom: 10px;
        }

        .reservations-component h1 span {
            color: var(--primary-color);
            position: relative;
        }

        .reservations-component h1 span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px;
        }

        .reservations-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .reservations-table th,
        .reservations-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .reservations-table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .reservations-table tr:hover {
            background-color: #f9fafb;
        }

        .reservations-table td {
            font-size: 0.95rem;
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .reservations-component {
                padding: 10px;
            }

            .reservations-component h1 {
                font-size: 28px;
            }

            .reservations-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>
    <div class="reservations-component">
        <h1>Liste des <span>réservations</span></h1>

        <table class="reservations-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Activité</th>
                    <th>Date de réservation</th>
                    <th>Date de l'activité</th>
                    <th>Nombre de places</th>
                    <th>Prix total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nom_user']); ?></td>
                        <td><?php echo htmlspecialchars($row['nom_activite']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['date_reservation'])); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['date_activite'])); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_place']); ?></td>
                        <td><?php echo htmlspecialchars($row['prix']); ?></td>

                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>