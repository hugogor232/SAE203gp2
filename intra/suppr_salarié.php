<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    var_dump($email);    
    // Charger le fichier JSON
    $jsonFilePath = 'data/salarié.json'; // Mettez ici le chemin vers votre fichier JSON
    $json = file_get_contents($jsonFilePath);
    $personnes = json_decode($json, true);

    // Rechercher et supprimer le salarié par email
    foreach ($personnes as $index => $personne) {
        if ($personne['email'] == $email) {
            // Supprimer la photo du serveur
            if (isset($personne['photo']) && file_exists($personne['photo'])) {
                unlink($personne['photo']);
            }

            // Supprimer le salarié du tableau
            var_dump($personnes[$index]);
            unset($personnes[$index]);
            break;
        }
    }$personnes = array_values($personnes);

    // Enregistrer les modifications dans le fichier JSON
    file_put_contents($jsonFilePath, json_encode($personnes , JSON_PRETTY_PRINT  ));
    ?><meta http-equiv="refresh" content="0;salarié.php" /> <?php
}
?>
