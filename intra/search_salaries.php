<?php
// Charger le fichier JSON des salariés
$json = file_get_contents('data/salarié.json');
$personnes = json_decode($json, true);

// Récupérer le terme de recherche
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Filtrer les salariés en fonction du terme de recherche
$filteredEmployees = array_filter($personnes, function($personne) use ($searchTerm) {
    return stripos($personne['nom'], $searchTerm) !== false;
});

// Générer le HTML pour les salariés filtrés
$output = '';
foreach ($filteredEmployees as $index => $personne) {
    $output .= '
        <div class="col-md-4 mb-4">
            <div class="card border border-5 border-dark rounded-5" data-bs-toggle="modal" data-bs-target="#modal' . $index . '">
                <div class="card-header bg-dark text-light rounded-top-4">
                    <h5 class="card-title text-center m-0">' . $personne['nom'] . '</h5>
                </div>
                <div class="card-body">
                    <img src="' . $personne['photo'] . '" class="card-img-top rounded-bottom-5" alt="' . $personne['nom'] . '">
                </div>
            </div>
        </div>';
}

echo $output;
?>
