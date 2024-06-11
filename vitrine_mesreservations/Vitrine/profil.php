<!-- profil.php -->

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

include ('functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    modifProfil();
}

// Assurez-vous que toutes les clés sont définies dans la session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : '';
$nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';
$adresse = isset($_SESSION['adresse']) ? $_SESSION['adresse'] : '';
$telephone = isset($_SESSION['telephone']) ? $_SESSION['telephone'] : '';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php genererNavigation(); ?>

    <div class="container mt-5">
        <div class="row align-items-center mb-4">
            <div class="col-auto">
                <img src="./images/img_avatar1.png" alt="Logo" width="100" height="100" style="border-radius: 50%;">
            </div>
            <div class="col">
                <h1 class="mb-0">Bienvenue sur votre profil, <?php echo htmlspecialchars($prenom); ?>
                    <?php echo htmlspecialchars($nom); ?>
                </h1>
            </div>
        </div>
        <h2>Informations personnelles</h2>
        <p><strong>Prénom:</strong> <?php echo htmlspecialchars($prenom); ?></p>
        <p><strong>Nom:</strong> <?php echo htmlspecialchars($nom); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Adresse:</strong> <?php echo htmlspecialchars($adresse); ?></p>
        <p><strong>Téléphone:</strong> <?php echo htmlspecialchars($telephone); ?></p>
        <hr>
        <?php if (!empty($adresse)): ?>
            <p><strong>Adresse:</strong> <?php echo htmlspecialchars($adresse); ?></p>
        <?php endif; ?>
        <?php if (!empty($telephone)): ?>
            <p><strong>Téléphone:</strong> <?php echo htmlspecialchars($telephone); ?></p>
        <?php endif; ?>
        <hr>
        <h2>Modifier votre profil</h2>
        <form action="index.php" method="post">
            <div class="mb-3">
                <label for="prenom" class="form-label">Nouveau prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom"
                    value="<?php echo htmlspecialchars($prenom); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nouveau nom :</label>
                <input type="text" class="form-control" id="nom" name="nom"
                    value="<?php echo htmlspecialchars($nom); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Nouvel email :</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe (laissez vide pour ne pas changer)
                    :</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Nouvelle adresse :</label>
                <input type="text" class="form-control" id="adresse" name="adresse"
                    value="<?php echo htmlspecialchars($adresse); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Nouveau numéro de téléphone :</label>
                <input type="text" class="form-control" id="telephone" name="telephone"
                    value="<?php echo htmlspecialchars($telephone); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary me-2">Modifier</button>
            <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>