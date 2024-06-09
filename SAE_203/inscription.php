<<<<<<< HEAD
<<<<<<< HEAD
<?php
session_start();
include ('functions.php');
genererInscription();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $dob = $_POST['dob'];

}
?>

=======
=======
>>>>>>> 7f1f5e98f48e9e4fd9148bb7548b41da1624c57a
<!-- inscription.php -->

<?php
session_start();
?>
<<<<<<< HEAD
>>>>>>> origin/main
=======
>>>>>>> 7f1f5e98f48e9e4fd9148bb7548b41da1624c57a
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
<<<<<<< HEAD
<<<<<<< HEAD
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h2 class="card-title">Inscription</h2>
            </div>
            <div class="card-body">
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Afficher le mot de passe</label>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone:</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date de naissance:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <button type="submit" class="btn btn-success">S'inscrire</button>
                    <a href="index.php" class="btn btn-secondary">Revenir à la page d'accueil</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("showPassword").addEventListener("change", function () {
                var passwordInput = document.getElementById("password");
                if (this.checked) {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            });
        });
    </script>

</body>

=======
=======
>>>>>>> 7f1f5e98f48e9e4fd9148bb7548b41da1624c57a
    <?php include ('functions.php');
    genererNavigation();
    genererInscription(); ?>


    <div class="container">
        <h2>Inscription</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="showPassword">
                <label class="form-check-label" for="showPassword">Afficher le mot de passe</label>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="vehicule">Véhicule:</label>
                <input type="text" class="form-control" id="vehicule" name="vehicule" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">S'inscrire</button>
            <a href="index.php" class="btn btn-secondary mt-3">Revenir à la page d'accueil</a>
        </form>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("showPassword").addEventListener("change", function () {
            var passwordInput = document.getElementById("password");
            if (this.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    });
</script>

<<<<<<< HEAD
>>>>>>> origin/main
=======
>>>>>>> 7f1f5e98f48e9e4fd9148bb7548b41da1624c57a
</html>