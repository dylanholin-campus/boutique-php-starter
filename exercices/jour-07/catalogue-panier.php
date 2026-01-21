<?php
session_start();

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=boutique;charset=utf8mb4',
        'dev',
        'dev',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Récupérer tous les produits
    $stmt = $pdo->query('SELECT * FROM products ORDER BY name');
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ajouter au panier (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        $productId = (int)$_POST['product_id'];

        // Initialiser le panier s'il n'existe pas
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Ajouter ou incrémenter la quantité
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = ['quantity' => 0];
        }
        $_SESSION['cart'][$productId]['quantity']++;

        $message = 'Produit ajouté au panier !';
    }
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Catalogue</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        .btn-add {
            background: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
        }

        .cart-badge {
            background: #ff4444;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
        }

        .message {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Catalogue de produits</h1>
        <a href="panier.php">
            Panier
            <span class="cart-badge"><?= count($_SESSION['cart'] ?? []) ?></span>
        </a>
        <br>
        <br>
    </header>

    <?php if (isset($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= number_format($product['price'], 2) ?> €</td>
                    <td><?= $product['stock'] ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="add_to_cart" value="1">
                            <button type="submit" class="btn-add">Ajouter au panier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="panier.php">Voir mon panier (<?= count($_SESSION['cart'] ?? []) ?> articles)</a>
</body>

</html>