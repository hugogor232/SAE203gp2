<?php 
header("Location: groupes.php");
session_start();
$lecturejson = json_decode(file_get_contents('grp.json', true));
print_r($_POST);
var_dump($_POST);
$newfile = array(
        "id"=>1,
        "nom"=> $_POST["nom"],
        "description"=> $_POST["descr"]
);
$lecturejson[] = $newfile;
$lecturejson = json_encode($lecturejson, JSON_PRETTY_PRINT);
file_put_contents('grp.json',$lecturejson);
echo '<pre>';
print_r($lecturejson);
echo '</pre>';
?>