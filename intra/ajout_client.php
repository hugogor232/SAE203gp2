<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nouveauClient = [
        'nom' => $_POST['nom'],
        'adresse' => $_POST['adresse'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone'],
    ];

    // Charger le fichier JSON
    $jsonFilePath = 'data/client.json'; // Mettez ici le chemin vers votre fichier JSON
    $json = file_get_contents($jsonFilePath);
    $clients = json_decode($json, true);

    // Ajouter le nouveau salarié
    $clients[] = $nouveauClient;

    // Enregistrer les modifications dans le fichier JSON
    file_put_contents($jsonFilePath, json_encode($clients, JSON_PRETTY_PRINT));
    ?><meta http-equiv="refresh" content="0;clients.php" /> <?php
    echo "Nouveau salarié ajouté avec succès.";
}
?>
