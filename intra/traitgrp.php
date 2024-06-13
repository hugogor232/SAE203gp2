<?php 
session_start(); //trait php
$lecturejson = json_decode(file_get_contents("./data/groupes.json", true));
$userjson = json_decode(file_get_contents('../Vitrine/data/users.json', true));
//print_r($_POST);
//var_dump($_POST);
//header('Location: groupes.php');
$_SESSION["grpid"] = ($lecturejson[sizeof($lecturejson)-1]->id);
echo($_SESSION["grpid"]);

echo("<br><br><br>");
if (isset($_POST["search"])){
$listeperm[] = explode(",",$_POST["search"]);
}
if ($_POST['confidentialité'] == "Public"){
        foreach($userjson as $persosave){
                $id+=1;
                $idlist[] = $id-1;
        }
}
elseif ($_POST['confidentialité'] == "Personnel"){
        foreach($userjson as $persosave){
                $id+=1;
                if ($_SESSION["idUtilisateur"] == $persosave->id){
                $idlist[] = $id-1;
                }
        }       
}
else{
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
}
print_r($listeperm);
print_r($idlist);
echo("<br><br><br>");
if ($idlist==null){
        $idlist= [];
}
$newfile = array(
        "id"=>$_SESSION["grpid"]+1,
        "nom"=> $_POST["nom"],
        "droit" => $_POST["confidentialité"],
        "description"=> $_POST["descr"],
        "permission"=> $idlist,
        "fichiers"=> array()
);
$lecturejson[] = $newfile;




mkdir("groupes/".$_SESSION["grpid"]+1, 0777, true);

$lecturejson = json_encode($lecturejson, JSON_PRETTY_PRINT);
file_put_contents("./data/groupes.json",$lecturejson);
echo '<pre>';
print_r($lecturejson);
echo '</pre>';
?>