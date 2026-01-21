<?php
// public/panier.php
session_start();
require_once '../config/database.php'; // CORRIGÉ : même chemin que catalogue.php
require_once '../app/helpers.php';

$tva = 20.0;

// --- ACTIONS PANIER ---

// 1. Mettre à jour les quantités
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        $qty = (int)$qty;
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }
}

// 2. Supprimer un produit
if (isset($_GET['del'])) {
    $id = (int)$_GET['del'];
    unset($_SESSION['cart'][$id]);
    header("Location: panier.php");
    exit;
}

// 3. Vider le panier
if (isset($_GET['empty'])) {
    $_SESSION['cart'] = [];
    header("Location: panier.php");
    exit;
}

// --- RECUPERATION DES PRODUITS ---
$cartItems = [];
$totalHT = 0;

if (!empty($_SESSION['cart'])) {
    $ids = array_keys($_SESSION['cart']);
    $placeholders = str_repeat('?,', count($ids) - 1) . '?';
    $sql = "SELECT * FROM products WHERE id IN ($placeholders)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        $id = $product['id'];
        $qty = $_SESSION['cart'][$id];
        $price = $product['price'];
        
        $lineTotal = $price * $qty;
        $totalHT += $lineTotal;

        $cartItems[] = [
            'product' => $product,
            'qty' => $qty,
            'lineTotal' => $lineTotal
        ];
    }
}

$totalTTC = calculateIncludingTax($totalHT, $tva);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Mon Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">Votre Panier</h1>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info">Votre panier est vide. <a href="catalogue.php">Retourner au catalogue</a></div>
    <?php else: ?>
        <form method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix U. (TTC)</th>
                        <th>Quantité</th>
                        <th>Total (TTC)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): 
                        $p = $item['product'];
                        $priceTTC = calculateIncludingTax($p['price'], $tva);
                        $lineTTC = calculateIncludingTax($item['lineTotal'], $tva);
                    ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
                        <td><?= number_format($priceTTC, 2) ?> €</td>
                        <td>
                            <input type="number" name="qty[<?= $p['id'] ?>]" value="<?= $item['qty'] ?>" min="0" class="form-control" style="width: 80px;">
                        </td>
                        <td><?= number_format($lineTTC, 2) ?> €</td>
                        <td>
                            <a href="?del=<?= $p['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total TTC</strong></td>
                        <td colspan="2"><strong><?= number_format($totalTTC, 2) ?> €</strong></td>
                    </tr>
                </tfoot>
            </table>

            <div class="d-flex justify-content-between">
                <a href="catalogue.php" class="btn btn-secondary">← Continuer mes achats</a>
                <div>
                    <a href="?empty=1" class="btn btn-outline-danger me-2" onclick="return confirm('Vider tout le panier ?')">Vider le panier</a>
                    <button type="submit" name="update" class="btn btn-primary">Mettre à jour</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</body>
</html>
