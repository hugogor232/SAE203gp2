<?php session_start();
$_SESSION['role'] = "modo";
$_SESSION['id'] = 1;

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="script.js"></script>
</head>
<body>
<?php

function navbar(){
	?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
      </svg>
      <a class="navbar-brand text-center" href="#">PartageFichier</a>
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

function affiche($id){
  $path = "../espace_fichiers/groupes";
  $groupes = json_decode(file_get_contents("data/fichiers.json"));?>
  
  <div class="card">
          <div class="card-body">
            <h5 class="card-title">Fichiers partagés</h5>
            <form class="d-flex" role="search">
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
  $id = 1;
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

  <div class="card my-4">
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
</script>
</body>
</html>