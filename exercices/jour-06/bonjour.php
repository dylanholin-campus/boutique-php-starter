<?php
$nom = $_GET['name'] ?? 'visiteur';

$age = $_GET['age'] ?? null;

$nomPropre = htmlspecialchars($nom);
$agePropre = htmlspecialchars($age);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice Bonjour</title>
</head>
<body>
    <h1>
        <?php 
        if ($age) {
            echo "Bonjour $nomPropre, vous avez $agePropre ans !";
        } else {
            echo "Bonjour $nomPropre !";
        }
        ?>
    </h1>

</body>
</html>
