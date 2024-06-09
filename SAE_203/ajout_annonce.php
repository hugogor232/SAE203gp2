<!-- ajout-annonces.php -->

<?php
$annonces_json = file_get_contents('./data/annonces.json');
$annonces = json_decode($annonces_json, true);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_annonce = array(
        'Pseudo' => $_POST['pseudo'],
        'Date' => $_POST['date_depart'] . ' ' . $_POST['heure'],
        'Depart' => $_POST['ville_depart'],
        'Arrivee' => $_POST['ville_arrivee'],
        'Places' => $_POST['places_disponibles'],
        'Commentaire' => $_POST['commentaire'],
        'id' => uniqid()

    );

    $annonces[] = $new_annonce;

    file_put_contents('./data/annonces.json', json_encode($annonces));
    $annonce_success = true;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include ('functions.php'); ?>
    <?php genererNavigation(); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">Ajouter une annonce</div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="pseudo" class="form-label">Pseudo</label>
                                <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_depart" class="form-label">Date de départ</label>
                                <input type="date" class="form-control" id="date_depart" name="date_depart" required>
                            </div>
                            <div class="mb-3">
                                <label for="heure" class="form-label">Heure</label>
                                <input type="time" class="form-control" id="heure" name="heure" required>
                            </div>
                            <div class="mb-3">
                                <label for="ville_depart" class="form-label">Ville de départ</label>
                                <input type="text" class="form-control" id="ville_depart" name="ville_depart" required>
                            </div>
                            <div class="mb-3">
                                <label for="ville_arrivee" class="form-label">Ville d'arrivée</label>
                                <input type="text" class="form-control" id="ville_arrivee" name="ville_arrivee"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="places_disponibles" class="form-label">Places disponibles</label>
                                <input type="number" class="form-control" id="places_disponibles"
                                    name="places_disponibles" required>
                            </div>
                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Commentaire</label>
                                <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark">Ajouter l'annonce</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>