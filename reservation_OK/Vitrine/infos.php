<?php

/*
----------------Premiere Etape-----------------------
La premiere etape consistait a soivr repartir, tout en organisant les fichier  dans leurs repertoires:
/ ---> les fichiers php
/data ---> les fichiers json
/img --> les images
/js  --> les fichiers javascript


----------------Deuxième Etape-----------------------
La deuxième étape consistait a soivr structurer les pages tout en respectant les étapes demandées dans ce TP.
Pour commencer, j'ai essayé de lire tout le TP pour voir ce qui est attendu et comment faire pour repartir.
Ensuite, j'ai essayé de suivre les étapes une par une comme demandé dans le TP.
Il y avait des moments où je n'arrivais pas trop avancer car j'avais des problèmes avec mon code et c'est pour cela que j'ai passé à la suite et je comptais revenir une fois que j'ai repris le rythme.
C'est pourquoi je n'ai pas suivi les structures demandées dans le TP à la lettre mais j'ai essayé de trouver une solution logique pour chaque problème que j'ai eu durant ce TP.
J'ai commencé par créer la page d'accueil (index.php) puis je me suis attardé sur la page "functions.php" qui contient toutes les fonctions.

------------------Les Sources-------------------------
pour PHP : http://php.net/manual/fr/
pour HTML et CSS : http://www.w3schools.com/
pour JS : https://www.w3schools.com/js/
pour Bootstrap : https://getbootstrap.com/docs/5.3/getting-started/introduction/
pour Ajax : https://www.w3schools.com/js/js_ajax_intro.asp
pour valider le code : https://validator.w3.org/

J'ai essayé d'utiliser des sources sur internet, notamment ceux qui étaient mentionnés dans le TP mais aussi d'autres sources/exemples que j'ai trouvés sur internet.
J'ai effectué ce TP sur mon PC personnel donc il fallait un serveur et pour cela j'ai regardé des vidéos sur YouTube comment faire. 
D'ailleurs, ce sont les mêmes vidéos que j'ai utilisées pour apprendre quelques notions sur PHP.


------------------Fin Séance 1-----------------------
J'ai essayé de commenter aussi quelques lignes sur des parties de code (surtout dans les parties que j'ai eu du mal à comprendre).
J'ai essayé de finir la partie 1 au bout de la première séance du TP mais  je n'y suis pas arrivé car il y avait beaucoup d'informations à comprendre et à revoir.
Mais cela ne m'a pas empêché d'avancer  vers la suite du TP et comme j'utilisais mon PC portable, j'ai essayé d'avancer encore plus en dehors des cours.
Au début et à la fin de la séance, j'enregistre mes fichiers dans le répertoire demandé et j'ai fait aussi une copie du dossier qui contient toutes les fichiers dans un autre endroit au cas où je perds mes documents.



echo '<a href="calendar.php?id " class="btn btn-outline-info me-2">Réserver</a>';
echo '<a href="calendar.php?id " class="btn btn-outline-danger">Supprimer</a>';
*/

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations sur le projet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

    <?php include ('functions.php'); ?>
    <?php genererNavigation(); ?>

    <div class="container mt-5 bg-dark">
        <h1 class="mb-4 text-white">Informations sur le projet</h1>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Organisation des fichiers</h2>
                        <p class="card-text">Les fichiers du projet sont organisés de manière structurée pour une
                            meilleure gestion :</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Les fichiers PHP sont placés à la racine du projet ("/")</li>
                            <li class="list-group-item">Les données sont stockées dans des fichiers JSON situés dans le
                                répertoire "/data"</li>
                            <li class="list-group-item">Les images utilisées sont stockées dans le répertoire "/img"
                            </li>
                            <li class="list-group-item">Les scripts JavaScript sont regroupés dans le répertoire "/js"
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Structuration des pages</h2>
                        <p class="card-text">Chaque page du projet est conçue de manière à suivre une structure claire
                            et logique :</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Une navigation fluide est assurée entre les différentes pages du
                                site</li>
                            <li class="list-group-item">Les fonctionnalités et les contenus sont organisés de manière
                                ergonomique pour une meilleure expérience utilisateur</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Sources consultées</h2>
                        <p class="card-text">Les ressources suivantes ont été consultées et utilisées pour le
                            développement du projet :</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Documentation officielle de PHP : <a
                                    href="http://php.net/manual/fr/">php.net</a></li>
                            <li class="list-group-item">Tutoriels HTML et CSS sur W3Schools : <a
                                    href="http://www.w3schools.com/">w3schools.com</a></li>
                            <li class="list-group-item">Tutoriels JavaScript sur W3Schools : <a
                                    href="https://www.w3schools.com/js/">w3schools.com</a></li>
                            <li class="list-group-item">Documentation Bootstrap : <a
                                    href="https://getbootstrap.com/docs/5.3/getting-started/introduction/">getbootstrap.com</a>
                            </li>
                            <li class="list-group-item">Validateur de code HTML : <a
                                    href="https://validator.w3.org/">validator.w3.org</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Expérience et apprentissage</h2>
                        <p class="card-text">Ce projet a été une opportunité précieuse pour acquérir de nouvelles
                            compétences et approfondir mes connaissances en développement web :</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Apprentissage de la programmation côté serveur avec PHP</li>
                            <li class="list-group-item">Utilisation avancée de Bootstrap pour la conception d'interfaces
                                utilisateur modernes</li>
                            <li class="list-group-item">Pratique de la manipulation des données avec JSON et PHP</li>
                            <li class="list-group-item">Renforcement des compétences en HTML, CSS et JavaScript</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Gestion des sessions</h2>
                        <p class="card-text">Les sessions PHP sont utilisées pour gérer l'authentification des
                            utilisateurs. Lorsqu'un utilisateur se connecte, une session est démarrée en appelant la
                            fonction <code>session_start()</code>. Cette fonction initialise ou restaure une
                            session, et permet de stocker des données de session pour cet utilisateur.</p>
                        <p class="card-text">Une fois qu'une session est démarrée, les informations de l'utilisateur
                            peuvent être stockées dans la variable <code>$_SESSION</code>. Cela permet de maintenir
                            l'état de l'utilisateur entre les différentes requêtes HTTP, ce qui est essentiel pour
                            gérer l'authentification et l'autorisation sur un site web.</p>
                        <p class="card-text">Les données stockées dans la variable <code>$_SESSION</code> restent
                            disponibles jusqu'à ce que la session expire ou que l'utilisateur se déconnecte
                            explicitement. Ces données peuvent être utilisées pour vérifier l'identité de
                            l'utilisateur et lui accorder l'accès aux pages protégées.</p>
                        <p class="card-text">Il est important de sécuriser les sessions en utilisant des pratiques
                            recommandées telles que l'utilisation de cookies sécurisés, le stockage des identifiants
                            de session dans des cookies HTTPOnly, et la gestion appropriée des droits d'accès aux
                            ressources protégées.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Authentification utilisateur</h2>
                        <p class="card-text">Un formulaire de connexion permet aux utilisateurs de saisir leurs
                            identifiants. Les informations sont ensuite vérifiées et validées côté serveur avant de
                            permettre l'accès aux pages protégées.</p>
                        <!-- Pour la page connexion.php -->
                        <h2>Page connexion.php :</h2>
                        <ul>
                            <li>Fonctions utilisées :
                                <ul>
                                    <li>genererNavigation()</li>
                                    <li>htmlspecialchars()</li>
                                    <li>password_verify()</li>
                                    <li>session_start()</li>
                                </ul>
                            </li>
                            <li>Fonctionnement :
                                <ul>
                                    <li>Les utilisateurs saisissent leurs identifiants dans un formulaire de connexion.
                                    </li>
                                    <li>Les informations sont vérifiées côté serveur et, si valides, une session est
                                        démarrée pour l'utilisateur.</li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Pages protégées</h2>
                        <p class="card-text">Certaines pages sont accessibles uniquement aux utilisateurs connectés. Si
                            un utilisateur non authentifié tente d'accéder à ces pages, il est redirigé vers la page de
                            connexion.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Déconnexion utilisateur</h2>
                        <p class="card-text">Les utilisateurs peuvent se déconnecter en cliquant sur un lien ou un
                            bouton de déconnexion. Cela entraîne la destruction de la session en cours et la redirection
                            vers la page de connexion.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page d'accueil</h2>
                        <p class="card-text">La page d'accueil est la première page à laquelle les utilisateurs accèdent
                            lorsqu'ils visitent votre site. Elle fournit généralement un aperçu du contenu et des
                            fonctionnalités du site.</p>
                        <!-- Pour la page connexion.php -->
                        <h2>Page connexion.php :</h2>
                        <ul>
                            <li>Fonctions utilisées :
                                <ul>
                                    <li>genererNavigation()</li>
                                    <li>htmlspecialchars()</li>
                                    <li>password_verify()</li>
                                    <li>session_start()</li>
                                </ul>
                            </li>
                            <li>Fonctionnement :
                                <ul>
                                    <li>Les utilisateurs saisissent leurs identifiants dans un formulaire de connexion.
                                    </li>
                                    <li>Les informations sont vérifiées côté serveur et, si valides, une session est
                                        démarrée pour l'utilisateur.</li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page d'inscription</h2>
                        <p class="card-text">La page d'inscription permet aux utilisateurs de créer un compte sur votre
                            site. Elle comprend généralement un formulaire où les utilisateurs peuvent saisir leurs
                            informations personnelles telles que leur nom d'utilisateur, leur mot de passe et leur
                            adresse e-mail.</p>
                        <!-- Pour la page inscription.php -->
                        <h2>Page inscription.php :</h2>
                        <ul>
                            <li>Fonctions utilisées :
                                <ul>
                                    <li>genererNavigation()</li>
                                    <li>htmlspecialchars()</li>
                                    <li>password_hash()</li>
                                    <li>file_put_contents()</li>
                                </ul>
                            </li>
                            <li>Fonctionnement :
                                <ul>
                                    <li>Les utilisateurs saisissent leurs informations dans un formulaire d'inscription.
                                    </li>
                                    <li>Les données sont validées côté serveur, hachées pour le stockage sécurisé, puis
                                        enregistrées dans un fichier JSON.</li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Inscription réussie</h2>
                        <p class="card-text">La page d'inscription réussie est affichée après que l'utilisateur a créé
                            avec succès un compte sur votre site. Elle confirme à l'utilisateur que son inscription a
                            été effectuée avec succès et lui fournit des instructions sur la prochaine étape, comme se
                            connecter à son nouveau compte.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page de profil utilisateur</h2>
                        <p class="card-text">La page de profil utilisateur affiche les informations personnelles d'un
                            utilisateur connecté, telles que son nom d'utilisateur, son adresse e-mail et d'autres
                            détails. Elle permet également à l'utilisateur de modifier ses informations si nécessaire.
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page d'ajout d'annonces</h2>
                        <p class="card-text">Cette page permet aux utilisateurs de publier de nouvelles annonces de
                            covoiturage. Un formulaire est fourni pour que les utilisateurs saisissent les détails de
                            leur annonce, tels que la date de départ, la ville de départ, la ville d'arrivée, etc.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page de consultation des annonces</h2>
                        <p class="card-text">Cette page affiche la liste des annonces de covoiturage disponibles. Les
                            utilisateurs peuvent consulter les détails des annonces et prendre des actions telles que la
                            réservation, la modification ou la suppression d'une annonce.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page de modification d'annonce</h2>
                        <p class="card-text">Sur cette page, les utilisateurs peuvent modifier les détails d'une annonce
                            existante. Un formulaire pré-rempli affiche les informations actuelles de l'annonce, et les
                            utilisateurs peuvent les mettre à jour selon leurs besoins.</p>
                        <!-- Pour la page modifier.php -->
                        <h2>Page modifier.php :</h2>
                        <ul>
                            <li>Fonctions utilisées :
                                <ul>
                                    <li>file_get_contents()</li>
                                    <li>json_decode()</li>
                                    <li>file_put_contents()</li>
                                </ul>
                            </li>
                            <li>Fonctionnement :
                                <ul>
                                    <li>Charge les annonces existantes à partir du fichier JSON.</li>
                                    <li>Affiche un formulaire pré-rempli pour permettre aux utilisateurs de modifier les
                                        détails d'une annonce sélectionnée.</li>
                                    <li>Les modifications sont enregistrées dans le fichier JSON après validation côté
                                        serveur.</li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page du calendrier des covoiturages</h2>
                        <p class="card-text">Cette page affiche un calendrier interactif des covoiturages disponibles.
                            Les utilisateurs peuvent voir les dates et les détails des covoiturages et sélectionner ceux
                            qui correspondent à leurs besoins.</p>
                        <!-- Pour la page calendar.php -->
                        <h2>Page calendar.php :</h2>
                        <ul>
                            <li>Fonctions utilisées :
                                <ul>
                                    <li>genererNavigation()</li>
                                </ul>
                            </li>
                            <li>Fonctionnement :
                                <ul>
                                    <li>Utilise la librairie FullCalendar pour afficher un calendrier interactif des
                                        covoiturages disponibles.</li>
                                    <li>Les covoiturages sont représentés par des événements avec des détails tels que
                                        le titre et la date.</li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page de recherche</h2>
                        <p class="card-text">Cette page permet aux utilisateurs de rechercher des annonces de
                            covoiturage en fonction de différents critères tels que la date, la ville de départ, la
                            ville d'arrivée, etc.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page de réservation</h2>
                        <p class="card-text">Sur cette page, les utilisateurs peuvent réserver des places pour un
                            covoiturage spécifique en indiquant le nombre de places souhaitées et en fournissant leurs
                            informations de contact.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page de connexion</h2>
                        <p class="card-text">La page de connexion permet aux utilisateurs de se connecter à leur compte
                            en saisissant leur nom d'utilisateur et leur mot de passe.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page de déconnexion</h2>
                        <p class="card-text">Sur cette page, les utilisateurs peuvent se déconnecter de leur compte, ce
                            qui entraîne la destruction de leur session actuelle.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page des informations et commentaires</h2>
                        <p class="card-text">Cette page fournit des informations détaillées sur chaque page du site,
                            ainsi que des commentaires sur leur fonctionnement et leur utilisation.</p>
                        <!-- Pour la page infos.php -->
                        <h2>Page infos.php :</h2>
                        <ul>
                            <li>Fonctions utilisées :
                                <ul>
                                    <li>genererNavigation()</li>
                                </ul>
                            </li>
                            <li>Fonctionnement :
                                <ul>
                                    <li>Fournit des informations détaillées sur chaque page du site, y compris les
                                        fonctions utilisées et leur rôle spécifique.</li>
                                    <li>Explique le fonctionnement de chaque page et de ses fonctionnalités.</li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- Pour la page de traitement des formulaires -->
                        <h2 class="card-title">Page de traitement des formulaires :</h2>
                        <p class="card-text">Cette page joue un rôle crucial dans la gestion des interactions
                            utilisateur avec votre site web. Voici quelques points supplémentaires à considérer :</p>
                        <ul>
                            <li>Validation des formulaires : Le code PHP présent sur cette page est responsable de la
                                validation des données saisies par les utilisateurs via les formulaires. Cela inclut la
                                vérification des champs requis, la validation des adresses e-mail, la vérification des
                                formats de date, etc. Une fois la validation effectuée, les données peuvent être
                                enregistrées dans la base de données ou des erreurs peuvent être renvoyées à
                                l'utilisateur si les données sont invalides.</li>
                            <li>Sécurité : Lors du traitement des formulaires, il est essentiel d'implémenter des
                                mesures de sécurité telles que la protection contre les injections SQL, la désactivation
                                de l'exécution du code PHP dans les champs de texte, et la validation des données pour
                                prévenir les attaques XSS.</li>
                            <li>Gestion des erreurs : En cas d'erreur lors du traitement des formulaires, il est
                                important de fournir des messages d'erreur clairs et informatifs à l'utilisateur, lui
                                indiquant ce qui n'a pas fonctionné et comment résoudre le problème. Cela améliore
                                l'expérience utilisateur en réduisant la frustration et en facilitant la correction des
                                erreurs.</li>

                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Page des fonctions</h2>
                        <ul>
                            <li>Fonctions utilisées :
                                <ul>
                                    <li>genererNavigation() : Cette fonction génère la barre de navigation du site,
                                        permettant aux utilisateurs de naviguer entre les différentes pages.</li>
                                    <li>file_get_contents() : Utilisée pour lire le contenu d'un fichier, par exemple
                                        pour charger les données à partir d'un fichier JSON.</li>
                                    <li>json_decode() : Convertit une chaîne JSON en tableau PHP, utile pour manipuler
                                        des données JSON dans PHP.</li>
                                    <li>date() : Utilisée pour formater les dates, par exemple pour afficher la date des
                                        annonces dans un format convivial.</li>
                                    <li>htmlspecialchars() : Convertit les caractères spéciaux en entités HTML, ce qui
                                        aide à prévenir les attaques XSS en rendant le code HTML inoffensif.</li>
                                    <li>password_hash() : Utilisée pour hacher les mots de passe des utilisateurs avant
                                        de les stocker dans la base de données, ce qui garantit une sécurité renforcée.
                                    </li>
                                    <li>password_verify() : Vérifie si un mot de passe en clair correspond au hachage
                                        stocké dans la base de données, utilisée lors de l'authentification des
                                        utilisateurs.</li>
                                    <li>session_start() : Démarre une nouvelle session PHP ou restaure une session
                                        existante, nécessaire pour gérer l'authentification des utilisateurs.</li>
                                    <li>file_put_contents() : Utilisée pour écrire des données dans un fichier, par
                                        exemple pour enregistrer les modifications apportées aux annonces dans un
                                        fichier JSON.</li>
                                    <li>header() : Envoie un en-tête HTTP brut, par exemple pour rediriger l'utilisateur
                                        vers une autre page après une action réussie.</li>
                                </ul>
                            </li>
                            <li>Fonctionnement :
                                <ul>
                                    <li>Ces fonctions sont utilisées pour diverses tâches telles que la gestion des
                                        sessions, la manipulation des fichiers, la validation des données utilisateur et
                                        la sécurité.</li>
                                    <li>Elles contribuent à assurer le bon fonctionnement du site et à garantir une
                                        expérience utilisateur fluide et sécurisée.</li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>