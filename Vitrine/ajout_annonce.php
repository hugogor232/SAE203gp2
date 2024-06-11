<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Fonction pour ajouter une voiture
function ajouterVoiture($nouvelle_voiture)
{
    $json_data = file_get_contents('./data/voitures.json');
    $voitures = json_decode($json_data, true);
    $voitures[] = $nouvelle_voiture;

    file_put_contents('./data/voitures.json', json_encode($voitures, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $prix = $_POST['prix'];
    $annee = $_POST['annee'];
    $carburant = $_POST['carburant'];
    $image = $_POST['image'];
    $lieu_recuperation = explode(',', $_POST['lieu_recuperation']);
    $lieu_retour = explode(',', $_POST['lieu_retour']);

    $nouvelle_voiture = [
        'marque' => $marque,
        'modele' => $modele,
        'prix' => (int) $prix,
        'annee' => (int) $annee,
        'carburant' => $carburant,
        'image' => $image,
        'lieu_recuperation' => array_map('trim', $lieu_recuperation),
        'lieu_retour' => array_map('trim', $lieu_retour)
    ];

    ajouterVoiture($nouvelle_voiture);

    header('Location: proposer.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Annonce de Voiture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php include ('functions.php');
    genererHeader(); ?>
    <?php genererNavigation(); ?>

    <div class="container mt-5">
        <h1 class="text-center mb-5">Ajouter une Annonce de Voiture</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Nouvelle Voiture</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="ajout_annonce.php">
                            <div class="mb-3">
                                <label for="marque" class="form-label">Marque</label>
                                <input type="text" id="marque" name="marque" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="modele" class="form-label">Modèle</label>
                                <input type="text" id="modele" name="modele" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="prix" class="form-label">Prix (€/heure)</label>
                                <input type="number" id="prix" name="prix" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="annee" class="form-label">Année</label>
                                <input type="number" id="annee" name="annee" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="carburant" class="form-label">Type de Carburant</label>
                                <select id="carburant" name="carburant" class="form-select" required>
                                    <option value="Essence">Essence</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Électrique">Électrique</option>
                                    <option value="Hybride">Hybride</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Téléverser une Image :</label>
                                <input class="form-control" type="file" id="file" name="file">
                            </div>
                            <div class="mb-3">
                                <label for="lieu_recuperation" class="form-label">Lieux de Récupération (séparés par des
                                    virgules)</label>
                                <input type="text" id="lieu_recuperation" name="lieu_recuperation" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="lieu_retour" class="form-label">Lieux de Retour (séparés par des
                                    virgules)</label>
                                <input type="text" id="lieu_retour" name="lieu_retour" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Ajouter</button>
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