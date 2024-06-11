<!-- administrer.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php include ('functions.php'); ?>
    <?php genererNavigation(); ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Administration des utilisateurs</h2>

        <form method="post">
            <div class="mb-3 input-group">
                <input type="text" class="form-control" placeholder="Rechercher par nom" name="search">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Revenir à la page
                d'accueil</a>
        </form>

        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php administrer(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>

</html>