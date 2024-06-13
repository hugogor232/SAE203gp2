<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    var_dump($email);    
    // Charger le fichier JSON
    $jsonFilePath = 'data/client.json'; // Mettez ici le chemin vers votre fichier JSON
    $json = file_get_contents($jsonFilePath);
    $clients = json_decode($json, true);

    // Rechercher et supprimer le salarié par email
    foreach ($clients as $index => $client) {
        if ($client['email'] == $email) {
            // Supprimer le salarié du tableau
            var_dump($clients[$index]);
            unset($clients[$index]);
            break;
        }
    }$clients = array_values($clients);

    // Enregistrer les modifications dans le fichier JSON
    file_put_contents($jsonFilePath, json_encode($clients , JSON_PRETTY_PRINT  ));
    ?><meta http-equiv="refresh" content="0;client.php" /> <?php
}
?>
