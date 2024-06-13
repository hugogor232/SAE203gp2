<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Groupe de Partage de Fichiers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <!-- Barre de navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PartageFichier</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Mes Fichiers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Télécharger</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Profil</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Section principale -->
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h1 class="text-center">Bienvenue au Groupe de Partage de Fichiers</h1>
        
        <!-- Formulaire de téléchargement -->
        <div class="card my-4">
          <div class="card-body">
            <h5 class="card-title">Télécharger un fichier</h5>
            <form>
              <div class="mb-3">
                <label for="fileInput" class="form-label">Sélectionner un fichier</label>
                <input class="form-control" type="file" id="fileInput">
              </div>
              <button type="submit" class="btn btn-primary">Télécharger</button>
            </form>
          </div>
        </div>

        <!-- Tableau des fichiers partagés -->
        <form class="d-flex" role="search">
          <input id="searchBar" class="form-control me-2" type="text" onkeyup="showHint(this.value)" placeholder="Rechercher un fichier" aria-label="Search">
        </form>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Fichiers partagés</h5>
            <table id="txtHint" class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Nom du fichier</th>
                  <th scope="col">Date d'envoi</th>
                  <th scope="col">Envoyé par</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Document1.pdf</td>
                  <td>08/06/2024</td>
                  <td>Jean Dupont</td>
                  <td>
                    <button class="btn btn-sm btn-primary">Télécharger</button>
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                  </td>
                </tr>
                <tr>
                  <td>Image1.png</td>
                  <td>07/06/2024</td>
                  <td>Marie Curie</td>
                  <td>
                    <button class="btn btn-sm btn-primary">Télécharger</button>
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                  </td>
                </tr>
                <!-- Ajouter d'autres fichiers ici -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pied de page -->
  <footer class="bg-light text-center text-lg-start mt-5">
    <div class="container p-4">
      <p>&copy; 2024 PartageFichier. Tous droits réservés.</p>
    </div>
  </footer>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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
