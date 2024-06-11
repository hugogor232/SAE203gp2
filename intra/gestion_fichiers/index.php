<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'functions.php';?>
</head>
<body>
    <?php navbar();?>
    <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h1 class="text-center">Groupe de Partage de Fichiers</h1>
    <?php  boutonAJout();
    ?> 
    <?php
   affiche(12);
    ?>
    </div>

    
</body>
</html>
