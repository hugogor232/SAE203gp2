<?php
session_start();
$path = "../groupes";
  $groupes = json_decode(file_get_contents("../data/groupes.json"));?>
  
  <div class="card">
  <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped">
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
              <?php