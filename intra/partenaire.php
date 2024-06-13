<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    include 'functions.php'
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partenaires Concessionnaires</title>
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
            height: 100%; /* Taille réduite des images */
        }
        .card-body {
            padding: 0; /* Supprimer le padding pour ajuster l'image */
        }

    </style>
</head>

<body>
<?php
genererNavigation();
?>
<h1 class="text-center">Liste Partenaire</h1>
    <?php
$partenaires = json_decode(file_get_contents('data/partenaire.json'),true)
?>
<div class="container mt-5">
    <div class="row">
        <?php foreach ($partenaires as $index => $concessionnaire) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" data-bs-toggle="modal" data-bs-target="#modal<?php echo $index; ?>">
                    <div class="card-body">
                        <img src="./images/Logo_partenariat/<?php echo $concessionnaire['photo']; ?>" class="card-img-top" alt="<?php echo $concessionnaire['nom']; ?>">
                    </div>
                    <div class="card-footer">
                        <h5 class="card-title text-center m-0"><?php echo $concessionnaire['nom']; ?></h5>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal<?php echo $index; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $index; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel<?php echo $index; ?>"><?php echo $concessionnaire['nom']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Contact:</strong> <?php echo $concessionnaire['contact']; ?></p>
                            <p><strong>Adresse:</strong> <?php echo $concessionnaire['adresse']; ?></p>
                            <p><strong>Téléphone:</strong> <?php echo $concessionnaire['telephone']; ?></p>
                            <p><strong>Email:</strong> <?php echo $concessionnaire['email']; ?></p>
                            <p><strong>Marques:</strong> <?php echo implode(", ", $concessionnaire['marques']); ?></p>
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