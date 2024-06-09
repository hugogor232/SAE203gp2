<!-- functions.php -->

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function genererHeader()
{
    if (isset($_SESSION['email'])) {
        $json_data = file_get_contents('./data/users.json');
        $users = json_decode($json_data, true);

        if ($users !== null) {
            $email = $_SESSION['email'];
            $currentUser = null;
            foreach ($users as $user) {
                if ($user['email'] === $email) {
                    $currentUser = $user;
                    break;
                }
            }

            if ($currentUser !== null) {
                $prenom = htmlspecialchars($currentUser['prenom']);
                $nom = htmlspecialchars($currentUser['nom']);
                $adresse = htmlspecialchars($currentUser['adresse']);
                $telephone = htmlspecialchars($currentUser['telephone']);

                echo '<header class="jumbotron bg-white">';
                echo '<div class="container">';
                echo '<div class="row align-items-center">';
                echo '<div class="col-md-3"><img src="./images/img_avatar1.png" alt="Logo" class="img-fluid rounded-circle" width="150" height="150"></div>';
                echo '<div class="col-md-6"><h1 class="display-4">Site de Location de Voitures</h1></div>';
                echo '<div class="col-md-3 text-end">';
                echo '<h3 class="mb-0">Bienvenue, ' . $prenom . ' ' . $nom . '</h3>';
                echo '<a href="logout.php" class="btn btn-dark me-3">Se déconnecter</a>';
                echo '<button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">Mon Profil</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</header>';

                echo '
                    <div class="offcanvas offcanvas-start " id="demo">
                        <div class="offcanvas-header">
                            <h1 class="offcanvas-title">Profil</h1>
                        </div>
                        <div class="offcanvas-body">
                            <div class="container mt-5">
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <img src="./images/img_avatar1.png" alt="Logo" width="100" height="100" style="border-radius: 50%;">
                                    </div>
                                    <div class="col">
                                        <h1 class="mb-0">Bienvenue sur votre profil, ' . $prenom . ' ' . $nom . '</h1>
                                    </div>
                                </div>
                                <h2>Modifier votre profil</h2>
                                <form action="index.php" method="post">
                                    <div class="mb-3">
                                        <label for="prenom" class="form-label">Nouveau prénom :</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" value="' . $prenom . '" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nouveau nom :</label>
                                        <input type="text" class="form-control" id="nom" name="nom" value="' . $nom . '" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Nouvel email :</label>
                                        <input type="email" class="form-control" id="email" name="email" value="' . htmlspecialchars($email) . '" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Nouveau mot de passe (laissez vide pour ne pas changer) :</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Nouvelle adresse :</label>
                                        <input type="text" class="form-control" id="adresse" name="adresse" value="' . $adresse . '" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Nouveau numéro de téléphone :</label>
                                        <input type="text" class="form-control" id="telephone" name="telephone" value="' . $telephone . '" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                                    <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
                                </form>
                            </div>
                        </div>
                    </div>';
            } else {
                echo '<p>Utilisateur non trouvé.</p>';
            }
        } else {
            echo '<p>Erreur de lecture du fichier JSON.</p>';
        }
    }
}

function modifProfil()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['email'])) {
        return false; // Utilisateur non connecté, la fonction renvoie false
    }

    $email = $_SESSION['email'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
        $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
        $new_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $adresse = filter_var($_POST['adresse'], FILTER_SANITIZE_STRING);
        $telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_STRING);
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

        $json_data = file_get_contents('./data/users.json');
        $users = json_decode($json_data, true);

        foreach ($users as &$user) {
            if ($user['email'] === $email) {
                $user['prenom'] = $prenom;
                $user['nom'] = $nom;
                $user['email'] = $new_email ? $new_email : $user['email'];
                $user['adresse'] = $adresse;
                $user['telephone'] = $telephone;
                if ($password) {
                    $user['password'] = $password;
                }
                break;
            }
        }

        file_put_contents('./data/users.json', json_encode($users, JSON_PRETTY_PRINT));

        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $new_email ? $new_email : $email;
    }

    $json_data = file_get_contents('./data/users.json');
    $users = json_decode($json_data, true);

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $prenom = $user['prenom'];
            $nom = $user['nom'];
            $email = $user['email'];
            $adresse = $user['adresse'];
            $telephone = $user['telephone'];
            break;
        }
    }

    return true; // Utilisateur connecté, la fonction renvoie true
}

