<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit(); // Arrêter l'exécution du script
}

// Fonction pour charger les réservations de l'utilisateur connecté
function getUserReservations($email)
{
    $reservations_json = file_exists('./data/reservations.json') ? file_get_contents('./data/reservations.json') : '[]';
    $reservations = json_decode($reservations_json, true);
    $user_reservations = [];

    foreach ($reservations as $reservation) {
        if ($reservation['email'] == $email) {
            $user_reservations[] = $reservation;
        }
    }

    return $user_reservations;
}

$email = $_SESSION['email'];
$reservations = getUserReservations($email);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Mes Réservations</h1>

        <?php if (empty($reservations)): ?>
            <div class="alert alert-info mt-3" role="alert">
                Aucune réservation trouvée pour votre compte.
            </div>
        <?php else: ?>
            <ul class="list-group mt-3">
                <?php foreach ($reservations as $reservation): ?>
                    <li class="list-group-item">
                        <strong>Voiture:</strong> <?php echo htmlspecialchars($reservation['voiture']); ?><br>
                        <strong>Date de récupération:</strong>
                        <?php echo htmlspecialchars($reservation['date_recuperation']); ?><br>
                        <strong>Heure de récupération:</strong>
                        <?php echo htmlspecialchars($reservation['heure_recuperation']); ?><br>
                        <strong>Date de retour:</strong> <?php echo htmlspecialchars($reservation['date_retour']); ?><br>
                        <strong>Heure de retour:</strong> <?php echo htmlspecialchars($reservation['heure_retour']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <a href="index.php" class="btn btn-primary mt-3">Retour à l'accueil</a>
    </div>

    <!-- Bootstrap JS (pour les composants qui en nécessitent) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>