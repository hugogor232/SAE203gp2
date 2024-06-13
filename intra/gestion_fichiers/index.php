<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'functions.php';?>
    <?php include '../functions.php';?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</head>
<body>






    
    <?php toggle();navbar();?>
    <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <?php $groupes = json_decode(file_get_contents("../data/groupes.json"));?>
        <h1 class="text-center">Groupe de Partage de Fichiers <br><p class="text-danger"> <?= $groupes[$_SESSION['id']-1]->nom;?></p></h1>
    <?php  boutonAJout();
    
    ?> 
    <?php
   affiche();
    ?>
    </div>
    <script>
/*     document.getElementById('offcanvasToggle').addEventListener('click', function () {
        var offcanvasElement = document.getElementById('offcanvasExample');
        var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
        offcanvas.show();
    }); */
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
</html>