// Partie Navbar
function genererNavigation()
{
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white sticky-top">';
    echo '<a class="navbar-brand" href="index.php">';
    echo '<img src="./images/logo1.jpeg" alt="Logo" width="50" height="50" style="border-radius: 50%;">';

    echo '</a>';
    echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
    echo '<span class="navbar-toggler-icon"></span>';
    echo '</button>';

    echo '<div class="collapse navbar-collapse" id="navbarNav">';
    echo '<ul class="navbar-nav me-auto">';
    echo '<li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="proposer.php">Liste des voitures</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="rechercher.php">Chercher une voiture</a></li>';

    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        echo '<li class="nav-item"><a class="nav-link" href="administrer.php">Administrer</a></li>';
    }

    echo '<li class="nav-item"><a class="nav-link" href="infos.php">Infos</a></li>';
    echo '</ul>';
    echo '<form class="d-flex me-2">';
    echo '<input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Recherche">';
    echo '<button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>';
    echo '</form>';

    echo '</div>';
    echo '</nav>';
}


// Partie Login
function genererLogin()
{
    // Initialisation de la variable d'erreur
    $erreur_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $json_data = file_get_contents('./data/users.json');
            $users = json_decode($json_data, true);
            $email_saisi = $_POST['email'];
            $password_saisi = $_POST['password'];

            foreach ($users as $user) {
                if ($user['email'] === $email_saisi && $user['password'] === $password_saisi) {

                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];

                    if ($_SESSION['role'] === 'admin') {
                        header('Location: administrer.php');
                    }
                    if ($_SESSION['role'] === 'employe') {
                        header('Location: ../intra/index.php');
                    } else {
                        header('Location: index.php');
                    }
                    exit;
                }
            }
            $erreur_message = "Identifiants incorrects. Veuillez réessayer.";
        }
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    // Affichage du formulaire de connexion
    echo '<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
                <form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">email :</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe :</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Afficher le mot de passe</label>
                    </div>';

    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById("showPassword").addEventListener("change", function() {
                            var passwordInput = document.getElementById("password");
                            if (this.checked) {
                                passwordInput.type = "text";
                            } else {
                                passwordInput.type = "password";
                            }
                        });
                    });
                </script>';

    // Affichage du message d'erreur
    if (!empty($erreur_message)) {
        echo '<div class="alert alert-danger" role="alert">' . $erreur_message . '</div>';
    }

    echo '<button type="submit" class="btn btn-success w-100 mb-2">Se connecter</button>
                    <a href="index.php" class="btn btn-secondary w-100">Revenir à la page d\'accueil</a>
                </form>
            </div>
        </div>
    </div>
</div>';
}

function genererInscription()
{
    $error_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = $_POST['password'];
        $email = $_POST['email'];

        if (empty($password) || empty($email)) {
            $error_message = "Veuillez remplir tous les champs.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Adresse email invalide.";
        } else {
            $json_data = file_get_contents('./data/users.json');
            $users = json_decode($json_data, true);
            echo "ok";
            foreach ($users as $user) {
                if ($user['email'] === $email) {
                    $error_message = "Cet email est déjà utilisé.";
                    break;
                }
            }

            if (empty($error_message)) {
                $new_user = array(
                    'prenom' => $_POST['prenom'],
                    'nom' => $_POST['nom'],
                    'password' => $password,
                    'adresse' => $_POST['adresse'],
                    'email' => $email,
                    'telephone' => $_POST['telephone'],
                    'dob' => $_POST['dob'],
                    'role' => 'utilisateur'
                );
                $users[] = $new_user;

                file_put_contents('./data/users.json', json_encode($users, JSON_PRETTY_PRINT));

                // Redirection vers une page de confirmation
                header('Location: inscription_success.php');
                exit;
            }
        }
    }
}




