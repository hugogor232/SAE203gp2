<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idGroupe = $_GET['idGroupe'];
    $idUtilisateur = $_POST['id'];
    $groupes =  json_decode(file_get_contents("./data/groupes.json", true));
    var_dump($groupes[0] );
    //var_dump($groupes[((int)$idGroupe)-1]);
     /* var_dump( $groupes;) */
     foreach ($groupes as $groupe){
        if ($groupe->id == $idGroupe){
            if(count($groupe->permission)== 1){
                header('Location: suprgrp.php?id='.$idGroupe);
            }
            else
            {
                var_dump($idUtilisateur);
                var_dump($groupe->permission);
            unset($groupe->permission[array_search($idUtilisateur, $groupe->permission)]);
            var_dump($groupe->permission);
            file_put_contents("./data/groupes.json", json_encode($groupes, JSON_PRETTY_PRINT));
                header('Location: groupes.php');
                }
     }
    }
         
       // var_dump($groupes[$idGroupe-1] -> permission[$idUtilisateur]); 
}

?>