<?php 
session_start();
$_SESSION["name"] = "Rahmi";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
/*     var_dump(explode("." , $_FILES['monfichier']['name'])[1]); */
    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
    if (isset($_FILES['monfichier']) and $_FILES['monfichier']['error'] == 0){
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['monfichier']['size'] <= 1000000){
            $extension = array("png","jpg","jpeg","gif", "csv","txt","pdf");
            // Testons si l'extension est autorisée
           if (in_array(explode("." , $_FILES['monfichier']['name'])[1],$extension)){
                    // On peut valider le fichier et le stocker définitivement
                    move_uploaded_file($_FILES['monfichier']['tmp_name'], "../groupes/" . (string) $_SESSION["id"] . "/". basename($_FILES['monfichier']['name']));
                    //on met à jour le fichier json
                    $groupes = json_decode(file_get_contents("../data/groupes.json"),true);
                    var_dump($_SESSION["id"]);
                    foreach ($groupes as $groupe){
                        if ($groupe['id'] == $_SESSION["id"] ){
                            $newFile = array(
                                "nom" => $_FILES['monfichier']['name'],
                                "date" => date('d/m/Y'),
                                "auteur" => $_SESSION["name"]);
                            array_push($groupe['fichiers'] , $newFile); 
                            $groupes[$_SESSION["id"]-1] = $groupe;
                            $newJsonData = json_encode($groupes,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                            file_put_contents("../data/groupes.json", $newJsonData);
                            break;
                        }
                    }
                    
           }
           else {
            echo 'fichier non autorisé au téléchargement';
           }
        }
        else{
            echo 'fichier trop gros';
        }
    }
    else {
        echo 'Le fichier n\'a pas bien charger ou contient une erreur';
    }
    ?>
                <meta http-equiv="refresh" content="0;index.php" />
                     <?php
}
?>

