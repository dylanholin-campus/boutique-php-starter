<?php
$nom = $_GET['name'] ?? 'visiteur';

$age = $_GET['age'] ?? null;

if (empty($nom)) {
    $nom = 'visiteur';
}

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
        // je peux tester la variable $name avec http://localhost:8000/exercices/jour-06/bonjour.php?name=maxime
        // pour tester 2 variables je peux rajouter un & dans l'URL
        // comme ici http://localhost:8000/exercices/jour-06/bonjour.php?name=maxime&age=54
        ?>
    </h1>

</body>

</html>