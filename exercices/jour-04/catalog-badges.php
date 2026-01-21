<?php
// Enrichissement des données pour l'exercice (ajout de 'new' et 'discount')
$products = [
    [
        'name' => 'RTX 5090',
        'price' => 1999.99,
        'stock' => 0,
        'new' => true,
        'discount' => 0,
        'image' => 'https://placehold.co/200x150?text=GPU'
    ],
    [
        'name' => 'Clavier Mécanique',
        'price' => 149.50,
        'stock' => 12,
        'new' => false,
        'discount' => 20, // 20%
        'image' => 'https://placehold.co/200x150?text=Clavier'
    ],
    [
        'name' => 'Écran 4K OLED',
        'price' => 899.00,
        'stock' => 3,
        'new' => false,
        'discount' => 0,
        'image' => 'https://placehold.co/200x150?text=Ecran'
    ],
    [
        'name' => 'Souris Gaming',
        'price' => 59.90,
        'stock' => 25,
        'new' => true,
        'discount' => 10,
        'image' => 'https://placehold.co/200x150?text=Souris'
    ],
    [
        'name' => 'Casque Audio',
        'price' => 199.99,
        'stock' => 0,
        'new' => false,
        'discount' => 50,
        'image' => 'https://placehold.co/200x150?text=Casque'
    ],
    [
        'name' => 'Support Laptop',
        'price' => 39.99,
        'stock' => 10,
        'new' => false,
        'discount' => 0,
        'image' => 'https://placehold.co/200x150?text=Support'
    ],
    [
        'name' => 'Câble HDMI 2.1',
        'price' => 15.00,
        'stock' => 100,
        'new' => false,
        'discount' => 5,
        'image' => 'https://placehold.co/200x150?text=Cable'
    ],
    [
        'name' => 'Webcam 1080p',
        'price' => 75.50,
        'stock' => 8,
        'new' => true,
        'discount' => 0,
        'image' => 'https://placehold.co/200x150?text=Webcam'
    ],
];

// Calcul des statistiques
$stats = [
    'in_stock' => 0,
    'on_sale' => 0,
    'out_of_stock' => 0
];

foreach ($products as $p) {
    if ($p['stock'] > 0) {
        $stats['in_stock']++;
    } else {
        $stats['out_of_stock']++;
    }

    if ($p['discount'] > 0) {
        $stats['on_sale']++;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Catalogue Produits Avancé</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        /* Styles des Statistiques */
        .stats-bar {
            display: flex;
            justify-content: space-around;
            background: white;
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
        }

        .stat-label {
            color: #666;
            font-size: 0.9em;
        }

        /* Grille */
        .grille {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }

        /* Carte Produit */
        .produit {
            background: white;
            padding: 15px;
            border-radius: 12px;
            position: relative;
            /* Pour positionner les badges */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .produit:hover {
            transform: translateY(-5px);
        }

        .image-container {
            position: relative;
        }

        .produit img {
            width: 100%;
            border-radius: 8px;
        }

        /* Badges */
        .badges-container {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            color: white;
            font-size: 0.8em;
            font-weight: bold;
            text-transform: uppercase;
        }

        .bg-new {
            background-color: #3498db;
        }

        .bg-promo {
            background-color: #e74c3c;
        }

        .bg-last {
            background-color: #f39c12;
        }

        /* Infos */
        h3 {
            margin: 15px 0 5px 0;
            font-size: 1.1em;
        }

        .prix-container {
            margin: 10px 0;
        }

        .prix {
            font-weight: bold;
            font-size: 1.3em;
            color: #2c3e50;
        }

        .prix-original {
            text-decoration: line-through;
            color: #95a5a6;
            font-size: 0.9em;
            margin-right: 5px;
        }

        /* État Stock */
        .stock-info {
            margin-bottom: 15px;
            font-size: 0.9em;
        }

        .en-stock {
            color: #27ae60;
        }

        .rupture-text {
            color: #c0392b;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Bouton */
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-active {
            background-color: #2c3e50;
            color: white;
        }

        .btn-active:hover {
            background-color: #1a252f;
        }

        .btn-disabled {
            background-color: #bdc3c7;
            color: #ecf0f1;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <h1>Catalogue High-Tech</h1>

    <!-- Section Statistiques -->
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-number"><?= $stats['in_stock'] ?></div>
            <div class="stat-label">Produits en stock</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><?= $stats['on_sale'] ?></div>
            <div class="stat-label">Promotions en cours</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" style="color: #c0392b;"><?= $stats['out_of_stock'] ?></div>
            <div class="stat-label">Ruptures de stock</div>
        </div>
    </div>

    <div class="grille">
        <?php foreach ($products as $product): ?>
            <div class="produit">
                <div class="image-container">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">

                    <!-- Badges Conditionnels -->
                    <div class="badges-container">
                        <?php if (isset($product['new']) && $product['new'] === true): ?>
                            <span class="badge bg-new">Nouveau</span>
                        <?php endif; ?>

                        <?php if (isset($product['discount']) && $product['discount'] > 0): ?>
                            <span class="badge bg-promo">-<?= $product['discount'] ?>%</span>
                        <?php endif; ?>

                        <?php if ($product['stock'] < 5 && $product['stock'] > 0): ?>
                            <span class="badge bg-last">Derniers !</span>
                        <?php endif; ?>
                    </div>
                </div>

                <h3><?= htmlspecialchars($product['name']) ?></h3>

                <div class="prix-container">
                    <!-- Affichage du prix barré si promo -->
                    <?php if (isset($product['discount']) && $product['discount'] > 0): ?>
                        <span class="prix-original"><?= number_format($product['price'], 2, ',', ' ') ?> €</span>
                        <?php
                        $newPrice = $product['price'] * (1 - ($product['discount'] / 100));
                        ?>
                        <span class="prix" style="color: #e74c3c;"><?= number_format($newPrice, 2, ',', ' ') ?> €</span>
                    <?php else: ?>
                        <span class="prix"><?= number_format($product['price'], 2, ',', ' ') ?> €</span>
                    <?php endif; ?>
                </div>

                <div class="stock-info">
                    <?php if ($product['stock'] === 0): ?>
                        <p class="rupture-text">Rupture définitive</p>
                    <?php elseif ($product['stock'] < 5): ?>
                        <p class="en-stock" style="color: orange;">Stock limité (<?= $product['stock'] ?> restants)</p>
                    <?php else: ?>
                        <p class="en-stock">En stock</p>
                    <?php endif; ?>
                </div>

                <!-- Bouton Conditionnel -->
                <?php if ($product['stock'] > 0): ?>
                    <button class="btn-active">Ajouter au panier</button>
                <?php else: ?>
                    <button class="btn-disabled" disabled>Indisponible</button>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>