<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    var_dump($email);    
    // Charger le fichier JSON
    $jsonFilePath = 'data/partenaire.json'; // Mettez ici le chemin vers votre fichier JSON
    $json = file_get_contents($jsonFilePath);
    $partenaires = json_decode($json, true);

    // Rechercher et supprimer le salarié par email
    foreach ($partenaires as $index => $partenaire) {
        if ($partenaire['email'] == $email) {
            // Supprimer la photo du serveur
            if (isset($partenaire['photo']) && file_exists($partenaire['photo'])) {
                unlink($partenaire['photo']);
            }

            // Supprimer le salarié du tableau
            var_dump($partenaires[$index]);
            unset($partenaires[$index]);
            break;
        }
    }$partenaires = array_values($partenaires);

    // Enregistrer les modifications dans le fichier JSON
    file_put_contents($jsonFilePath, json_encode($partenaires , JSON_PRETTY_PRINT  ));
    ?><meta http-equiv="refresh" content="0;partenaire.php" /> <?php
}
?>
