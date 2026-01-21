<!DOCTYPE html>
<html>

<head>
    <title>Test Classe Product</title>
    <style>
        body {
            font-family: monospace;
            margin: 40px;
            background: #f5f5f5;
            font-size: 1.2rem;
        }

        pre {
            background: #000;
            color: #0f0;
            padding: 20px;
            border-radius: 5px;
        }

        .section {
            margin: 20px 0;
        }

        h2 {
            color: #0066cc;
        }
    </style>
</head>

<body>

    <h1>🧪 Test Complet avec var_dump()</h1>

    <?php
    require 'Product.php';
    $produit = new Product(1, 'Chaise', 'Design Berlin', 150.0, 10, 'Mobilier');
    ?>

    <strong>
        <div class="section">
            <h2>AVANT</h2>
            <pre><?php var_dump($produit); ?></pre>
        </div>

        <div class="section">
            <h2>Resultat 01</h2>
            <p>Prix TTC: <?php echo $produit->getPriceIncludingTax(); ?>€</p>
            <p>En stock: <?php echo $produit->isInStock() ? '✅ OUI' : '❌ NON'; ?></p>
            <br>
            <p>j"utilise ensuite reduceStock(3) et applyDiscount(10)</p>
            <?php
            $produit->reduceStock(3);
            $produit->applyDiscount(10);
            ?>
        </div>

        <div class="section">
            <h2>APRÈS</h2>
            <pre><?php var_dump($produit); ?></pre>
            <h2>Resultat 02</h2>
            <p>Prix TTC: <?php echo $produit->getPriceIncludingTax(); ?>€</p>
            <p>En stock: <?php echo $produit->isInStock() ? '✅ OUI' : '❌ NON'; ?></p>
        </div>
        <br>
    </strong>
</body>

</html>