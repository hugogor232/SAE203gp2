<?php session_start();
$_SESSION['role'] = "modo";
if (isset($_GET["idgrp"])){
  $_SESSION['id'] = $_GET["idgrp"];
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?= $groupes[$_SESSION['id']-1]->nom;?></title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="script.js"></script>
</head>
<body>
<?php

function toggle(){
  $grpjson = json_decode(file_get_contents("../data/groupes.json", true));?>
   <?php 

?>
<!-- Offcanvas (à placer à la fin du body) -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Informations</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <h4>Membres du groupe</h4>
          <?php
              if ($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'modo'){
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
              foreach ($grpjson as $groupe){
                if ($groupe->id == $_SESSION['id']){
                  foreach ($groupe->permission as $utilisateur){
                  $idUtilisateurs[] = $utilisateur;
                }
              }
            }
              $utilisateurs = json_decode(file_get_contents("../data/utilisateurs.json", true));
              foreach ($idUtilisateurs as $utilisateur){
              ?>
              <tr>
                <td>
                    <form action="supprimerMembre.php" method="post">
                    <input name="id" value="<?=$utilisateur?>" type="hidden"> 
                      <svg class="text-danger" type ="submit" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708"/></svg>
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
        <form action="ajouterMembre.php" method='post'>
      <br /><br />
          <div  >
          <h2 >Liste des employés</h2>  
          <div >
            <input onchange="test()" type="text" name="search" id="search" placeholder="Search Employee Details" class="form-control" />
          </div>
          <ul class="list-group" id="result"></ul>
          <br />
  <a id="change"></a>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
                foreach ($grpjson as $groupe){
                  if ($groupe->id == $_SESSION['id']){
                    foreach ($groupe->permission as $utilisateur){
                    $idUtilisateurs[] = $utilisateur;
                  }
                }
              }
                $utilisateurs = json_decode(file_get_contents("./data/utilisateurs.json", true));
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
                }}
          ?>
          </tbody>
          </table>
          
          <?php ?>
    </div>
</div>




  <?php
}

function navbar(){
  $groupes = json_decode(file_get_contents("../data/groupes.json"));
	?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <svg type="button" onmouseover="bigImg(this)" onmouseout="normalImg(this)" onclick="redirectToPage('../groupes.php')" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/></svg>
      <a class="navbar-brand text-center" href="#"><?= $groupes[$_SESSION['id']-1]->nom;?></a>
      <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><svg type="button"  xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/></svg></a>
      </div>
    </nav>
	<?php
} 

/* function list_file($id){

  $list =[] ;
  if ($handle = opendir('../espace_fichiers/groupes/' . (string) $id)) {
    // Ceci est la façon correcte de traverser un dossier. 
    while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != "..") {
      $list[] = $entry;
      }
    }
  }
  return $list;
} */

function affiche(){
  $path = "../groupes";
  $groupes = json_decode(file_get_contents("../data/groupes.json"));?>
  
  <div class="card">
          <div class="shadow shadow p-3 card-body">
            <h5 class="card-title">Fichiers partagés</h5>
            <form class= "d-flex" role="search">
              <input id="searchBar" class="form-control me-2" type="text" onkeyup="showHint(this.value)" placeholder="Rechercher un fichier" aria-label="Search">
            </form>
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table id="txtHint"class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Actions</th>
                  <th scope="col">Nom du fichier</th>
                  <th scope="col">Date d'envoi</th>
                  <th scope="col">Envoyé par</th>
                </tr>
              </thead>
              <tbody>
  <?php
  $id = $_SESSION['id'];
      $path_file = $path . "/" . (string) $id ;

      foreach ($groupes as $groupe){
        if ($groupe -> id == $id){
          $i = 0;
          $droit = $groupe -> droit;
          foreach ($groupe -> fichiers as $fichier){
            $date = $fichier -> date;
            $auteur = $fichier -> auteur;
            ?>
            
            <tr>
              <td>
                <form action="upload.php" method="post">
                  <input name="filePath" value="<?=$path_file ."/" . $fichier -> nom ?>" type="hidden"> 
                  <input class="btn btn-sm btn-primary" type ="submit" value ="Télécharger">
                </form>
                <?php
                  if ($droit == "personnel" ){
                    ?>
                      <form action="supprimer.php" method="post">
                        <input name="filePath" value="<?=$path_file ."/" . $fichier -> nom ?>" type="hidden"> 
                        <input class="btn btn-sm btn-danger" type ="submit" value ="Supprimer">
                      </form>
                    <?php
                  }
                  if (isset($_SESSION["role"])){
                    if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "modo"){
                  ?>
                      <form action="supprimer.php" method="post">
                        <input name="filePath" value="<?=$path_file ."/" . $fichier -> nom ?>" type="hidden"> 
                        <input class="btn btn-sm btn-danger" type ="submit" value ="Supprimer">
                      </form>
                    <?php
                }
              }
              
              ?>
              </td>
              <?php  
              $nom = $fichier -> nom;
              if (strlen($nom) > 10) {
                  $nom = substr($nom, 0, 10);
              }
              ?>
              <td><a href="<?=$path_file ."/" . $fichier -> nom ?>"> <?= $nom; ?> </td>
                  
              <td><?=$date;?></td>
                  
              <td><?=$auteur;?></td>
            </tr>
              <?php 
              $i++;
                }
              }
              }
              ?>   
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
              <?php           
          } 

function boutonAJout(){
  ?>

  <div class="card my-4 shadow shadow p-3">
          <div class="card-body">
            <h5 class="card-title">Télécharger un fichier</h5>
            <form method="post" action="ajout.php" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="fileInput" class="form-label">Sélectionner un fichier</label>
                <input class="form-control" type="file" name="monfichier" id="fileInput">
              </div>
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
          </div>
        </div>
  <?php
}

  ?> 
  </table>
  <?php
?>
  <script>
function showHint(str) {
  if (str.length == 0) {
    loadAllFiles();
    return;
  } else {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  xmlhttp.open("GET", "gethint.php?q=" + str);
  xmlhttp.send();
  }
}


function loadAllFiles() {
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function() {
    document.getElementById("txtHint").innerHTML = this.responseText;
  }
  xmlhttp.open("GET", "ajoutTousLesFichiers.php", true); // Endpoint pour charger tous les fichiers
  xmlhttp.send();
}

function redirectToPage(adresse){
  window.location.href = adresse;
}

function bigImg(x) {
  x.style.height = "35px";
  x.style.width = "35px";
}

function normalImg(x) {
  x.style.height = "25px";
  x.style.width = "25px";
}

</script>
</body>
</html>