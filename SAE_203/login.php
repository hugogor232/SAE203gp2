<<<<<<< HEAD
<<<<<<< HEAD
<?php
session_start();
include ('functions.php');
genererLogin();
genererNavigation();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
=======
=======
>>>>>>> 7f1f5e98f48e9e4fd9148bb7548b41da1624c57a
<!-- login.php -->

<?php
session_start();
<<<<<<< HEAD
>>>>>>> origin/main
=======
>>>>>>> 7f1f5e98f48e9e4fd9148bb7548b41da1624c57a
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
<<<<<<< HEAD
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h2 class="card-title">Connexion</h2>
            </div>
            <div class="card-body">
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Se connecter</button>
                    <a href="inscription.php" class="btn btn-secondary">S'inscrire</a>
                </form>
            </div>
        </div>
    </div>

=======
=======
>>>>>>> 7f1f5e98f48e9e4fd9148bb7548b41da1624c57a
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
<<<<<<< HEAD
>>>>>>> origin/main
=======
>>>>>>> 7f1f5e98f48e9e4fd9148bb7548b41da1624c57a
</body>

</html>