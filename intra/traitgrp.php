<?php 
session_start();
$lecturejson = json_decode(file_get_contents('grp.json', true));
$userjson = json_decode(file_get_contents('data/utilisateurs.json', true));
print_r($_POST);
var_dump($_POST);





echo("<br><br><br>");
$listeperm[] = explode(",",$_POST["search"]);

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
print_r($listeperm);
print_r($idlist);
echo("<br><br><br>");

$newfile = array(
        "id"=>1,
        "nom"=> $_POST["nom"],
        "description"=> $_POST["descr"],
        "permission"=> $idlist,
        "fichiers"=> array()
);
$lecturejson[] = $newfile;


$lecturejson = json_encode($lecturejson, JSON_PRETTY_PRINT);
file_put_contents('grp.json',$lecturejson);
echo '<pre>';
print_r($lecturejson);
echo '</pre>';
?>