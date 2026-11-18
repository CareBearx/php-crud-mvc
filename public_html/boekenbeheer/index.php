<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href="../css/style.css">
</head>

<body>
    <?php Require_once '../header.php'; ?>

    <?php
    if(isset($_GET['confirmation'])) {
        echo '<p class="confirm">opgeslagen</p>';
    }


// <!-- database verbinding -->
require_once '../../config/conn.php';

//  <!-- query-->
$query = 'SELECT * FROM boeken';



//   <!-- prepare -->
$statement = $conn->prepare($query);

//    <!-- execute -->
$statement->execute();


    // <!-- fetch all -->
$books = $statement->fetchall();

print_r($books);

if ($books > 0) {

?>

    <div class="table-container">

        <table>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Beschrijving</th>
                    <th>Categorie</th>
                    <th>Aantal</th>
                    <th>Aangemaakt op</th>
                <tr>
            </thead>

            <tbody>
                <?php
                foreach($books as $book) {
                echo "<tr>";
                echo "<td>".$book['naam']. "</td>";
                echo "<td>".$book['beschrijving']. "</td>";
                echo "<td>".$book['categorie']. "</td>";
                echo "<td>".$book['aantal']. "</td>";
                echo "<td>".$book['aangemaakt_op']. "</td>";
                echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <?php

} else {
    echo 'Er zijn geen meldingen';
}
?>

    </div>



</body>

</html>