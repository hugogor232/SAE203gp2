<!-- login.php -->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include ('functions.php');
    genererNavigation();
    genererLogin(); ?>


    <div class="container">
        <h1>Connexion</h1>
        <?php if (isset($erreur_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $erreur_message; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="pseudo">Pseudo :</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Se souvenir de moi
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
            <a href="index.php" class="btn btn-primary">Revenir a la page d'accuil</a>
        </form>
    </div>
</body>

</html>