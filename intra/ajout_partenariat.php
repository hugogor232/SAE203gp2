<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = 'images/Logo_partenariat/'; // Répertoire où les fichiers seront stockés


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

    $nouveauPartenaire = [
        'nom' => $_POST['nom'],
        'contact' => $_POST['contact'],
        'adresse' => $_POST['adresse'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone'],
        'marque' => $_POST['marque'],
        'photo' => $fileName ? $destPath : null
    ];

    // Charger le fichier JSON
    $jsonFilePath = 'data/partenaire.json'; // Mettez ici le chemin vers votre fichier JSON
    $json = file_get_contents($jsonFilePath);
    $partenaires = json_decode($json, true);

    // Ajouter le nouveau salarié
    $partenaires[] = $nouveauPartenaire;

    // Enregistrer les modifications dans le fichier JSON
    file_put_contents($jsonFilePath, json_encode($partenaires, JSON_PRETTY_PRINT));
    ?><meta http-equiv="refresh" content="0;partenaire.php" /> <?php
    echo "Nouveau salarié ajouté avec succès.";
}
?>
