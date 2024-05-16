<!-- proposer.php -->

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
    } else {

    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des annonces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php genererHeader(); ?> <!-- Appel de la fonction genererHeader() -->
    <?php genererNavigation(); ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Liste des annonces disponibles</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            $annonces_json = file_get_contents('./data/annonces.json');
            $annonces = json_decode($annonces_json, true);

            foreach ($annonces as $index => $annonce) {
                echo '<div class="col">';
                echo '<div class="card" style="width: 400px;">';
                echo '<img class="card-img-top" src="./images/Covoiturage.png" alt="logo">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title">' . ucfirst($annonce['Pseudo']) . '</h4>';
                echo '<h6 class="card-subtitle mb-2">Date : ' . date("d-m-Y H:i", strtotime($annonce['Date'])) . '</h6>';
                echo '<p class="card-text">Départ : ' . ucfirst($annonce['Depart']) . '</p>';
                echo '<p class="card-text">Arrivée : ' . ucfirst($annonce['Arrivee']) . '</p>';
                echo '<p class="card-text">Places disponibles : ' . $annonce['Places'] . '</p>';
                echo '<p class="card-text">Commentaire : ' . ($annonce['Commentaire'] !== '' ? $annonce['Commentaire'] : 'Aucun commentaire') . '</p>';
                if (!empty($annonce['Inscrits'])) {
                    echo '<p class="card-text">Inscrits : ' . implode(", ", $annonce['Inscrits']) . '</p>';
                }
                echo '</div>';
                echo '<div class="card-footer d-flex justify-content-between">';
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
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>