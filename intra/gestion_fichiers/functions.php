<?php session_start();
$_SESSION["id"] = 1;
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
  <div class="container-fluid">
	<nav class="navbar navbar-dark bg-dark text-light">
		Groupe 1
	</nav>
  </div>
	<?php
} 

function list_file($id){

  $list =[] ;
  if ($handle = opendir('../espace_fichiers/groupes/' . (string) $id)) {
    /* Ceci est la façon correcte de traverser un dossier. */
    while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != "..") {
      $list[] = $entry;
      }
    }
  }
  return $list;
}

function affiche($id){
  $path = "../espace_fichiers/groupes";
  $groupes = json_decode(file_get_contents("data/fichiers.json"));?>
  <table class="table table-striped table-hover">
      <tr>
          <td></td>
          <td></td>
          <td>Nom</td>
          <td>Envoyé le</td>
          <td>Envoyé par</td>
      </tr>
  <?php
  $id = 1;
      $path_file = $path . "/" . (string) $id ;
      $files = list_file(1);
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
                  <input name="filePath" value="<?=$path_file ."/" . $files[$i] ?>" type="hidden"> 
                  <input class="btn btn-sm btn-primary" type ="submit" value ="Télécharger">
                </form>
              </td>
              <td>
                <?php
                  if ($droit == "personnel" ){
                    ?>
                      <form action="supprimer.php" method="post">
                        <input name="filePath" value="<?=$path_file ."/" . $files[$i] ?>" type="hidden"> 
                        <input class="btn btn-sm btn-danger" type ="submit" value ="Supprimer">
                      </form>
                    <?php
                  }
                  if (isset($_SESSION["role"])){
                    if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "modo"){
                  ?>
                      <form action="supprimer.php" method="post">
                        <input name="filePath" value="<?=$path_file ."/" . $files[$i] ?>" type="hidden"> 
                        <input class="btn btn-sm btn-danger" type ="submit" value ="Supprimer">
                      </form>
                    <?php
                }
              }
              
              ?>
              </td>
              <td><a href="<?=$path_file ."/" . $files[$i] ?>"> <?= $files[$i]; ?> </td>
                  
              <td><?=$date;?></td>
                  
              <td><?=$auteur;?></td>
            </tr>
              <?php 
              $i++;
                }
              }
              }
              ?>   
              </table>
              <?php           
          } 

function boutonAJout(){
  ?>
  <div class= "container-fluid bg-secondary border border-rounded text-center" >
  <form method="post" action="ajout.php" enctype="multipart/form-data">
    <input type="file" name="monfichier" /><br/>
    <input class="btn btn-lg btn-sm btn-secondary text-center" type ="submit" value ="Envoyer le fichier">
  </form>
  </div>
  <?php
}

  ?> 
  </table>
  <?php
?>
</body>
</html>