// Partie en bas
function genererFooter()
{
    echo '<footer class="footer mt-auto py-3 bg-dark text-white">';
    echo '<div class="container-fluid">';

    // Partenaires
    echo '
    <div class="row pt-5 py-3">
    <div class="col-sm-4"><h3 class="display-6 text-center mb-3">Pour Info</h3></div>
    <div class="col-sm-4"><i><h1 class="text-center mb-3">Nos Partenaires</h1></i></div>
    <div class="col-sm-4"><h3 class="display-6 text-center mb-3">Voir plus</h3></div>
    </div>';

    echo '<div class="container">';
    echo '<div class="row justify-content-center">';

    // Première ligne de partenaires
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.peugeot.fr/"><img src="./images/Logo_partenariat/peugeot.png" alt="peugeot" class="img-fluid" style="width: 40%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.mercedes-benz.fr/"><img src="./images/Logo_partenariat/mercedes.png" alt="mercedes" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.bmw.fr/"><img src="./images/Logo_partenariat/bmw.png" alt="bmw" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.renault.fr/"><img src="./images/Logo_partenariat/renault.png" alt="Renault" class="img-fluid" style="width: 80%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.audi.fr/"><img src="./images/Logo_partenariat/audi.png" alt="Audi" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.toyota.fr/"><img src="./images/Logo_partenariat/toyota.png" alt="Toyota" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '</div>';

    // Deuxième ligne de partenaires
    echo '<div class="row justify-content-center py-5">';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.volkswagen.fr/"><img src="./images/Logo_partenariat/volkswagen.png" alt="Volkswagen" class="img-fluid" style="width: 70%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.opel.fr/"><img src="./images/Logo_partenariat/opel.png" alt="opel" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.citroen.fr/"><img src="./images/Logo_partenariat/citroen.png" alt="citroen" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.honda.fr/"><img src="./images/Logo_partenariat/honda.png" alt="honda" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.nissan.fr/"><img src="./images/Logo_partenariat/nissan.png" alt="nissan" class="img-fluid" style="width: 40%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.tesla.com/"><img src="./images/Logo_partenariat/tesla.png" alt="tesla" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    // À propos
    echo '<div class="row p-5">';
    echo '<div class="col-md-5">';
    echo '<h5>À propos de Vroumvroumloc</h5>';
    echo '<p>Location de véhicules pour tous vos déplacements.</p>';
    echo '<p class="mb-0">&copy; ' . date("Y") . ' Vroumvroumloc - Tous droits réservés</p>';
    echo '</div>';

    // Contact
    echo '<div class="col-md-4">';
    echo '<h5>Contact</h5>';
    echo '<ul class="list-unstyled">';
    echo '<li><i class="fas fa-map-marker-alt"></i> 123 Rue Principale, Ville, Pays</li>';
    echo '<li><i class="fas fa-phone"></i> +123 456 7890</li>';
    echo '<li><i class="fas fa-envelope"></i> info@vroumvroumloc.com</li>';
    echo '</ul>';
    echo '</div>';

    // Réseaux sociaux
    echo '<div class="col-md-3">';
    echo '<h5>Restons en contact</h5>';
    echo '<ul class="list-unstyled">';
    echo '<li><i class="fab fa-facebook"></i> <span class="ms-2">Facebook</span></li>';
    echo '<li><i class="fab fa-twitter"></i> <span class="ms-2">Twitter</span></li>';
    echo '<li><i class="fab fa-instagram"></i> <span class="ms-2">Instagram</span></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</footer>';
}





function administrer()
{
    $json_data = file_get_contents('./data/users.json');
    $users = json_decode($json_data, true);

    if (isset($_POST['search'])) {
        $search_term = $_POST['search'];
        $filtered_users = array_filter($users, function ($user) use ($search_term) {
            return stripos($user['utilisateur'], $search_term) !== false;
        });
    } else {
        $filtered_users = $users;
    }

    if (isset($_POST['action'])) {
        $user_id = $_POST['user_id'];
        $action = $_POST['action'];

        if ($action == 'modifier_role' && isset($_POST['nouveau_role'])) {
            $new_role = $_POST['nouveau_role'];
            $users[$user_id]['role'] = $new_role;
        }

        if ($action == 'supprimer_utilisateur') {
            unset($users[$user_id]);
        }

        file_put_contents('./data/users.json', json_encode($users, JSON_PRETTY_PRINT));

        header('Location: administrer.php');
        exit;
    }

    foreach ($filtered_users as $key => $user): ?>
        <tr>
            <td>
                <?php echo $user['prenom'] . ' ' . $user['nom']; ?>
            </td>
            <td>
                <?php echo $user['email']; ?>
            </td>
            <td>
                <?php echo $user['role']; ?>
            </td>
            <td>
                <form method="post" class="d-inline">
                    <input type="hidden" name="user_id" value="<?php echo $key; ?>">
                    <input type="hidden" name="action" value="modifier_role">
                    <select name="nouveau_role" class="form-select d-inline me-2">
                        <option value="admin">Administrateur</option>
                        <option value="utilisateur">Utilisateur</option>
                        <option value="employe">Employe</option>
                        <option value="visitor">Visiteur</option>
                    </select>
                    <button type="submit" class="btn btn-outline-info"><i class="fas fa-edit me-1"></i>Modifier</button>
                </form>
                <form method="post" class="d-inline"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                    <input type="hidden" name="user_id" value="<?php echo $key; ?>">
                    <input type="hidden" name="action" value="supprimer_utilisateur">
                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt me-1"></i>Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach;
}

?>