<?php 
session_start();
$lecturejson = json_decode(file_get_contents("./data/groupes.json", true));
$userjson = json_decode(file_get_contents('data/utilisateurs.json', true));
header('Location: groupes.php');
echo '<pre>';
print_r($lecturejson);
echo '</pre>';
rmdir('groupes/'.$_GET["id"]);
function deleteDirectory($dir) {
        if (!is_dir($dir)) {
            return false;
        }
    
        $items = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($items, RecursiveIteratorIterator::CHILD_FIRST);
    
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
    
        return rmdir($dir);
    }
    
$directory = 'groupes/'.$_GET["id"];
if (deleteDirectory($directory)) {
        echo "Le dossier a été supprimé avec succès.";
} else {
        echo "Erreur lors de la suppression du dossier.";
}

unset($lecturejson[$_GET["id"]-1]);
echo '<pre>';
print_r($lecturejson);
echo '</pre>';
$lecturejson = json_encode($lecturejson, JSON_PRETTY_PRINT);
file_put_contents("./data/groupes.json",$lecturejson);






?>