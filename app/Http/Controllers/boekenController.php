<?php
// Stap 1: Databaseverbinding laden
require_once '../../../config/conn.php';

// Stap 2: Controleren of het formulier met POST is verstuurd
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Deze pagina accepteerd alleen POST requests');
}

// Stap 3: Formuliergegevens ophalen en in variabelen zetten
$name = trim($_POST['naam']) ?? '';
$description = $_POST['beschrijving'] ?? '';


if (is_numeric($_POST['aantal'])) {
    $amount = $_POST['aantal'] ?? '';

} else {
    
    $amount = 0;
}


$category = $_POST['categorie'] ?? '';

$allowed_category = [
    'horror', 
    'non-fictie', 
    'thriller', 
    'fictie', 
    'kinderboeken', 
    'educatief'
];



// Stap 5: Eventuele fouten opslaan in $errors

$errors = [];


if(!in_array($category, $allowed_category, true)) {
    $errors[] = 'Kies een geldige categorie';
}


// Stap 6: Als er fouten zijn: fouten tonen en stoppen

if($errors !== []) {
  http_response_code(455);
  echo '<h1> Controleer uw formulier </h1><ul>';

    foreach($errors as $error) {
        echo '<li>' . $error . '</li>';
    }

    echo '</ul>';
    exit;
}


// Stap 7: INSERT-query schrijven met placeholders
$query = '
INSERT INTO boeken (naam, beschrijving, categorie, aantal) 
VALUES (:name, :description, :category, :amount)

';


// Stap 8: Query voorbereiden met prepare()
$statement = $conn->prepare($query);


// Stap 9: Echte waarden meegeven en query uitvoeren met execute()
$statement->execute([
":name"=> $name,
":description"=> $description,
":category"=> $category,
":amount"=> $amount,
]);


// Stap 10: Na het opslaan redirecten naar de overzichtspagina

$confirmation = 'Het is opgeslagen!';

header('Location: ' .$base_url. 'public_html/boekenbeheer/index.php?confirmation=' . $confirmation);
exit;



