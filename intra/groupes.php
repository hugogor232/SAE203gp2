<?php session_start();  ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
<?php
    print_r($_SESSION);
    include('functions.php');
    genererHeader();
    genererNavigation();
    ?>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  
    </head>
    <body>
    	<?php
        $_SESSION["id"]=0;
        $_SESSION["role"]="rh";
        echo '<div class="row">';
    		$grpjson = json_decode(file_get_contents("./data/groupes.json", true));
            foreach($grpjson as $grp) {

              if (in_array($_SESSION["id"],$grp->permission)){
                echo '
                <div class="col-sm-2 m-3 p-3">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 15rem; height:15rem;">
                  <div class="card-body d-flex  flex-column text-center">
                    <h2 class="card-title">'.$grp->nom.'</h2>
                    <p class="card-text">'.$grp->description.'</p><div class="mt-5">
                    <a href="gestion_fichiers/index.php?idgrp='.$grp->id.'" class="btn btn-primary">Gestion '.$grp->id.'</a>
                    <a href="suprgrp.php?id='.$grp->id.'" onclick="return checkDelete()" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></a>
                    </div>
                  </div>
                </div>
              </div>'

                ;
              }
            
            }
            if ($_SESSION["role"] == "rh" or  $_SESSION["role"] == "responssable"){
              echo '<div class="col-sm-2 m-3 p-3">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 15rem; height:15rem;">
                  <div class="card-body d-flex justify-content-center flex-column text-center">
                    <h5 class="card-title"><b>Nouveau groupe</b></h5><br>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Creer votre groupe</a>
                    
                  </div>
                </div>
              </div>';
            }
            else{
              echo '<div class="col-sm-2 m-3 p-3"><div style="width: 15rem; height:15rem;"><h4>Uniquement les responssable et les RH peuvent créer des groupes</h4></div></div>';
            }
        
        echo '</div>';
		?>

</div>

<div class="container">

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Création de dossier</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action="traitgrp.php" method='post'>
        <div class="form-group">
          <label >Name</label>
          <input name="nom" type="text" class="form-control" id="Name" placeholder="Nom du fichier">
        </div>
        <div class="form-group">
          <label >Description</label>
          <input name="descr" type="text" class="form-control" id="Description" placeholder="Desciption">
        </div>
      </label>
      <br /><br />
          <div  >
          <h2 >Liste des employés</h2>  
          <div >
            <input onchange="test()" type="text" name="search" id="search" placeholder="Search Employee Details" class="form-control" />
          </div>
          <ul class="list-group" id="result"></ul>
          <br />
  <a id="change">yoooo</a>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
        
      </div>
    </div>
</div>



</body>
<!-- Votre contenu HTML ici -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $.ajaxSetup({ cache: false });
        $('#search').keyup(function(){
            $('#result').html('');
            $('#state').val('');
            var searchField = $('#search').val();
            var expression = new RegExp(searchField, "i");
            $.getJSON('data/utilisateurs.json', function(data) {
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
    <script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Es-tu sur de vouloir supprimer le groupe ?');
}
</script>

</html>