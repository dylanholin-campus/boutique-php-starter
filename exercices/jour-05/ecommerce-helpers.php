<?php

// Calculs

function calculateIncludingTax($prixHorsTaxe, $tva = 20)
{
    return $prixHorsTaxe * (1 + $tva / 100);
}

function calculateDiscount($prix, $pourcentage)
{
    return $prix * (1 - $pourcentage / 100);
}

function calculateTotal($panier)
{
    $total = 0;
    foreach ($panier as $article) {
        $total += $article['price'] * $article['quantity']; // c'est equivalent a ça :
        //$total = $total + ($article['price'] * $article['quantity']);
    }
    return $total;
}

// Formatage (Date et Prix)

function formatPrice($montant)
{
    return number_format($montant, 2, ',', ' ') . ' €';
}

function formatDate($dateTexte)
{
    $timestamp = strtotime($dateTexte);

    // Tableau simple pour traduire les mois
    $moisFr = [
        1 => 'janvier',
        2 => 'février',
        3 => 'mars',
        4 => 'avril',
        5 => 'mai',
        6 => 'juin',
        7 => 'juillet',
        8 => 'août',
        9 => 'septembre',
        10 => 'octobre',
        11 => 'novembre',
        12 => 'décembre'
    ];

    $jour = date('d', $timestamp);
    $numeroMois = date('n', $timestamp);
    $annee = date('Y', $timestamp);

    return $jour . ' ' . $moisFr[$numeroMois] . ' ' . $annee;
}

// Affichage (HTML)
function displayStockStatus($stock)
{
    if ($stock > 10) {
        return '<span style="color: green;">En stock (' . $stock . ')</span>';
    } elseif ($stock > 0) {
        return '<span style="color: orange;">Peu de stock (' . $stock . ')</span>';
    } else {
        return '<span style="color: red;">Rupture de stock</span>';
    }
}

function displayBadges($produit)
{
    $html = '';
    if ($produit['is_new'] == true) {
        $html .= '[NOUVEAU] ';
    }
    if ($produit['on_sale'] == true) {
        $html .= '[PROMO] ';
    }
    return $html;
}

// Validation
function validateEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function validatePrice($prix)
{
    if (is_numeric($prix) && $prix >= 0) {
        return true;
    } else {
        return false;
    }
}

// Debug
function dump_and_die_patate(...$variables)
{
    foreach ($variables as $var) {
        echo '<pre style="background: black; color: lightgreen; padding: 10px;">';
        var_dump($var);
        echo '</pre>';
    }
    die('FIN DU SCRIPT (Arrêt demandé)');
}

// MES DONNÉES

$prixBureau = 100.00;
$monEmail = 'theo@test.fr';
$dateAchat = '2025-01-15';

$monProduit = [
    'name' => 'Chaise Gamer',
    'price' => 150.00,
    'stock' => 5,
    'is_new' => true,     // Est-ce nouveau ?
    'on_sale' => true,    // Est-ce en promo ?
    'discount_percent' => 20
];

// Un panier (tableau de tableaux)
$monPanier = [
    ['price' => 10, 'quantity' => 2],
    ['price' => 50, 'quantity' => 1]
];

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ma Page de Test Simple</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        h2 {
            border-bottom: 2px solid #333;
        }

        li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <h1>Bienvenue sur ma page de test PHP</h1>

    <h2>1. Tester les calculs</h2>
    <ul>
        <li>Prix de base : <?php echo $prixBureau; ?> €</li>
        <li>Prix avec TVA (20%) : <strong><?php echo calculateIncludingTax($prixBureau); ?> €</strong></li>
        <li>Prix Panier Total : <strong><?php echo calculateTotal($monPanier); ?> €</strong></li>
    </ul>

    <h2>2. Tester le formatage (Dates et Prix)</h2>
    <ul>
        <li>Date brute : <?php echo $dateAchat; ?></li>
        <li>Date jolie : <strong><?php echo formatDate($dateAchat); ?></strong></li>
        <li>Prix formaté : <strong><?php echo formatPrice(1234.50); ?></strong></li>
    </ul>

    <h2>3. Tester l'affichage visuel</h2>
    <p>
        Produit : <?php echo $monProduit['name']; ?><br>
        Stock : <?php echo displayStockStatus($monProduit['stock']); ?><br>
        Badges : <?php echo displayBadges($monProduit); ?>
    </p>

    <h2>4. Tester la validation</h2>
    <ul>
        <li>
            L'email "theo@test.fr" est-il valide ?
            <?php
            if (validateEmail($monEmail)) {
                echo 'OUI';
            } else {
                echo 'NON';
            }
            ?>
        </li>
        <li>
            Le prix "-10" est-il valide ?
            <?php
            if (validatePrice(-10)) {
                echo 'OUI';
            } else {
                echo "NON (c'est normal)";
            }
            ?>
        </li>
    </ul>

    <h2>5. Tester le Debug</h2>
    <p>Attention, ci-dessous j'appelle la fonction <code>dump_and_die</code>.</p>
    <p>Elle va afficher le contenu de mon produit et arrêter le chargement de la page.</p>

    <hr>

    <?php
    dump_and_die_patate($monProduit, 'Ceci est un test de fin');
    ?>

    <p>CE TEXTE NE S'AFFICHERA JAMAIS CAR LE SCRIPT EST MORT AVANT.</p>
    <h2>blablablablablabla</h2>
    <p>blablablablabla<code>je suis une patate</code>.</p>
    <p>blablablablablabla</p>


</body>

</html>