<?php
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupère le chemin du fichier depuis le formulaire
    $filePath = $_POST['filePath'];
    $filePath = realpath($filePath);
    $nameFile = basename($filePath);
    $groupes =  json_decode(file_get_contents('data/fichiers.json', true));
    foreach ($groupes as $groupe){
        foreach($groupe -> fichiers as $index => $fichier){
                if ($fichier -> nom == $nameFile){
                    unset($groupe -> fichiers[$index]);
                    unlink($filePath);
                }
      }
    }
    file_put_contents('data/fichiers.json', json_encode($groupes));

    ?>
    <meta http-equiv="refresh" content="1;index.php" />
    <?php
}
?>