<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}


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


if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_POST['action']) && $_POST['action'] === 'supprimer_voiture' && isset($_POST['voiture_id'])) {
    $voiture_id = $_POST['voiture_id'];
    if (isset($voitures[$voiture_id])) {
        unset($voitures[$voiture_id]);
        file_put_contents('./data/voitures.json', json_encode($voitures));
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposer des Voitures à Louer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php include ('functions.php');
    genererHeader(); ?>
    <?php genererNavigation(); ?>

    <!-- Formulaire de recherche -->
    <div class=" bg-light">
        <div class="border rounded p-4">
            <h2 class=mb-4>Louez une voiture</h2>
            <div class="row g-3">
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <label for="lieu_recuperation" class="form-label">Lieu de récupération</label>
                    <select id="lieu_recuperation" class="form-select" aria-label="Lieu de récupération">
                        <option selected>Lieu de récupération</option>
                        <?php foreach ($voitures as $voiture): ?>
                            <?php foreach ($voiture['lieu_recuperation'] as $ville): ?>
                                <option value="<?php echo $ville; ?>"><?php echo $ville; ?></option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <label for="lieu_retour" class="form-label">Lieu de retour</label>
                    <select id="lieu_retour" class="form-select" aria-label="Lieu de retour">
                        <option selected>Lieu de retour</option>
                        <?php foreach ($voitures as $voiture): ?>
                            <?php foreach ($voiture['lieu_retour'] as $ville): ?>
                                <option value="<?php echo $ville; ?>"><?php echo $ville; ?></option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <label for="date_recuperation" class="form-label">Date de récupération</label>
                    <input id="date_recuperation" type="date" class="form-control" placeholder="Date de récupération">
                </div>
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <label for="heure_recuperation" class="form-label">Heure de récupération</label>
                    <input id="heure_recuperation" type="time" class="form-control" placeholder="Heure de récupération"
                        aria-label="Heure de récupération">
                </div>
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <label for="heure_retour" class="form-label">Heure de retour</label>
                    <input id="heure_retour" type="time" class="form-control placeholder=" Heure de retour"
                        aria-label="Heure de retour">
                </div>
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <label for="submit" class="form-label">&nbsp;</label>
                    <button id="submit" class="btn btn-dark w-100" type="submit">Rechercher</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="text-center mb-5">Nos Voitures à Louer</h1>
        <div class="row">
            <!-- Menu latéral -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Filtrer les voitures</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="proposer.php">
                            <!-- Marque -->
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
                            <!-- Prix -->
                            <div class="mb-3">
                                <label for="prix" class="form-label">Prix maximum (€/heure)</label>
                                <input type="number" id="prix" name="prix" class="form-control"
                                    placeholder="Prix en €/heure">
                            </div>
                            <!-- Carburant -->
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
                            <!-- Bouton de recherche -->
                            <button type="submit" class="btn btn-dark w-100">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Offres de voitures -->
            <div class="col-md-9">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach ($voitures as $voiture_id => $voiture): ?>
                        <div class="col">
                            <div class="card h-100 border-0 shadow-lg card-hover"
                                style="border-radius: 15px; transition: background-color 1s, color 1s;">
                                <img src="<?php echo htmlspecialchars($voiture['image']); ?>" class="card-img-top"
                                    alt="<?php echo htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']); ?>"
                                    style="height: 200px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold mb-3">
                                        <?php echo htmlspecialchars($voiture['marque'] . ' ' . $voiture['modele']); ?>
                                    </h5>
                                    <ul class="list-unstyled mb-4">
                                        <li class="card-text"><strong>Prix :</strong> <?php echo $voiture['prix']; ?>
                                            €/heure</li>
                                        <li class="card-text"><strong>Année :</strong>
                                            <?php echo htmlspecialchars($voiture['annee']); ?></li>
                                        <li class="card-text"><strong>Carburant :</strong>
                                            <?php echo htmlspecialchars($voiture['carburant']); ?></li>
                                    </ul>
                                    <?php if (isset($_SESSION['email']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                        <a href="reservation.php?voiture=<?php echo urlencode($voiture['marque'] . ' ' . $voiture['modele']); ?>"
                                            class="btn btn-dark btn-sm fw-bold">Réserver</a>
                                        <form method="POST">
                                            <input type="hidden" name="action" value="supprimer_voiture">
                                            <input type="hidden" name="voiture_id" value="<?php echo $voiture_id; ?>">
                                            <button type="submit" class="btn btn-outline-danger"><i
                                                    class="fas fa-trash-alt me-1"></i>Supprimer</button>
                                        </form>
                                    <?php elseif (isset($_SESSION['email'])): ?>
                                        <a href="reservation.php?voiture=<?php echo urlencode($voiture['marque'] . ' ' . $voiture['modele']); ?>"
                                            class="btn btn-dark btn-sm fw-bold">Réserver</a>
                                    <?php else: ?>
                                        <a href="login.php" class="btn btn-dark btn-sm fw-bold">Connectez-vous pour réserver</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>
    </div>

    <script>
        document.querySelectorAll('.card-hover').forEach(function (card)) {
            card.addEventListener('mouseenter', function () {
                card.style.backgroundColor = '#222';
                card.style.color = '#fff';
                setTimeout(function () {
                    card.style.transition = 'background-color 0.5s, color 0.5s';
                }, 5);
            });

            card.addEventdocument.querySelectorAll('.card-hover').forEach(function (card) {
                card.addEventListener('mouseleave', function () {
                    card.style.backgroundColor = '';
                    card.style.color = '';
                    setTimeout(function () {
                        card.style.transition = 'background-color 0.5s, color 0.5s';
                    }, 5);
                });
            })
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>