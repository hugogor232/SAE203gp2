<?php
session_start();
$_SESSION['role'] = 'modo';
$_SESSION['id'] = 1;
$groupes = json_decode(file_get_contents("data/fichiers.json"),true);
$a = array();
$b = array();
$c = array();
foreach ($groupes as $groupe){
    if ($groupe['id'] == $_SESSION['id']){
        foreach ($groupe['fichiers'] as $fichier){
            $a[] = $fichier['nom'] ;

        }
    }
}


// get the q parameter from URL
$q = $_REQUEST["q"];
$hint = array();

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
        $hint[] = $name;
    }
  }
}
?>
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
$path = "../espace_fichiers/groupes";
$id = 1;
$path_file = $path . "/" . (string) $id ;
if ($hint != array()){
foreach ($hint as $name){
    foreach ($groupes as $groupe){
        if ($groupe['id'] == $_SESSION['id']){
            $droit = $groupe['droit'];
        foreach ($groupe['fichiers'] as $fichier){
            if ($fichier['nom'] == $name){
                $date = $fichier['date'];
                $auteur = $fichier['auteur'];
            ?>
            <tr>
              <td>
                <form action="upload.php" method="post">
                  <input name="filePath" value="<?=$path_file ."/" . $fichier['nom'] ?>" type="hidden"> 
                  <input class="btn btn-sm btn-primary" type ="submit" value ="Télécharger">
                </form>
                <?php
                  if ($droit == "personnel" ){
                    ?>
                      <form action="supprimer.php" method="post">
                        <input name="filePath" value="<?=$path_file ."/" . $fichier['nom'] ?>" type="hidden"> 
                        <input class="btn btn-sm btn-danger" type ="submit" value ="Supprimer">
                      </form>
                    <?php
                  }
                  if (isset($_SESSION["role"])){
                    if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "modo"){
                  ?>
                      <form action="supprimer.php" method="post">
                        <input name="filePath" value="<?=$path_file ."/" . $fichier['nom'] ?>" type="hidden"> 
                        <input class="btn btn-sm btn-danger" type ="submit" value ="Supprimer">
                      </form>
                    <?php
                }
              }
              
              ?>
              </td>
              <?php  
              $nom = $fichier['nom'];
              if (strlen($nom) > 10) {
                  $nom = substr($nom, 0, 10);
              }
              ?>
              <td><a href="<?=$path_file ."/" . $fichier['nom'] ?>"> <?= $nom; ?> </td>
                  
              <td><?=$date;?></td>
                  
              <td><?=$auteur;?></td>
            </tr>
              <?php 
                }
              }
            }
              }
              ?>   
              </tbody>
            </table>
          </div>
        </div>
      </div>
              <?php           

            }
            }
            else {
                echo ' <p class="text-center text-danger">Aucun résultat, veuillez vérifier l\'orthographe.</p>';
            }
?>
