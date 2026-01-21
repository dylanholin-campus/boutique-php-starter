<?php
$name  = 'Chaussures Nike Air Max';
$price = 99.99;
$stock = 3;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $name ?></title>
</head>

<body>

    <h1><?= $name ?></h1>

    <p>Prix : <?= $price ?> €</p>

    <span><?= $stock > 0 ? 'En stock' : 'Rupture' ?></span>

</body>

</html>