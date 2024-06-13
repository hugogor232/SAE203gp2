<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupère le chemin du fichier depuis le formulaire
    $filePath = $_POST['filePath'];
    $filePath = realpath($filePath);
    $nameFile = basename($filePath);
    $groupes =  json_decode(file_get_contents("../data/groupes.json", true));
    foreach ($groupes as $groupe){
        foreach($groupe -> fichiers as $index => $fichier){
                if ($fichier -> nom == $nameFile){
                    unset($groupe -> fichiers[$index]);
                    unlink($filePath);
                }
      }
    }
    file_put_contents("../data/groupes.json", json_encode($groupes,JSON_PRETTY_PRINT));

    ?>
    <meta http-equiv="refresh" content="1;index.php" />
    <?php
}
?>