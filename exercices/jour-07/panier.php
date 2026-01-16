<?php
session_start();

/* 1) Connexion BDD (PDO) */
$pdo = new PDO(
    "mysql:host=localhost;dbname=boutique;charset=utf8mb4",
    'dev',
    'dev',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

if (!isset($_SESSION['cart'])) { // si cart n’existe pas encore dans la session
    $_SESSION['cart'] = []; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { /* Actions simples (ajouter / modifier / supprimer / vider) */

    if (isset($_POST['add_id'])) {     // Ajouter 1 produit (ex: depuis un bouton "Ajouter au panier")
        $id = (int) $_POST['add_id']; // exécute ce code seulement si le formulaire a envoyé un champ add_id

        if ($id > 0) {
            $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
        }
        header('Location: panier.php');
        exit;
    }


    if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {  // Mettre à jour les quantités 
        foreach ($_POST['quantities'] as $id => $qty) {
            $id = (int) $id;
            $qty = (int) $qty;

            if ($id <= 0) continue;

            if ($qty <= 0) {
                unset($_SESSION['cart'][$id]);      // qty 0 => supprimer
            } else {
                $_SESSION['cart'][$id] = $qty;      // sinon mettre à jour
            }
        }
        header('Location: panier.php');
        exit;
    }
}

// Vider le panier (lien ?empty=1)
if (isset($_GET['empty'])) {
    $_SESSION['cart'] = [];
    header('Location: panier.php');
    exit;
}

/* 4) Lire les produits depuis la BDD */
$cart = $_SESSION['cart'];
$products = [];
$total = 0.0;

if (!empty($cart)) {
    // Simple pour débutant : 1 requête par produit
    $stmt = $pdo->prepare('SELECT id, name, price FROM products WHERE id = ?');

    foreach ($cart as $id => $qty) {
        $stmt->execute([(int)$id]);
        $product = $stmt->fetch();

        if ($product) {
            $product['qty'] = (int)$qty;
            $product['line_total'] = $product['price'] * $product['qty'];
            $total += $product['line_total'];
            $products[] = $product;
        } else {
            // si le produit n'existe plus en BDD, on le retire du panier
            unset($_SESSION['cart'][(int)$id]);
        }
    }
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Panier</title>
</head>

<body>

    <h1>Panier</h1>

                <p><a href="http://localhost:8000/exercices/jour-07/catalogue-panier.php">Retour</a></p>

    <?php if (empty($products)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>

        <form method="post">
            <table border="1" cellpadding="6">
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total ligne</th>
                </tr>

                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= number_format((float)$p['price'], 2, ',', ' ') ?> €</td>
                        <td>
                            <input
                                type="number"
                                min="0"
                                name="quantities[<?= (int)$p['id'] ?>]"
                                value="<?= (int)$p['qty'] ?>">
                        </td>
                        <td><?= number_format((float)$p['line_total'], 2, ',', ' ') ?> €</td>
                    </tr>
                <?php endforeach; ?>

            </table>


            <p><strong>Total :</strong> <?= number_format((float)$total, 2, ',', ' ') ?> €</p>

            <button type="submit">Mettre à jour le panier</button>
        </form>

        <p><a href="panier.php?empty=1">Vider le panier</a></p>

    <?php endif; ?>

</body>

</html>