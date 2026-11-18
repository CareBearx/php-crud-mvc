<?php
// Stap 1: Databaseverbinding laden
require_once __DIR__ . '/../../conn.php';
// Stap 2: Controleren of het formulier met POST is verstuurd
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Deze pasgina accepteerd alleen POST requests')
}

// Stap 3: Formuliergegevens ophalen en in variabelen zetten
$naam = trim($_POST['naam']) ?? '';
$beschrijving = $_POST['beschrijving'] ?? '';


if (is_numeric($_POST['aantal'])) {
    $aantal = $_POST['aantal'] ?? '';

} else {
    
    $aantal = 0;
}


$categorie = $_POST['categorie'] 
$toegestaan_categorie = [
    'horror', 'non-fictie', 'thriller', 'fictie', 'kinderboeken', 'educatief'
];



// Stap 5: Eventuele fouten opslaan in $errors

$errors = [];


if(!in_array($categorie, $toegestaan_categorie, true)) {
    $errors[] = 'Kies een geldige categorie';
}


// Stap 6: Als er fouten zijn: fouten tonen en stoppen


// Stap 7: INSERT-query schrijven met placeholders
$query = '
INSERT INTO boeken (naam, beschrijving, categorie, aantal) 
VALUES (:naam, :beschrijving, :categorie, :aantal)

';


// Stap 8: Query voorbereiden met prepare()
$statement = $conn->prepare($query);


// Stap 9: Echte waarden meegeven en query uitvoeren met execute()
$statement->execute([
":naam"=> $naam,
":beschrijving"=> $beschrijving,
":categorie"=> $categorie,
":aantal"=> $aantal,
])


// Stap 10: Na het opslaan redirecten naar de overzichtspagina

$bevestiging = 'Het is opgeslagen!';

header('Location: ' .$base_url. 'public_html/boekenbeheer/index.php?bevestiging=' . $bevestiging);
exit;



