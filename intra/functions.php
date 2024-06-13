<!-- functions.php -->
<?php
//functions.php

// Partie Entete
function genererHeader()
{
    if (isset($_SESSION['email'])) {
        $json_data = file_get_contents('./data/utilisateurs.json');
        $users = json_decode($json_data, true);

        if ($users !== null) {
            $email = $_SESSION['idUtilisateur'];
            $currentUser = null;
            foreach ($users as $user) {
                if ($user['email'] == $email) {
                    $currentUser = $user;
                    break;
                }
            
            }
        
        } else {
            echo '<p>Erreur de lecture du fichier JSON.</p>';
        }
    }
}



// Partie Navbar
function genererNavigation()
{
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white sticky-top">';
    echo '<a class="navbar-brand" href="../Vitrine/index.php">';
    echo '<img src="../Vitrine/images/logo1.jpeg" alt="Logo" width="50" height="50" style="border-radius: 50%;">';

    echo '</a>';
    echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
    echo '<span class="navbar-toggler-icon"></span>';
    echo '</button>';

    echo '<div class="collapse navbar-collapse" id="navbarNav">';
    echo '<ul class="navbar-nav me-auto">';
    
    echo "<div><p>Bienvenue sur l'intranet de <b>VroumVroumLoc</b> ".$_SESSION["email"]."</p></div>";
    echo '<a href="../Vitrine/logout.php" class="btn btn-light ml-5 me-3">Se déconnecter</a>';
    echo '<a href="partenaire.php" class="btn btn-light ml-5 me-3">Partenaires</a>';
    echo '<a href="salarié.php" class="btn btn-light ml-5 me-3">Salariés</a>';
    echo '<a href="clients.php" class="btn btn-light ml-5 me-3">Clients</a>';

    echo '</div>';
    echo '</nav>';
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
    echo '</div>'; // fin de la première ligne de partenaires

    // Deuxième ligne de partenaires
    echo '<div class="row justify-content-center py-5">';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.volkswagen.fr/"><img src="./images/Logo_partenariat/volkswagen.png" alt="Volkswagen" class="img-fluid" style="width: 70%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.opel.fr/"><img src="./images/Logo_partenariat/Opel.png" alt="opel" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.citroen.fr/"><img src="./images/Logo_partenariat/citroen.png" alt="citroen" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.honda.fr/"><img src="./images/Logo_partenariat/Honda.png" alt="honda" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.nissan.fr/"><img src="./images/Logo_partenariat/Nissan.png" alt="nissan" class="img-fluid" style="width: 40%;"></a>';
    echo '</div>';
    echo '<div class="col-md-2 text-center mb-3">';
    echo '<a href="https://www.tesla.com/"><img src="./images/Logo_partenariat/Tesla.png" alt="tesla" class="img-fluid" style="width: 50%;"></a>';
    echo '</div>';
    echo '</div>'; // fin de la deuxième ligne de partenaires

    echo '</div>'; // fin de la section des partenaires

    // À propos
    echo '<div class="row p-5">';

    echo '<div class="col-md-5">';
    echo '<h5>À propos de Vroumvroumloc</h5>';
    echo '<p>Location de véhicules pour tous vos déplacements.</p>';
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

    echo '</div>'; // fin de la section À propos, Contact, Réseaux sociaux
    echo '</div>'; // fin de la div container

    // Droits d'auteur
    echo '<div class="copyright bg-dark text-white text-center py-2">';
    echo '<div class="container">';
    echo '<p class="mb-0">&copy; ' . date("Y") . ' Vroumvroumloc - Tous droits réservés</p>';
    echo '</div>';
    echo '</div>'; // fin de la section droits d'auteur

    echo '</footer>'; // fin du footer
}




?>