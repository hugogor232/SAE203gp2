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
    <title>Annuaires des fournisseurs partenaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .partner {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .partner img {
            max-width: 100px;
            margin-right: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <?php include ('functions.php'); ?>
    <?php genererNavigation(); ?>

    <div class="container mt-4">
        <?php
        // Chemin absolu vers le fichier JSON
        $json_file = 'C:/wamp64/www/SAE203gp2/Vitrine/data/AnnuairesP.json';

        // Vérification de l'existence du fichier
        if (file_exists($json_file)) {
            // Chargement du contenu du fichier JSON
            $json_content = file_get_contents($json_file);

            // Décodage du JSON en tableau associatif
            $data = json_decode($json_content, true);

            // Vérification si la clé existe avant d'afficher
            if (isset($data['partenaires_concessionnaires'])) {
                echo "<h1>Annuaires des fournisseurs partenaires</h1>";
                foreach ($data['partenaires_concessionnaires'] as $partenaire) {
                    echo '<div class="partner">';
                    echo '<img src="/SAE203gp2/Vitrine/images/Logo_partenariat/' . $partenaire['photo'] . '" alt="' . $partenaire['nom'] . '">';
                    echo '<div>';
                    echo "<strong>Nom:</strong> " . $partenaire['nom'] . "<br>";
                    echo "<strong>Contact:</strong> " . $partenaire['contact'] . "<br>";
                    echo "<strong>Adresse:</strong> " . $partenaire['adresse'] . "<br>";
                    echo "<strong>Téléphone:</strong> " . $partenaire['telephone'] . "<br>";
                    echo "<strong>Email:</strong> " . $partenaire['email'] . "<br>";
                    echo "<strong>Marques:</strong> " . implode(", ", $partenaire['marques']) . "<br>";
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Aucune donnée de partenaires trouvée.";
            }
        } else {
            echo "Le fichier AnnuairesP.json n'existe pas.";
        }
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
