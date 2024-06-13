<?php
// Charger le fichier JSON
$json = file_get_contents('data/salarié.json');
$personnes = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de Personnes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            height: 100%;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card img {
            object-fit: cover;
            height: 100px; /* Taille réduite des images */
        }
        .card-body {
            padding: 0; /* Supprimer le padding pour ajuster l'image */
        }
        .card-footer {
            background-color: #cce7ff; /* Bleu clair */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <?php foreach ($personnes as $index => $personne) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" data-bs-toggle="modal" data-bs-target="#modal<?php echo $index; ?>">
                    <div class="card-body">
                        <img src="./images/images_salariés/<?php echo $personne['photo']; ?>" class="card-img-top" alt="<?php echo $personne['nom']; ?>">
                    </div>
                    <div class="card-footer">
                        <h5 class="card-title text-center m-0"><?php echo $personne['nom']; ?></h5>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal<?php echo $index; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $index; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel<?php echo $index; ?>"><?php echo $personne['nom']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Poste:</strong> <?php echo $personne['poste']; ?></p>
                            <p><strong>Email:</strong> <?php echo $personne['email']; ?></p>
                            <p><strong>Téléphone:</strong> <?php echo $personne['telephone']; ?></p>
                            <h2>Modifier la photo</h2>
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input class="form-control" id="email" type="hidden" name="email" value="<?=$personne['email']?>">
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Sélectionner une photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>