<?php
session_start();

$json_data = file_get_contents('./data/voitures.json');
$voitures = json_decode($json_data, true);

// Récupérer les détails de la voiture sélectionnée
$voitureSelectionnee = null;
if (isset($_GET['voiture'])) {
    $voitureNom = urldecode($_GET['voiture']);
    foreach ($voitures as $voiture) {
        if ($voiture['marque'] . ' ' . $voiture['modele'] === $voitureNom) {
            $voitureSelectionnee = $voiture;
            break;
        }
    }
}

if (!$voitureSelectionnee) {
    header('Location: proposer.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmer'])) {
    $reservation = [
        'email' => $_SESSION['email'],
        'voiture' => $voitureSelectionnee,
        'date_recuperation' => $_POST['date_recuperation'],
        'date_retour' => $_POST['date_retour']
    ];

    $reservations_data = file_get_contents('./data/mes_reservations.json');
    $reservations = json_decode($reservations_data, true);

    if (!$reservations) {
        $reservations = [];
    }

    $reservations[] = $reservation;

    file_put_contents('./data/mes_reservations.json', json_encode($reservations, JSON_PRETTY_PRINT));

    echo "<script>
          alert('Réservation confirmée');
          window.location.href = 'mes_reservations.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver une Voiture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('functions.php'); genererHeader(); ?>
    <?php genererNavigation(); ?>

    <div class="container mt-5">
        <h1 class="text-center mb-5">Réserver une Voiture</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Résumé de l'offre</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($voitureSelectionnee['marque'] . ' ' . $voitureSelectionnee['modele']); ?></h5>
                        <ul class="list-unstyled mb-4">
                            <li class="card-text"><strong>Prix :</strong> <?php echo $voitureSelectionnee['prix']; ?> €/heure</li>
                            <li class="card-text"><strong>Année :</strong> <?php echo htmlspecialchars($voitureSelectionnee['annee']); ?></li>
                            <li class="card-text"><strong>Carburant :</strong> <?php echo htmlspecialchars($voitureSelectionnee['carburant']); ?></li>
                        </ul>
                        <form method="POST" action="reservation.php?voiture=<?php echo urlencode($voitureSelectionnee['marque'] . ' ' . $voitureSelectionnee['modele']); ?>">
                            <div class="mb-3">
                                <label for="date_recuperation" class="form-label">Date de récupération</label>
                                <input type="date" id="date_recuperation" name="date_recuperation" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_retour" class="form-label">Date de retour</label>
                                <input type="date" id="date_retour" name="date_retour" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="proposer.php" class="btn btn-secondary">Retour</a>
                                <button type="submit" name="confirmer" class="btn btn-dark">Confirmer votre réservation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
