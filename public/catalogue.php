<?php
session_start();
require_once "../app/helpers.php"; // Vos fonctions d'aide

// TENTATIVE DE CONNEXION BDD (Chemin absolu pour éviter les erreurs)
$dbPath = '../config/database.php';

if (!file_exists($dbPath)) {
    die("ERREUR CRITIQUE : Le fichier $dbPath n'existe pas ! Vérifiez l'arborescence.");
}
require_once $dbPath;

$tva = 20.0;

// --- PANIER ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $id = (int)$_POST['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

// --- RECUPERATION PRODUITS (SQL au lieu de data.php) ---
$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

// Filtre Recherche
if (!empty($_GET['q'])) {
    $sql .= " AND name LIKE ?";
    $params[] = "%" . $_GET['q'] . "%";
}

// Filtre Catégorie (Version compatible avec votre BDD avancée)
// On fait une jointure car 'category' est une table séparée maintenant
if (!empty($_GET['category'])) {
    $sql = "SELECT p.* FROM products p 
            JOIN categories c ON p.category_id = c.id 
            WHERE c.slug = ?";
    // Si recherche aussi présente
    if (!empty($_GET['q'])) {
        $sql .= " AND p.name LIKE ?";
        $params = [$_GET['category'], "%" . $_GET['q'] . "%"];
    } else {
        $params = [$_GET['category']];
    }
}

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $filteredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERREUR SQL : " . $e->getMessage());
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Catalogue BDD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .produit {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Catalogue (Source: BDD)</h1>
        <a href="panier.php" class="btn btn-outline-dark">
            Panier <span class="badge bg-danger"><?= array_sum($_SESSION['cart'] ?? []) ?></span>
        </a>
    </div>

    <!-- Filtres -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="q" class="form-control" placeholder="Rechercher..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                <button class="btn btn-primary">OK</button>
            </form>
        </div>
        <div class="col-md-6">
            <a href="catalogue.php" class="btn btn-outline-secondary">Tout</a>
            <a href="?category=vetements" class="btn btn-outline-secondary">Vêtements</a>
            <a href="?category=accessoires" class="btn btn-outline-secondary">Accessoires</a>
        </div>
    </div>

    <!-- Grille -->
    <div class="row">
        <?php if (empty($filteredProducts)): ?>
            <div class="alert alert-warning">Aucun produit trouvé dans la base de données.</div>
        <?php else: ?>
            <?php foreach ($filteredProducts as $product): ?>
                <div class="col-md-4">
                    <div class="produit h-100 d-flex flex-column">
                        <h2><?= htmlspecialchars($product["name"]) ?></h2>
                        <p><strong><?= number_format(calculateIncludingTax($product["price"], $tva), 2) ?> €</strong></p>
                        <p><?= displayStock($product["stock"]) ?></p>

                        <div class="mt-auto d-grid gap-2">
                            <a href="produit.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-dark">Détails</a>
                            <?php if ($product['stock'] > 0): ?>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                    <button type="submit" name="add" class="btn btn-sm btn-success w-100">Ajouter</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>