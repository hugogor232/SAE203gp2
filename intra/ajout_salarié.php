<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = 'images/images_salariés/'; // Répertoire où les fichiers seront stockés

    // Créer le répertoire si nécessaire
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = basename($_FILES['photo']['name']);
        $destPath = $uploadDir . $fileName;

        // Déplacer le fichier uploadé vers le répertoire de destination
        if (!move_uploaded_file($fileTmpPath, $destPath)) {
            echo "Erreur lors du déplacement du fichier uploadé.";
            exit;
        }
    }

    $nouveauSalarie = [
        'nom' => $_POST['nom'],
        'poste' => $_POST['poste'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone'],
        'photo' => $fileName ? $destPath : null
    ];

    // Charger le fichier JSON
    $jsonFilePath = 'data/salarié.json'; // Mettez ici le chemin vers votre fichier JSON
    $json = file_get_contents($jsonFilePath);
    $personnes = json_decode($json, true);

    // Ajouter le nouveau salarié
    $personnes[] = $nouveauSalarie;

    // Enregistrer les modifications dans le fichier JSON
    file_put_contents($jsonFilePath, json_encode($personnes, JSON_PRETTY_PRINT));
    ?><meta http-equiv="refresh" content="0;salarié.php" /> <?php
    echo "Nouveau salarié ajouté avec succès.";
}
?>
