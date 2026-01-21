<?php

require_once __DIR__ . '/helpers.php';

$clientName = 'Palapin le Magicien';
$priceHT = 100.0;
$tva = 20.0;
$remise = 10.0;

$montantTVA = calculateVAT($priceHT, $tva);
$prixTTC = calculateIncludingTax($priceHT, $tva);
$prixFinal = calculateDiscount($prixTTC, $remise);

$stock = 3;
$dateAdded = '2025-12-20';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Fonctions</title>
</head>

<body>

    <h1><?php greet(); ?></h1>
    <p><?php greetClient($clientName); ?></p>

    <h2>Calculs</h2>
    <ul>
        <li>Prix HT : <?= formatPrice($priceHT) ?></li>
        <li>TVA (<?= $tva ?>%) : <?= formatPrice($montantTVA) ?></li>
        <li>Prix TTC : <?= formatPrice($prixTTC) ?></li>
        <li>Remise (<?= $remise ?>%) : <?= formatPrice($prixTTC - $prixFinal) ?></li>
        <li>Prix final : <strong><?= formatPrice($prixFinal) ?></strong></li>
    </ul>

    <h2>Check</h2>
    <ul>
        <li>En stock ? <?= isInStock($stock) ? 'true' : 'false' ?></li>
        <li>En promo ? <?= isOnSale($remise) ? 'true' : 'false' ?></li>
        <li>Nouveau ? <?= isNew($dateAdded) ? 'true' : 'false' ?></li>
        <li>Commande possible (2) ? <?= canOrder($stock, 2) ? 'true' : 'false' ?></li>
    </ul>

    <h2>Affichage HTML avec fonctions</h2>
    <p><?= displayBadge("Promo -{$remise}%", '#8e44ad') ?></p>
    <p>Prix : <?= displayPrice($prixTTC, $remise) ?></p>
    <p>Stock : <?= displayStock($stock) ?></p>

</body>

</html>