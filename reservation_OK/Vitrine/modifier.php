<!-- modifier.php -->

<?php
$annonces_json = file_get_contents('./data/annonces.json');
$annonces = json_decode($annonces_json, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $annonce_index = $_POST['annonce_index'];

    $annonces[$annonce_index]['Pseudo'] = $_POST['pseudo'];
    $annonces[$annonce_index]['Depart'] = $_POST['depart'];
    $annonces[$annonce_index]['Arrivee'] = $_POST['arrivee'];
    $annonces[$annonce_index]['Places'] = $_POST['places'];
    $annonces[$annonce_index]['Commentaire'] = $_POST['commentaire'];

    file_put_contents('./data/annonces.json', json_encode($annonces));

    echo "<div class='alert alert-success'>Annonce mise à jour avec <strong>succès!</strong>.</div>";

    // Rediriger vers index.php après 2s 
    header("refresh:2;url=index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php include ('functions.php'); ?>
    <?php genererNavigation(); ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Modifier l'annonce</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="annonce" class="form-label">Sélectionnez l'annonce à modifier :</label>
                <select class="form-select" id="annonce" name="annonce_index">
                    <?php foreach ($annonces as $index => $annonce): ?>
                        <option value="<?php echo $index; ?>">
                            <?php echo ucfirst($annonce['Pseudo']) . ' - ' . $annonce['Depart'] . ' à ' . $annonce['Arrivee']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo :</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" required>
            </div>
            <div class="mb-3">
                <label for="depart" class="form-label">Départ :</label>
                <input type="text" class="form-control" id="depart" name="depart" required>
            </div>
            <div class="mb-3">
                <label for="arrivee" class="form-label">Arrivée :</label>
                <input type="text" class="form-control" id="arrivee" name="arrivee" required>
            </div>
            <div class="mb-3">
                <label for="places" class="form-label">Places disponibles :</label>
                <input type="number" class="form-control" id="places" name="places" required>
            </div>
            <div class="mb-3">
                <label for="commentaire" class="form-label">Commentaire :</label>
                <textarea class="form-control" id="commentaire" name="commentaire"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>