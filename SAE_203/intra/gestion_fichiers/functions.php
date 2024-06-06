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
      return $list;
      }
    }
  }
}

function affiche($id){
  $path = "../espace_fichiers/groupes";
  $fichiers = json_decode(file_get_contents("data/fichiers.json"));?>
  <table class="table table-striped table-hover">
      <tr>
          <td>Nom</td>
          <td>Envoyé le</td>
          <td>Envoyé par</td>
      </tr>
  <?php
      $path_file = $path . "/" . (string) $fichier -> id;
      $files = list_file(1);
      foreach ($files as $file){
        echo $path_file ."/" . $file;
      ?>
      <tr>
        <td><a href="<?=$path_file ."1/" . $file ?>"> <?= $file; ?> </td>
        <td>12/05/2024</td>
        <td>Solaymane</td>
      </tr>
      <?php 
    }
  }
  ?> 
  </table>
  <?php
?>
</body>
</html>