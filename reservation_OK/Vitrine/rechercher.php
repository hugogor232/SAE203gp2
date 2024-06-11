<?php
$annonces_json = file_get_contents('./data/annonces.json');
$annonces = json_decode($annonces_json, true);
$annonces_filtrees = [];

if (isset($_GET['date_depart']) || isset($_GET['places_disponibles']) || isset($_GET['trajet'])) {
    $annonces_filtrees = array_filter($annonces, function ($annonce) {
        if (isset ($_GET['date_depart']) && $_GET['date_depart'] !== '' && date('Y-m-d', strtotime($_GET['date_depart'])) !== $annonce['Date']) {
            return false;
        }
        if (isset ($_GET['places_disponibles']) && $_GET['places_disponibles'] !== '' && intval($_GET['places_disponibles']) > $annonce['Places']) {
            return false;
        }
        if (isset ($_GET['trajet']) && $_GET['trajet'] !== '' && strpos($annonce['Depart'] . ' - ' . $annonce['Arrivee'], $_GET['trajet']) === false) {
            return false;
        }
        return true;
    });

    if (empty($annonces_filtrees)) {
        $message = "Aucune annonce trouvée pour les critères spécifiés.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher des annonces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php include ('functions.php'); ?>
    <?php genererNavigation(); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">Rechercher des annonces</div>
                    <div class="card-body">
                        <form method="get">
                            <div class="mb-3">
                                <label for="date_depart" class="form-label">Date de départ</label>
                                <input type="date" class="form-control" id="date_depart" name="date_depart">
                            </div>
                            <div class="mb-3">
                                <label for="places_disponibles" class="form-label">Places disponibles</label>
                                <input type="number" class="form-control" id="places_disponibles"
                                    name="places_disponibles" min="1">
                            </div>
                            <div class="mb-3">
                                <label for="trajet" class="form-label">Trajet (Ville de départ - Ville
                                    d'arrivée)</label>
                                <input type="text" class="form-control" id="trajet" name="trajet">
                            </div>
                            <button type="submit" class="btn btn-dark">Rechercher</button>
                        </form>
                    </div>
                </div>
                <?php if (isset($message)): ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php else: ?>
                    <div class="mt-3">
                        <div class="container mt-5">
                            <div class="row justify-content-center">
                                <?php foreach ($annonces_filtrees as $index => $annonce): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card border-5">
                                            <img class="card-img-top" src="./images/Covoiturage.png" alt="Avatar">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php echo ucfirst($annonce['Pseudo']); ?>
                                                </h5>
                                                <h6 class="card-subtitle mb-2">Date :
                                                    <?php echo date("d-m-Y H:i", strtotime($annonce['Date'])); ?>
                                                </h6>
                                                <p class="card-text">Départ :
                                                    <?php echo ucfirst($annonce['Depart']); ?>
                                                </p>
                                                <p class="card-text">Arrivée :
                                                    <?php echo ucfirst($annonce['Arrivee']); ?>
                                                </p>
                                                <p class="card-text">Places disponibles :
                                                    <?php echo $annonce['Places']; ?>
                                                </p>
                                                <p class="card-text">Commentaire :
                                                    <?php echo ($annonce['Commentaire'] !== '' ? $annonce['Commentaire'] : 'Aucun commentaire'); ?>
                                                </p>
                                                <?php if (!empty($annonce['Inscrits'])): ?>
                                                    <p class="card-text">Inscrits :
                                                        <?php echo implode(", ", $annonce['Inscrits']); ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-footer border-2">
                                                <?php
                                                if (
                                                    session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['role']) &&
                                                    $_SESSION['role'] === 'admin'
                                                ) {
                                                    echo '<div class="d-flex">';
                                                    if (isset($_GET['action']) && $_GET['action'] === 'reserver_annonce' && isset($_GET['id'])) {
                                                        $annonce_id = $_GET['id'];
                                                        reserver_annonce($annonce_id, $_SERVER['PHP_SELF']);
                                                    }
                                                    echo '<form method="GET" action="proposer.php" class="me-2">';
                                                    echo '<input type="hidden" name="action" value="reserver_annonce">';
                                                    echo '<input type="hidden" name="id" value="' . $index . '">';
                                                    echo '<button type="submit" class="btn btn-outline-primary">Réserver</button>';
                                                    echo '</form>';
                                                    echo '<a href="modifier.php" class="btn btn-outline-info me-2">Modifier</a>';
                                                    echo '</div>';
                                                    echo '<form method="GET">';
                                                    echo '<input type="hidden" name="action" value="supprimer_annonce">';
                                                    echo '<input type="hidden" name="id" value="' . $index . '">';
                                                    echo '<button type="submit" class="btn btn-outline-danger">Supprimer</button>';
                                                    echo '</form>';
                                                } elseif (
                                                    session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['role']) &&
                                                    ($_SESSION['role'] === 'user' || $_SESSION['role'] === 'modo')
                                                ) {
                                                    // Bouton pour réserver une annonce
                                                    if (
                                                        session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['role']) &&
                                                        ($_SESSION['role'] === 'user' || $_SESSION['role'] === 'modo')
                                                    ) {
                                                        if (isset($_GET['action']) && $_GET['action'] === 'reserver_annonce' && isset($_GET['id'])) {
                                                            $annonce_id = $_GET['id'];
                                                            reserver_annonce($annonce_id, $_SERVER['PHP_SELF']);
                                                        }
                                                        echo '<form method="GET" action="proposer.php" class="me-2">';
                                                        echo '<input type="hidden" name="action" value="reserver_annonce">';
                                                        echo '<input type="hidden" name="id" value="' . $index . '">';
                                                        echo '<button type="submit" class="btn btn-outline-primary">Réserver</button>';
                                                        echo '</form>';
                                                    }
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>