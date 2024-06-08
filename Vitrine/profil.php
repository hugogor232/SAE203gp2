<!-- profil.php -->

<?php

include ('functions.php');
if (isset($_GET['action']) && $_GET['action'] === 'supprimer_annonce' && isset($_GET['id'])) {
    $annonce_id = $_GET['id'];
    $annonces_json = file_get_contents('./data/annonces.json');
    $annonces = json_decode($annonces_json, true);
    if (isset($annonces[$annonce_id])) {
        unset($annonces[$annonce_id]);
        file_put_contents('./data/annonces.json', json_encode($annonces));
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}

// Lire le fichier JSON
$json_data = file_get_contents('./data/voitures.json');
$voitures = json_decode($json_data, true);

// Filtrer les voitures en fonction des critères de recherche
if (isset($_GET['marque']) || isset($_GET['prix']) || isset($_GET['carburant'])) {
    $marque = $_GET['marque'] ?? '';
    $prix = $_GET['prix'] ?? '';
    $carburant = $_GET['carburant'] ?? '';

    $voitures = array_filter($voitures, function ($voiture) use ($marque, $prix, $carburant) {
        if ($marque && $voiture['marque'] !== $marque) {
            return false;
        }
        if ($prix && $voiture['prix'] > $prix) {
            return false;
        }
        if ($carburant && $voiture['carburant'] !== $carburant) {
            return false;
        }
        return true;
    });
}

?>

<!DOCTYPE html>
<html lang="fr">
<?php genererHeader(); ?> <!-- Appel de la fonction genererHeader() -->
<?php genererNavigation(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposer des Voitures à Louer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

    <!-- Page Content -->
    <div class="container mt-5">
        <h1 class="text-center mb-5">Nos Voitures à Louer</h1>
        <div class="row">
            <!-- Sidebar Menu -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Filtrer les voitures</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="proposer.php">
                            <div class="mb-3">
                                <label for="marque" class="form-label">Marque</label>
                                <select id="marque" name="marque" class="form-select">
                                    <option value="">Toutes les marques</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="BMW">BMW</option>
                                    <option value="Mercedes-Benz">Mercedes-Benz</option>
                                    <option value="Audi">Audi</option>
                                    <option value="Volkswagen">Volkswagen</option>
                                    <option value="Ford">Ford</option>
                                    <option value="Tesla">Tesla</option>
                                    <option value="Porsche">Porsche</option>
                                    <option value="Chevrolet">Chevrolet</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="prix" class="form-label">Prix maximum (€ par heure)</label>
                                <input type="number" id="prix" name="prix" class="form-control" placeholder="Prix en €">
                            </div>
                            <div class="mb-3">
                                <label for="carburant" class="form-label">Type de carburant</label>
                                <select id="carburant" name="carburant" class="form-select">
                                    <option value="">Tous</option>
                                    <option value="Essence">Essence</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Électrique">Électrique</option>
                                    <option value="Hybride">Hybride</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Car Offers -->
            <div class="col-md-9">
                <div class="row">
                    <?php foreach ($voitures as $voiture): ?>
                        <div class="col-12 mb-4">
                            <div class="card h-100 d-flex flex-row">
                                <div class="card-body flex-grow-1">
                                    <h5 class="card-title">
                                        <?php echo htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']); ?>
                                    </h5>
                                    <p class="card-text">Prix : <?php echo number_format($voiture['prix'], 2, ',', ' '); ?>
                                        €/heure</p>
                                    <p class="card-text">Année : <?php echo htmlspecialchars($voiture['annee']); ?></p>
                                    <p class="card-text">Carburant : <?php echo htmlspecialchars($voiture['carburant']); ?>
                                    </p>
                                    <a href="reservation.php?voiture=<?php echo urlencode($voiture['marque'] . ' ' . $voiture['modele']); ?>"
                                        class="btn btn-primary">Réserver</a>
                                </div>
                                <img src="<?php echo htmlspecialchars($voiture['image']); ?>" class="card-img-right"
                                    alt="<?php echo htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']); ?>"
                                    style="width: 200px; object-fit: cover;">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>