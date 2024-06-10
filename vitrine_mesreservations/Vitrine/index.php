<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location de véhicules - Vroumvroumloc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="./data/styles.css">
</head>

<body>

    <?php
    session_start();
    include 'functions.php';

    // Appeler la fonction pour traiter les modifications de profil si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        modifProfil();
    }

    genererHeader();
    ?>

    <header class="bg-dark py-4 text-white">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-md-3 text-center text-md-start">
                    <img src="./images/logo1.jpeg" alt="Logo" class="rounded-circle"
                        style="width: 150px; height: 150px;">
                    <h3 class="mt-3">Vroumvroumloc de Saint-Malo</h3>
                </div>
                <div class="col-md-8 text-center text-md-start">
                    <h1 class="display-1">Bienvenue chez Vroumvroumloc!</h1>
                    <p class="lead">Louez des véhicules pour tous vos déplacements.</p>
                    <?php genererLogin(); ?>
                    <?php if (isset($_SESSION['email'])): ?>
                        <a href="mes_reservations.php" class="btn btn-lg btn-primary rounded-pill">Mes réservations</a>
                        <a href="proposer.php" class="btn btn-lg btn-primary rounded-pill">Réserver un véhicule</a>
                        <a href="ajout_annonce.php" class="btn btn-lg btn-primary rounded-pill">Ajouter une annonce</a>

                    <?php else: ?>
                        <p class="mt-3">Connectez-vous pour réserver un véhicule.</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-1 text-center text-md-start">
                    <!-- Ajout du bouton de menu -->
                    <button class="btn btn-outline-light">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="theme" onclick="toggleTheme()">
        <!-- Menu déroulant -->
        <div class="offcanvas offcanvas-end bg-light text-light" id="barre">
            <div class="container-fluid bg-dark text-dark py-2">
                <div class="container">
                    <ul class="nav flex-column">
                        <!-- Afficher les éléments du menu en fonction de l'état de connexion -->
                        <?php if (isset($_SESSION['email'])): ?>
                            <li class="nav-item">
                                <a href="profil.php" class="btn btn-outline-light w-100 mb-2">
                                    <i class="fas fa-user fa-lg me-2"></i> Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="proposer.php" class="btn btn-outline-light w-100 mb-2">
                                    <i class="fas fa-car fa-lg me-2"></i> Liste des voitures
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="rechercher.php" class="btn btn-outline-light w-100 mb-2">
                                    <i class="fas fa-search fa-lg me-2"></i> Chercher une voiture
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="infos.php" class="btn btn-outline-light w-100 mb-2">
                                    <i class="fas fa-info-circle fa-lg me-2"></i> Infos
                                </a>
                            </li>
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                                <li class="nav-item">
                                    <a href="administrer.php" class="btn btn-outline-light w-100 mb-2">
                                        <i class="fas fa-cogs fa-lg me-2"></i> Administrer
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="index.php" class="btn btn-outline-light w-100 mb-2">
                                    <i class="fas fa-home fa-lg me-2"></i> Accueil
                                </a>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="btn btn-outline-light w-100 mb-2" data-bs-toggle="modal"
                                    data-bs-target="#myModal"><i class="fas fa-sign-in-alt fa-lg me-2"></i>Se
                                    connecter</button>
                            </li>
                            <li class="nav-item">
                                <a href="inscription.php" class="btn btn-outline-light w-100 mb-2">
                                    <i class="fas fa-user-plus fa-lg me-2"></i> S'inscrire
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>



        <div class="container-fluid bg-light p-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marker-alt fa-3x text-dark mb-3"></i>
                                <h5 class="card-title">Large choix de véhicules</h5>
                                <p class="card-text">Trouvez le véhicule qui correspond le mieux à vos besoins parmi
                                    notre
                                    large sélection.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <i class="fas fa-dollar-sign fa-3x text-dark mb-3"></i>
                                <h5 class="card-title">Tarifs abordables</h5>
                                <p class="card-text">Profitez de nos tarifs compétitifs pour louer un véhicule sans vous
                                    ruiner.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-3x text-dark mb-3"></i>
                                <h5 class="card-title">Réservation facile</h5>
                                <p class="card-text">Réservez votre véhicule en quelques clics et partez sereinement
                                    pour
                                    vos trajets.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php genererNavigation(); ?>

        <!-- Carousel -->
        <div class="container-fluid p-5 bg-dark text-white text-center">
            <div id="demo" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./images/voiture9.jpg" alt="Los Angeles" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>BMW F32</h3>
                            <p>Profitez d'une expérience unique!</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./images/Voiture5.jpg" alt="Peugot" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Peugot E-3008</h3>
                            <p>Apprenez à connaître Peugot</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./images/voiture8.jpg" alt="Tesla" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Tesla modèle 3</h3>
                            <p>Un choix digne pour vous!</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./images/Voiture6.jpg" alt="Peugot" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Peugot 208 Hybride</h3>
                            <p>Un choix digne pour vous!</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./images/Voiture7.jpg" alt="Peugot" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Peugot</h3>
                            <p>Voyager à pleusieurs!</p>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>


        <!-- Qui sommes-nous? : présentation de l’entreprise (dirigeants, membres principaux de l’équipe) -->
        <div class="container p-5 my-5 bg-dark text-white text-center">
            <h2 class="display-4">Qui sommes-nous?</h2>
            <p class="lead">Vroumvroumloc est une entreprise de location de véhicules basée à Saint-Malo, en France.
                Notre
                équipe est dévouée à offrir à nos clients une expérience de location de voiture sans soucis, à des
                tarifs
                compétitifs et avec une large sélection de véhicules.</p>

            <h3 class="mt-5">Dirigeants</h3>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user-tie"></i> <strong>Solaymane
                                    EL-KALDAOUI</strong>
                            </h5>
                            <p class="card-text"><strong><i>Fondateur et PDG de Vroumvroumloc.</i></strong> Il a plus de
                                20 ans d'expérience
                                dans
                                l'industrie de la location de véhicules et est dévoué à offrir des services de qualité à
                                nos
                                clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user-tie"></i> <strong>Haziz SHEHU</strong>
                            </h5>
                            <p class="card-text"><strong><i>Directeur des opérations.</i></strong> Il est responsable de
                                la gestion quotidienne
                                de
                                l'entreprise et s'assure que nos opérations sont rapide et efficaces.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="mt-5">Membres principaux de l'équipe</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user"></i> <strong>Clement LEROUX</strong></h5>
                            <p class="card-text"><strong><i>Responsable du service client.</i></strong> Il est
                                responsable de gérer les demandes
                                et
                                les plaintes de nos clients et de s'assurer qu'ils sont satisfaits de nos services.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user"></i> <strong>Hugo RICHARD</strong></h5>
                            <p class="card-text"><strong><i>Responsable de la flotte de véhicules.</i></strong> Il est
                                responsable de la gestion
                                de
                                notre flotte de véhicules et de s'assurer que nos véhicules sont en bon état et
                                disponibles
                                pour nos clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user"></i> <strong>Lucas GILBERT</strong></h5>
                            <p class="card-text"><strong><i>Responsable du marketing.</i></strong> Il est responsable de
                                la promotion de nos
                                services et de l'attraction de nouveaux clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user"></i> <strong>Rhami ATHOUMANI</strong></h5>
                            <p class="card-text"><strong><i>Responsable des partenariats.</i></strong> Il
                                est
                                chargé d'établir et de gérer des partenariats stratégiques avec d'autres entreprises
                                pour renforcer notre position sur le marché.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Ellements supplementaires -->
    <div class="container-fluid p-5 bg-white text-center">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Notre entreprise</h5>
                        <p class="card-text">Notre entreprise est particulièrement située à Saint-Malo, mais nous
                            sommes également présents dans de nombreuses autres régions en France. Avec notre large
                            sélection de véhicules, des tarifs compétitifs et une réservation facile, nous nous
                            efforçons de rendre vos déplacements aussi agréables que possible.</p>
                    </div>
                    <div class="col-md-12 order-first order-md-last">
                        <div id="mapid" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width:400px">
                    <div class="card-body">
                        <img class="card-img-top" src="./images/Voiture2.jpg" alt="Card image">
                        <h5 class="card-title">Offres Spéciales</h5>
                        <div class="alert alert-warning" role="alert">
                            Réservez dès maintenant et bénéficiez d'une réduction de 10% sur votre prochaine
                            location !
                        </div>
                        <a href="proposer.php" class="btn btn-dark">Voir les offres</a>
                        <div class="col mt-3    ">
                            <img class="card-img-top" src="./images/Voiture1.jpg" alt="Card image">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Besoin d'aide ?</h5>
                        <p class="card-text">Notre équipe est disponible 24/7 pour répondre à toutes vos questions
                            et
                            vous aider dans votre réservation.</p>
                        <a href="#" class="btn btn-dark">Contactez-nous</a>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h2>La location de voiture pas chère avec Vroumvroumloc</h2>
                        <p>Le seul site français dédié à la location de voitures avec une équipe basée à paris et
                            disponible
                            7 jours/7</p>
                        <p>Vous avez besoin d’un véhicule pour un déplacement professionnel ? Pour partir en
                            vacances ou
                            pour quelques jours ? Et si vous optiez pour la location de voiture ? Pratique et
                            accessible
                            à
                            tous, cette solution vous permet de profiter d’une auto adaptée à votre trajet et à un
                            prix
                            pas
                            cher !</p>
                        <p>Vous choisissez la durée de la réservation, le modèle et grâce à notre moteur en ligne,
                            vous
                            pouvez comparer les offres des plus grands loueurs professionnels et ainsi, trouver le
                            meilleur
                            tarif. Simple et rapide d’utilisation, vous profitez de locations de voiture en France
                            pas
                            chères, en Europe et dans le monde entier.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Histoire de Vroumvroumloc -->
    <div class="container-fluid p-5 bg-white text-center">
        <h1 text-center>Histoire de notre entreprise</h1>
    </div>
    <section style="background-color: #F0F2F5;">
        <div class="container py-5">
            <div class="main-timeline">
                <!-- Timeline items -->
                <div class="timeline left">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3>2020</h3>
                            <p class="mb-0">Développement international. Vroumvroumloc a commencé son expansion à
                                l'international, établissant des partenariats stratégiques dans plusieurs pays
                                européens.</p>
                            <p class="mb-0">Acquisition de nouvelles technologies. Pour améliorer l'expérience
                                client et
                                optimiser ses opérations, Vroumvroumloc a investi dans de nouvelles technologies de
                                gestion de flotte et de réservation en ligne.</p>
                        </div>
                    </div>
                </div>
                <div class="timeline right">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3>2010</h3>
                            <p class="mb-0">Acquisition d'entreprises concurrentes. Vroumvroumloc a élargi sa
                                présence
                                sur le marché en acquérant plusieurs entreprises concurrentes, renforçant ainsi sa
                                position.</p>
                            <p class="mb-0">Introduction de nouvelles catégories de véhicules. Pour répondre à la
                                demande croissante de ses clients, Vroumvroumloc a introduit de nouvelles catégories
                                de
                                véhicules, notamment des véhicules électriques et des véhicules de luxe.</p>
                        </div>
                    </div>
                </div>
                <div class="timeline left">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3>2005</h3>
                            <p class="mb-0">Expansion nationale. Vroumvroumloc a étendu ses opérations dans toute la
                                France, ouvrant de nouveaux sites dans des grandes villes telles que Paris, Lyon et
                                Marseille.</p>
                            <p class="mb-0">Lancement du programme de fidélité. Pour récompenser ses clients les
                                plus
                                fidèles et encourager la rétention, Vroumvroumloc a lancé son programme de fidélité
                                offrant des remises et des avantages exclusifs.</p>
                        </div>
                    </div>
                </div>
                <div class="timeline right">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3>2000</h3>
                            <p class="mb-0">Fondation de Vroumvroumloc. L'entreprise a été fondée en 2000 par un Un
                                groupe d'élèves en BUT R&T à l'IUT de Saint-Malo et a commencé ses activités avec
                                seulement quelques véhicules dans la
                                région
                                de Saint-Malo.</p>
                            <p class="mb-0">Expansion régionale. Vroumvroumloc a connu une croissance rapide dans sa
                                première décennie, étendant ses services à toute la Bretagne et devenant un acteur
                                majeur de la location de véhicules dans la région.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php genererFooter(); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var menuBtn = document.querySelector('.btn-outline-light');
            var menu = document.getElementById('barre');

            menuBtn.addEventListener('click', function (event) {
                event.stopPropagation();
                menu.classList.toggle('show');
            });


            document.addEventListener('click', function (event) {
                if (!menu.contains(event.target) && event.target !== menuBtn) {
                    menu.classList.remove('show');
                }
            });
        });
    </script>


    <script>
        var mymap = L.map('mapid').setView([46.603354, 1.888334], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

        // Marqueurs pour différentes villes
        var cities = [
            { name: 'Paris', coordinates: [48.8566, 2.3522] },
            { name: 'Rennes', coordinates: [48.1173, -1.6778] },
            { name: 'Caen', coordinates: [49.1829, -0.3707] },
            { name: 'Nantes', coordinates: [47.2184, -1.5536] },
            { name: 'Toulouse', coordinates: [43.6047, 1.4442] },
            { name: 'Bordeaux', coordinates: [44.8378, -0.5792] },
            { name: 'Lyon', coordinates: [45.7578, 4.832] },
            { name: 'Rouen', coordinates: [49.4431, 1.0993] },
            { name: 'Lille', coordinates: [50.6292, 3.0573] },
            { name: 'Marseille', coordinates: [43.2965, 5.3698] },
            { name: 'Nice', coordinates: [43.7102, 7.262] },
            { name: 'Saint-Malo', coordinates: [48.6495, -2.0254] }
        ];

        cities.forEach(function (city) {
            L.marker(city.coordinates).addTo(mymap)
                .bindPopup("<b>" + city.name + "</b><br />" + "Bienvenue à " + city.name + "!");
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
========
<?php 
header('Location: SAE_203/index.php');
exit;
?>
>>>>>>>> main:index.php
