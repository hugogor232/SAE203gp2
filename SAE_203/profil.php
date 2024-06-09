<?php
session_start();
<<<<<<< HEAD
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
=======

if (!isset($_SESSION['pseudo'])) {
    header('Location: login.php');
    exit;
}

$pseudo = $_SESSION['pseudo'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['vehicle'])) {

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
        }

        $json_data = file_get_contents('./data/utilisateurs.json');
        $users = json_decode($json_data, true);

        foreach ($users as &$user) {
            if ($user['utilisateur'] === $pseudo) {
                $user['email'] = $email;
                if (!empty($_POST['password'])) {
                    $password = $_POST['password'];
                    $user['motdepasse'] = password_hash($password, PASSWORD_DEFAULT);
                }
                $user['vehicule'] = $_POST['vehicle'];
                break;
            }
        }

        file_put_contents('./data/utilisateurs.json', json_encode($users, JSON_PRETTY_PRINT));

        header('Location: profil.php');
        exit;
    }
}


$json_data = file_get_contents('./data/utilisateurs.json');
$users = json_decode($json_data, true);

foreach ($users as $user) {
    if ($user['utilisateur'] === $pseudo) {
        $email = $user['email'];
        $vehicle = $user['vehicule'];
        break;
    }
>>>>>>> origin/main
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Inscription</title>
=======
    <title>Profil</title>
>>>>>>> origin/main
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
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
=======
    <?php include ('functions.php'); ?>
    <?php genererNavigation(); ?>

    <div class="container mt-5">
        <div class="row align-items-center mb-4">
            <div class="col-auto">
                <img src="./images/img_avatar1.png" alt="Logo" width="100" height="100" style="border-radius: 50%;">
            </div>
            <div class="col">
                <h1 class="mb-0">Bienvenue sur votre profil,
                    <?php echo htmlspecialchars($pseudo); ?>
                </h1>
            </div>
        </div>
        <h2>Modifier votre profil</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                <label for="vehicle" class="form-label">Nouveau véhicule :</label>
                <input type="text" class="form-control" id="vehicle" name="vehicle"
                    value="<?php echo htmlspecialchars($vehicle); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary me-2">Modifier</button>
            <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
            <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal"
                data-bs-target="#changeAvatarModal">Changer d'avatar</button>
        </form>
    </div>

    <!-- Modal pour changer l'avatar -->
    <div class="modal fade" id="changeAvatarModal" tabindex="-1" aria-labelledby="changeAvatarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeAvatarModalLabel">Changer d'avatar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Formulaire de changement d'avatar ici...</p>
                </div>
>>>>>>> origin/main
            </div>
        </div>
    </div>

<<<<<<< HEAD
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

=======
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> origin/main
</body>

</html>