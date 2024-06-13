<?php
// Charger le fichier JSON
include "functions.php";
$json = file_get_contents('data/client.json');
$clients = json_decode($json, true);
$_SESSION['role'] = "admin";
$_SESSION['email'] = "jean.dupont@vroumvroumloc.com"
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
            height: 100%; /* Taille réduite des images */
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
    <?php genererNavigation(); ?>
    <!-- Champ de recherche -->
    <div class="mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Rechercher un salarié...">
    </div>
    <div id="employeeList">
        <!-- Ici seront ajoutées les cards des salariés -->
    </div>
    <h1 class="text-center">Clients</h1>
<div class="container mt-5">
    <div class="row">
        <?php foreach ($clients as $index => $client) { ?>
            <div class="col-md-4 mb-4">
                <div class="card border border-5 border-dark rounded-4" data-bs-toggle="modal" data-bs-target="#modal<?php echo $index; ?>">
                <div class="card-header bg-dark text-light rounded-top-3">
                        <h5 class="card-title text-center m-0"><?=$client['nom']; ?></h5>
                    </div>
                    <div class="card-body">
                        <img src="images/image_client/client.jpg" class="card-img-top rounded-bottom-3" alt="<?php echo $client['nom']; ?>">
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal<?php echo $index; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $index; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel<?php echo $index; ?>"><?php echo $client['nom']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nom:</strong> <?php echo $client['nom']; ?></p>
                            <p><strong>Adresse:</strong> <?php echo $client['adresse']; ?></p>
                            <p><strong>Téléphone:</strong> <?php echo $client['telephone']; ?></p>
                            <p><strong>Mail:</strong> <?php echo $client['email']; ?></p>
                                <?php
                                if ($_SESSION['role'] == "admin" or $_SESSION['role'] == "modo"){?>
                                    <form action="suppr_client.php" method="post">
                                <input type="hidden" name="email" value="<?= $client['email'] ?>">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        <?php
                                }
                                ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } 
        if ($_SESSION['role'] == "admin" or $_SESSION['role'] == "modo"){
        ?>


        <!-- Card pour ajouter un nouveau salarié -->
    <div class="card mb-3 border border-0" style="width: 18rem;" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
        <div class="card-body text-center">
        <img src="images/images_salariés/ajouter.png" class="card-img-top" alt="ajouter">
            <p class="card-text">
                <img src="path/to/add_icon.png" alt="Ajouter un salarié" style="width: 50px; height: 50px;">
            </p>
        </div>
    </div>
    <?php }?>

    <!-- Modal pour ajouter un nouveau salarié -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Ajouter un nouveau salarié</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" action="ajout_client.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="tel" class="form-control" id="adresse" name="adresse" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({ cache: false });
        $('#search').keyup(function(){
            $('#result').html('');
            $('#state').val('');
            var searchField = $('#search').val();
            var expression = new RegExp(searchField, "i");
            $.getJSON('../data/utilisateurs.json', function(data) {
                $.each(data, function(key, value){
                    if (value.prenom.search(expression) != -1 || value.nom.search(expression) != -1)
                    {
                        $('#result').append('<li class="list-group-item link-class"><img src="'+value.image+'" height="40" width="40" class="img-thumbnail" /> '+value.prenom+' '+value.nom+'</li>');
                    }
                });
            });
        });

        let selectedUsers = [];

        $('#result').on('click', 'li', function() {
            var click_text = $(this).text().split('|');
            selectedUsers.push($.trim(click_text[0]));
            $('#search').val(selectedUsers.join(', '));
            $('#result').html('');
        });
    });
    </script>
</body>
</html>