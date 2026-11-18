<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <form action="../../app/http/controllers/boekenController.php" method="POST">

        <label for="naam">Boek naam</label>
        <input type="text" id="naam" name="naam" required>


        <label for="beschrijving">Beschrijving</label>
        <textarea id="beschrijving" name="beschrijving" rows="3" required></textarea>


        <label for="categorie">Categorie</label>
        <select id="categorie" name="categorie" required>
            <option>----- Kies de categorie -----</option>
            <option value="horror">Horror</option>
            <option value="non-fictie">Non-fictie</option>
            <option value="thriller">Thriller</option>
            <option value="fictie">Fictie</option>
            <option value="kinderboek">Kinderboek</option>
            <option value="educatief">Educatief</option>
        </select>


        <label for="aantal">Aantal</label>
        <input type="number" id="aantal" name="aantal" min="0" required>


        <input type="submit">Boek toevoegen</button>

    </form>
</body>

</html>