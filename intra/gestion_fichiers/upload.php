<?php
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupère le chemin du fichier depuis le formulaire
    $filePath = $_POST['filePath'];
    echo "<h2>Contenu du fichier :</h2>";
    // Forcer le téléchargement du fichier
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    ob_clean();
    flush();
    readfile($filePath);
    exit;
}
?>