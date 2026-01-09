<?php

require_once "../app/data.php";
require_once "../app/helpers.php";

$tva = 20.0;
$remise = 10.0;
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Catalogue</title>
    <style>
        .produit {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .promo {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Notre Catalogue</h1>
    <?php
    foreach ($products as $product):

        $priceHT = $product["price"];

        $montantTVA = calculateVAT($priceHT, $tva);
        $prixTTC = calculateIncludingTax($priceHT, $tva);
        $prixFinal = calculateDiscount($prixTTC, $remise);
    ?>

        <div class="produit">
            <h2><?= htmlspecialchars($product["name"]) ?></h2>
            <p>Prix HT : <?= number_format($priceHT, 2) ?> €</p>
            <p>Montant de la TVA (<?= $tva ?>%) : <?= number_format($montantTVA, 2) ?> €</p>
            <p>Prix TTC : <?= number_format($prixTTC, 2) ?> €</p>
            
            <p class="promo">
                Prix final avec remise de <?= $remise ?>% :
                <?= number_format($prixFinal, 2) ?> €
            </p>
            <p>
                Stock : <?= displayStock($product["stock"]) ?>
            </p>
        </div>
    <?php endforeach; ?>
</body>

</html>