<?php 
session_start();
print_r($_POST);
$userjson = json_decode(file_get_contents('../data/utilisateurs.json', true));
$groupes = json_decode(file_get_contents("../data/groupes.json", true));



if (isset($_POST["search"])){
    $listeperm[] = explode(",",$_POST["search"]);
}
foreach($listeperm[0] as $perso)
{
        $id = 0;
        foreach($userjson as $persosave){
                $id+=1;
                if ($perso == ($persosave->prenom." ".$persosave->nom) or ($perso == (" ".$persosave->prenom." ".$persosave->nom))){
                        $idlist[] = $id-1;  
                }
        }
}
var_dump($groupes[$_SESSION['id']-1]->permission);
//print_r($lecturejson);
foreach ($idlist as $id){
    if (!in_array($id,$groupes[$_SESSION['id']-1]->permission)){
    $groupes[$_SESSION['id']-1]->permission[] = $id ;
}
}
var_dump($groupes[$_SESSION['id']-1]->permission);


$groupes = json_encode($groupes, JSON_PRETTY_PRINT);
file_put_contents("../data/groupes.json",$groupes);


?>