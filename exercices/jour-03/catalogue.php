<?php
$products = [
    [
        'name' => 'RTX 5090',
        'price' => 1999.99,
        'stock' => 0,
        'image' => 'https://placehold.co/200x150?text=GPU'
    ],
    [
        'name' => 'Clavier Mécanique',
        'price' => 149.50,
        'stock' => 12,
        'image' => 'https://placehold.co/200x150?text=Clavier'
    ],
    [
        'name' => 'Écran 4K OLED',
        'price' => 899.00,
        'stock' => 3,
        'image' => 'https://placehold.co/200x150?text=Ecran'
    ],
    [
        'name' => 'Souris Gaming',
        'price' => 59.90,
        'stock' => 25,
        'image' => 'https://placehold.co/200x150?text=Souris'
    ],
    [
        'name' => 'Casque Audio',
        'price' => 199.99,
        'stock' => 0,
        'image' => 'https://placehold.co/200x150?text=Casque'
    ],
    [
        'name' => 'Support Laptop',
        'price' => 39.99,
        'stock' => 10,
        'image' => 'https://placehold.co/200x150?text=Support'
    ],
    [
        'name' => 'Câble HDMI 2.1',
        'price' => 15.00,
        'stock' => 100,
        'image' => 'https://placehold.co/200x150?text=Cable'
    ],
    [
        'name' => 'Webcam 1080p',
        'price' => 75.50,
        'stock' => 8,
        'image' => 'https://placehold.co/200x150?text=Webcam'
    ],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue Produits</title>
    <style>
        body { font-family: sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
        .grille { 
            display: grid; 
            grid-template-columns: repeat(4, 1fr); 
            gap: 20px; 
        }
        .produit { 
            border: 1px solid #ddd; 
            padding: 15px; 
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .produit img { max-width: 100%; border-radius: 4px; }
        .prix { font-weight: bold; font-size: 1.2em; margin: 10px 0; }
        .rupture { color: red; font-weight: bold; }
        .en-stock { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Nos Produits</h1>
    <div class="grille">
        <?php foreach ($products as $product): ?>
            <div class="produit">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                
                <p class="prix">
                    <?= number_format($product['price'], 2, ',', ' ') ?> €
                </p>

                <?php if ($product['stock'] > 0): ?>
                    <p class="en-stock">En stock</p>
                <?php else: ?>
                    <p class="rupture">Rupture</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
