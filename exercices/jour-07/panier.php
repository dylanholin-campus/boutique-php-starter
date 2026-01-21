<?php
declare(strict_types=1);
session_start();

$pdo = new PDO(
    'mysql:host=localhost;dbname=boutique;charset=utf8mb4',
    'dev',
    'dev',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

if (!isset($_SESSION['cart'])) { /* Initialiser le panier */
    $_SESSION['cart'] = [];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {/* Actions POST : ajouter / modifier quantités */


    if (isset($_POST['add_id'])) {    // Ajouter 1 produit
        $id = (int) $_POST['add_id'];

        if ($id > 0) {
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + 1;
            } else {
                $_SESSION['cart'][$id] = 1;
            }
        }

        header('Location: panier.php');
        exit;
    }


    if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {    // Mettre à jour les quantités
        foreach ($_POST['quantities'] as $id => $qty) {
            $id = (int) $id;
            $qty = (int) $qty;

            if ($id > 0) {
                if ($qty <= 0) {
                    unset($_SESSION['cart'][$id]);
                } else {
                    $_SESSION['cart'][$id] = $qty;
                }
            }
        }

        header('Location: panier.php');
        exit;
    }
}


if (isset($_GET['empty'])) {
    $_SESSION['cart'] = [];
    header('Location: panier.php');
    exit;
}


$cart = $_SESSION['cart'];/* Lecture panier + BDD */
$products = [];
$total = 0.0;

if (!empty($cart)) {
    $ids = array_keys($cart);


    $placeholders = [];    // Construire "?, ?, ?" selon le nombre d'ids
    for ($i = 0; $i < count($ids); $i++) {
        $placeholders[] = '?';
    }
    $sqlIn = implode(',', $placeholders);

    $stmt = $pdo->prepare("SELECT id, name, price FROM products WHERE id IN ($sqlIn)");  // Requête PDO préparée (sécurisée)
    $stmt->execute($ids); //   execute($ids) rempalce les ? de mon sqlIn par les vrai id (1,2,3,4...)
    $rows = $stmt->fetchAll();

    foreach ($rows as $row) {
        $id = (int) $row['id'];


        $qty = 0;        // récupérer la quantité depuis la session
        if (isset($cart[$id])) {
            $qty = (int) $cart[$id];
        }

        if ($qty > 0) {
            $lineTotal = (float) $row['price'] * $qty;
            $total += $lineTotal;

            $products[] = [ // fiche produit
                'id' => $id,
                'name' => $row['name'],
                'price' => (float) $row['price'],
                'qty' => $qty,
                'line_total' => $lineTotal,
            ];
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

<p><a href="catalogue-panier.php">Retour</a></p>

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
                    <td><?= number_format($p['price'], 2, ',', ' ') ?> €</td>
                    <td>
                        <input type="number" min="0"
                               name="quantities[<?= (int)$p['id'] ?>]"
                               value="<?= (int)$p['qty'] ?>">
                    </td>
                    <td><?= number_format($p['line_total'], 2, ',', ' ') ?> €</td>
                </tr>
            <?php endforeach; ?>
        </table>

        <p><strong>Total :</strong> <?= number_format($total, 2, ',', ' ') ?> €</p>
        <button type="submit">Mettre à jour le panier</button>
    </form>

    <p><a href="panier.php?empty=1">Vider le panier</a></p>
<?php endif; ?>

</body>
</html>
