<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier si le fichier a été uploadé sans erreur
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'images/images_salariés/'; // Répertoire où les fichiers seront stockés


        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = basename($_FILES['photo']['name']);
        $destPath = $uploadDir . $fileName;

        // Déplacer le fichier uploadé vers le répertoire de destination
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $email = $_POST['email'];
            var_dump($_POST);

            // Charger le fichier JSON
            $jsonFilePath = 'data/salarié.json'; // Mettez ici le chemin vers votre fichier JSON
            $json = file_get_contents($jsonFilePath);
            $personnes = json_decode($json, true);

            // Rechercher la personne par nom et mettre à jour la photo
            foreach ($personnes as &$personne) {
                if ($personne['email'] == $email) {
                    // Supprimer l'ancienne photo si elle existe
                    if (isset($personne['photo']) && file_exists($personne['photo'])) {
                        unlink($personne['photo']);
                    }

                    // Mettre à jour avec le nouveau chemin de la photo
                    $personne['photo'] = $destPath;
                    break;
                }
            }
            //var_dump($personnes);
            // Enregistrer les modifications dans le fichier JSON
            file_put_contents($jsonFilePath, json_encode($personnes, JSON_PRETTY_PRINT));
            var_dump($personnes);
            echo "Photo uploadée et mise à jour avec succès.";
            ?><meta http-equiv="refresh" content="0;salarié.php" /> <?php
        } else {
            echo "Erreur lors du déplacement du fichier uploadé.";
        }
    } else {
        echo "Erreur lors de l'upload du fichier.";
    }
} else {
    echo "Méthode de requête non autorisée.";
}
?>
