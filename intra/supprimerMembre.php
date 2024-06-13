<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idGroupe = $_GET['idGroupe'];
    $idUtilisateur = $_POST['id'];
    $groupes =  json_decode(file_get_contents("./data/groupes.json", true));
    var_dump($groupes -> 2);
    //var_dump($groupes[((int)$idGroupe)-1]);
     /* var_dump( $groupes;) */
         if(count($groupes[$idGroupe-1]-> permission[$idUtilisateur])== 1){
            header('Location: suprgrp.php?id='.$idGroupe);
        }
        else
        {
        unset($groupes[$idGroupe-1]-> permission[$idUtilisateur]);
            }
        var_dump($groupes[$idGroupe-1] -> permission[$idUtilisateur]); 
}
?>