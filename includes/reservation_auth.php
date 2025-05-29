<?php
function checkReservationAuth($user_id)
{
    $link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");

    $query = "SELECT nombre_reservation, abonnement_id FROM users WHERE id = $user_id";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        return [
            'authorized' => false,
            'message' => 'Utilisateur non trouvé'
        ];
    }

    $current_month = date('Y-m');
    $query = "SELECT COUNT(*) as count FROM reservations 
              WHERE user_id = $user_id 
              AND DATE_FORMAT(date_reservation, '%Y-%m') = '$current_month'";
    $result = mysqli_query($link, $query);
    $reservations_count = mysqli_fetch_assoc($result)['count'];

    switch ($user['abonnement_id']) {
        case 1: // Abonnement basique
            if ($reservations_count >= 1) {
                return [
                    'authorized' => false,
                    'message' => 'Vous avez atteint la limite de réservations pour votre abonnement basique (1 réservation par mois).',
                    'upgrade_link' => '/pages/abonnement'
                ];
            }
            break;

        case 2: // Abonnement standard
            if ($reservations_count >= 5) {
                return [
                    'authorized' => false,
                    'message' => 'Vous avez atteint la limite de réservations pour votre abonnement standard (5 réservations par mois).',
                    'upgrade_link' => '/pages/abonnement'
                ];
            }
            break;

        case 3: // Abonnement premium
            return [
                'authorized' => true,
                'message' => ''
            ];
            break;

        default:
            return [
                'authorized' => false,
                'message' => 'Type d\'abonnement non reconnu'
            ];
    }

    return [
        'authorized' => true,
        'message' => ''
    ];
}
