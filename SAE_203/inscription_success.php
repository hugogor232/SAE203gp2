<!-- inscription_success.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription réussie</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include ('functions.php'); ?>
    <?php genererNavigation(); ?>

    <div class="container">
        <h2>Inscription réussie</h2>
        <div class="alert alert-success" role="alert">
            Votre inscription a été effectuée avec succès ! Vous pouvez maintenant vous connecter.
        </div>
        <a href="login.php" class="btn btn-primary">Se connecter</a>
        <a href="index.php" class="btn btn-primary">Revenir a la page d'accuil</a>
    </div>
</body>

</html>