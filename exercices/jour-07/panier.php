<?php
session_start();

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=boutique;charset=utf8mb4",
        "dev",
        "dev",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $cart = $_SESSION["cart"] ?? [];
    $products = [];
    $total = 0;

    // Récupérer les détails des produits du panier
    if (!empty($cart)) {
        $cartIds = array_keys($cart);
        $placeholders = str_repeat('?,', count($cartIds) - 1) . '?';

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
        $stmt->execute($cartIds);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculer le total
        foreach ($products as $product) {
            $productId = $product['id'];
            $quantity = $cart[$productId]["quantity"];
            $total += $product['price'] * $quantity;
        }
    }

    // Modifier quantité
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_cart"])) {
        foreach ($_POST["quantities"] as $id => $qty) {
            if ($qty <= 0) {
                unset($_SESSION["cart"][$id]);
            } else {
                $_SESSION["cart"][$id]["quantity"] = (int)$qty;
            }
        }
        header("Location: panier.php");
        exit;
    }

    // Vider le panier
    if (isset($_GET["empty"])) {
        $_SESSION["cart"] = [];
        header("Location: panier.php");
        exit;
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        .total {
            font-weight: bold;
            font-size: 1.2em;
            color: green;
        }

        .btn {
            padding: 8px 16px;
            margin: 4px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <h1>Mon Panier (<?= count($cart) ?> articles)</h1>
        <a href="catalogue-panier.php">← Continuer les achats</a>
    </header>

    <?php if (empty($cart)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <form method="POST">
            <input type="hidden" name="update_cart" value="1">

            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <?php $productId = $product['id']; ?>
                        <?php $quantity = $cart[$productId]["quantity"] ?? 0; ?>
                        <?php $subtotal = $product['price'] * $quantity; ?>
                        <tr>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= number_format($product['price'], 2) ?> €</td>
                            <td>
                                <input type="number" name="quantities[<?= $productId ?>]"
                                    value="<?= $quantity ?>" min="0" style="width: 60px;">
                            </td>
                            <td><?= number_format($subtotal, 2) ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total général :</strong></td>
                        <td class="total"><?= number_format($total, 2) ?> €</td>
                    </tr>
                </tfoot>
            </table>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="?empty=1" class="btn btn-danger" onclick="return confirm('Vider le panier ?')">Vider le panier</a>
        </form>
    <?php endif; ?>
</body>

</html>