<?php session_start();  ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
<?php
    error_reporting(0); // desactiver le rappport d erreur
    $tabusers = json_decode(file_get_contents("../Vitrine/data/users.json", true));
    if ($_SESSION["idUtilisateur"] == null){
      foreach($tabusers as $user){
          if ($user->email == $_GET["email"]){
            $_SESSION["idUtilisateur"] = $user->id;
          }
      }}
    include('functions.php');
    genererHeader();
    genererNavigation();
    ?>
    <title>Accueil Intranet</title>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <style>
      .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card {
            height: 100%;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
    </style>
    <body>
    	<?php
        $_SESSION["rolet"]="admin";
        echo '<div class="row">';
    		$grpjson = json_decode(file_get_contents("./data/groupes.json", true));
            foreach($grpjson as $grp) {
              //var_dump($grp->permission);
              echo($_SESSION["idUtilisateur"]);
              if (in_array($_SESSION["idUtilisateur"],$grp->permission)){
                echo '
                <div class="col-sm-2 m-3 p-0 d-flex">
                <div type=button onclick=redirectToPage("gestion_fichiers/index.php?idgrp='.$grp->id.'") class="card shadow p-3 mb-5 bg-body rounded" style="width: 15rem; height:15rem;">
                  <div class="card-body d-flex  flex-column text-center ">
                    <h4 class="card-title fw-bold fs-6">'.$grp->nom.$grp->id.'</h4>
                    <p class="card-text">'.$grp->description.'</p><div class="mt-5">
                    <div class="d-flex">
                    <div onclick="handleButtonClick(event)" class="dropdown">
                    <button  id="dropdownMenuButton" "type="button" class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16"><path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/></svg></button>
                    <ul class="dropdown-menu aria-labelledby="dropdownMenuButton">
                      <li><a href="suprgrp.php?id='.$grp->id.'" onclick="return checkDelete()"  class="dropdown-item p-0 m-0 text-center text-danger">supprimer</a></li>
                      <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal'.$grp->id.'" class="dropdown-item p-0 m-0 text-center"> information</a> </li>
                    </ul>
                    </div>
                    </div>
                    </div>

                    </div>
                </div>
              </div>'
                ;
              }
            
            }
            if ($_SESSION["rolet"] == "admin" or  $_SESSION["rolet"] == "modo"){
              echo '<div class="col-sm-2 m-4  d-flex " data-toggle="modal" data-target="#myModal">
                <div type=button class="card shadow p-3 mb-5 bg-body rounded bg-dark bg-gradient text-light" style="width: 100%; height:100%;">
                  <div class="card-body d-flex justify-content-center flex-column text-center">
                    <h4 class="card-title"><b>Nouveau<br>groupe</b></h4><br>
                    
                  </div>
                </div>
              </div>';
            }
            else{
              echo '<div class="col-sm-2 m-3 p-3"><div style="width: 15rem; height:15rem;"><h4>Uniquement les responssable et les RH peuvent créer des groupes</h4></div></div>';
            }
        
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
      <input type="radio" id="Public" name="confidentialité" value="Public">
      <label for="Public">Public</label><br>
      <input type="radio" id="Privée" name="confidentialité" value="Privée">
      <label for="Privée">Privée</label><br>
      <input type="radio" id="Personnel" name="confidentialité" value="Personnel">
      <label for="Personnel">Personnel</label>
      <br /><br />
          <div  >
          <h2 >Liste des employés</h2>  
          <div >
            <input type="text" name="search" id="search" placeholder="Search Employee Details" class="form-control" />
          </div>
          <ul class="list-group" id="result"></ul>
          <br />
  <a id="change"></a>
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

<!-- modal gestion groupe -->
 <?php foreach ($grpjson as $groupe){
  $i = 1;
?>
<div class="modal fade" id="exampleModal<?=$groupe->id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Gestion du groupe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div id="accordion">
    <div class="card">
      <div class="card-header">
        <a class="btn text-center" data-bs-toggle="collapse" href="#collapseOne">
        Informations
        </a>
      </div>
      <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
        <div class="card-body text-center">
          <h4><?= $groupe->nom ?></h4>
          <p><?= $groupe->description?></p>
        <p class="text-primary"><?= $groupe->droit?></p>
    </div>
    </div>
      </div>
      </div>
    
    <div class="card">
      <div class="card-header">
        <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseTwo">
        Membres
      </a>
      </div>
      <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
        <div class="card-body">
          <h4>Membres du groupe</h4>
          <?php
              if ($_SESSION['rolet'] == 'admin' or $_SESSION['rolet'] == 'modo'){
          ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $idUtilisateurs = array();
              foreach ($groupe->permission as $utilisateur){
                $idUtilisateurs[] = $utilisateur;
              }
              $utilisateurs = json_decode(file_get_contents("../Vitrine/data/users.json", true));
              foreach ($idUtilisateurs as $utilisateur){
              ?>
              <tr>
                <td>
                    <form action="supprimerMembre.php?idGroupe=<?=$groupe->id;?>" method="post">
                    <input name="id" value="<?=$utilisateur?>" type="hidden"> 
                      <input class="btn btn-sm btn-danger" type ="submit" value ="Supprimer">
                    </form>
                </td>
                <td>
                  <?=
                    $utilisateurs["$utilisateur"]->email
                    ?>
                </td>
              </tr>
              <?php
              }
        ?>
        </tbody>
        </table>
          
          <?php } else { ?>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $idUtilisateurs = array();
                foreach ($groupe->permission as $utilisateur){
                  $idUtilisateurs[] = $utilisateur;
                }
                $utilisateurs = json_decode(file_get_contents("../Vitrine/data/users.json", true));
                foreach ($idUtilisateurs as $utilisateur){
                ?>
                <tr>
                  <td>
                    <?=
                      $utilisateurs["$utilisateur"]->email;
                      ?>
                  </td>
                </tr>
                <?php
                }
          ?>
          </tbody>
          </table>
          <?php } ?>
        </div>
        </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    <?php }?>
  </div>
  </form>
                
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ?>




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
            $.getJSON('../Vitrine/data/users.json', function(data) {
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

function redirectToPage(adresse){
  window.location.href = adresse;
}

function desactiveSearchBar() {
    var radios = document.querySelectorAll('input[type="radio"][name="confidentialité"]');
    for (var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('click', function() {
            var selectedValue = this.value;
            if (selectedValue === "Public" || selectedValue === "Personnel") {
                document.getElementById('search').disabled = true;
            } else {
                document.getElementById('search').disabled = false;
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    desactiveSearchBar();
});


function handleButtonClick(event) {
        // Empêcher la propagation de l'événement de clic à la div parente
        event.stopPropagation();
    }
</script>

</html>