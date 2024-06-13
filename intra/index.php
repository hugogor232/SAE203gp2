<?php session_start();  ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
<?php
    //print_r($_SESSION);
    include("functions.php");
    genererHeader();
    toggle();
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

    <script>
    document.getElementById('offcanvasToggle').addEventListener('click', function () {
        var offcanvasElement = document.getElementById('offcanvasExample');
        var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
        offcanvas.show();
    });
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</html>