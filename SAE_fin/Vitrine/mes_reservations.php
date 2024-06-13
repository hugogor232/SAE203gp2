<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$reservations_data = file_get_contents('./data/mes_reservations.json');
$reservations = json_decode($reservations_data, true);

$userReservations = array_filter($reservations, function($reservation) {
    return $reservation['email'] === $_SESSION['email'];
});

function Prix_total($reservation) {
    $dateRecuperation = new DateTime($reservation['date_recuperation'] . ' 10:00');
    $dateRetour = new DateTime($reservation['date_retour'] . ' 10:00');
    $interval = $dateRecuperation->diff($dateRetour);
    $hours = $interval->days * 24 + $interval->h;
    return $hours * $reservation['voiture']['prix'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['annulé_reservation'])) {
    $reservationIndex = $_POST['reservation_index'];
    unset($reservations[$reservationIndex]);
    file_put_contents('./data/mes_reservations.json', json_encode(array_values($reservations)));
    header('Location: mes_reservations.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include('functions.php'); genererHeader(); ?>
    <?php genererNavigation(); ?>

    <div class="container mt-5">
        <h1 class="text-center mb-5">Mes Réservations</h1>
        <div class="row">
            <?php if (empty($userReservations)): ?>
                <p class="text-center">Vous n'avez aucune réservation.</p>
            <?php else: ?>
                <?php foreach ($userReservations as $index => $reservation): ?>
                    <div class="col-md-6 offset-md-3 mb-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0">Réservation pour <?php echo htmlspecialchars($reservation['voiture']['marque'] . ' ' . $reservation['voiture']['modele']); ?></h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-4">
                                    <li class="card-text"><strong>Prix :</strong> <?php echo $reservation['voiture']['prix']; ?> €/heure</li>
                                    <li class="card-text"><strong>Année :</strong> <?php echo htmlspecialchars($reservation['voiture']['annee']); ?></li>
                                    <li class="card-text"><strong>Carburant :</strong> <?php echo htmlspecialchars($reservation['voiture']['carburant']); ?></li>
                                    <li class="card-text"><strong>Date de récupération :</strong> <?php echo htmlspecialchars($reservation['date_recuperation']); ?></li>
                                    <li class="card-text"><strong>Date de retour :</strong> <?php echo htmlspecialchars($reservation['date_retour']); ?></li>
                                    <li class="card-text"><strong>Lieu de récupération :</strong> <?php echo htmlspecialchars($reservation['lieu_recuperation']); ?></li>
                                    <li class="card-text"><strong>Lieu de retour :</strong> <?php echo htmlspecialchars($reservation['lieu_retour']); ?></li>
                                    <li class="card-text"><strong>Prix total de la location :</strong> <?php echo Prix_total($reservation); ?> €</li>
                                </ul>
                                <form method="post" action="">
                                    <input type="hidden" name="reservation_index" value="<?php echo $index; ?>">
                                    <button type="submit" name="annulé_reservation" class="btn btn-danger">Annuler la réservation</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
