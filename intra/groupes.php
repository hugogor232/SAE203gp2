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
  
    </head>
    <body>
    	<?php
        echo '<div class="row">';
    		$grpjson = json_decode(file_get_contents('grp.json', true));
            foreach($grpjson as $grp) {
            echo '
                <div class="col-sm-2">
                <div class="card" style="width: 15rem; height:15rem;">
                  <div class="card-body">
                    <h5 class="card-title">'.$grp->nom.'</h5>
                    <p class="card-text">'.$grp->description.'</p>
                    <a href="#" class="btn btn-primary">Gestion</a>
                  </div>
                </div>
              </div>'

                ;
            }
        echo '<div class="col-sm-2">
                <div class="card" style="width: 15rem; height:15rem;">
                  <div class="card-body">
                    <h5 class="card-title"><b>Nouveau groupe</b></h5>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Creer votre groupe</a>
                  </div>
                </div>
              </div>';
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
</html>