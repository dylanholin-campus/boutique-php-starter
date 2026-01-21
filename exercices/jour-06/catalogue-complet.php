<?php
$products = [
    ['name' => 'Ordinateur Portable', 'category' => 'Informatique', 'price' => 800],
    ['name' => 'Smartphone', 'category' => 'Téléphonie', 'price' => 500],
    ['name' => 'Casque Audio', 'category' => 'Audio', 'price' => 100],
    ['name' => 'Clavier Mécanique', 'category' => 'Informatique', 'price' => 60],
    ['name' => 'Souris Gamer', 'category' => 'Informatique', 'price' => 40],
    ['name' => 'Écran 24 pouces', 'category' => 'Informatique', 'price' => 150],
    ['name' => 'Tablette Graphique', 'category' => 'Informatique', 'price' => 200],
    ['name' => 'Chargeur USB-C', 'category' => 'Accessoires', 'price' => 20],
    ['name' => 'Câble HDMI', 'category' => 'Accessoires', 'price' => 10],
    ['name' => 'Webcam HD', 'category' => 'Informatique', 'price' => 50],
    ['name' => 'Microphone USB', 'category' => 'Audio', 'price' => 80],
    ['name' => 'Enceinte Bluetooth', 'category' => 'Audio', 'price' => 45],
    ['name' => 'Disque Dur Externe', 'category' => 'Stockage', 'price' => 70],
    ['name' => 'Clé USB 64Go', 'category' => 'Stockage', 'price' => 15],
    ['name' => 'Routeur Wi-Fi', 'category' => 'Réseau', 'price' => 60],
    ['name' => 'Répéteur Wi-Fi', 'category' => 'Réseau', 'price' => 30],
    ['name' => 'Imprimante Laser', 'category' => 'Bureau', 'price' => 120],
    ['name' => "Cartouches d'encre", 'category' => 'Bureau', 'price' => 40],
    ['name' => 'Papier A4', 'category' => 'Bureau', 'price' => 5],
    ['name' => 'Chaise de Bureau', 'category' => 'Mobilier', 'price' => 100],
    ['name' => "Bureau d'angle", 'category' => 'Mobilier', 'price' => 150],
    ['name' => 'Lampe LED', 'category' => 'Mobilier', 'price' => 25],
    ['name' => 'Tapis de Souris', 'category' => 'Accessoires', 'price' => 15],
    ['name' => 'Hub USB', 'category' => 'Accessoires', 'price' => 25],
    ['name' => 'Sac à dos PC', 'category' => 'Accessoires', 'price' => 40],
    ['name' => 'Support PC Portable', 'category' => 'Accessoires', 'price' => 30],
    ['name' => 'Onduleur', 'category' => 'Informatique', 'price' => 90],
    ['name' => 'Logiciel Antivirus', 'category' => 'Logiciel', 'price' => 30],
    ['name' => 'Suite Bureautique', 'category' => 'Logiciel', 'price' => 100],
    ['name' => 'Jeu Vidéo PC', 'category' => 'Loisirs', 'price' => 50],
    ['name' => 'Manette de Jeu', 'category' => 'Loisirs', 'price' => 40],
    ['name' => 'Casque VR', 'category' => 'Loisirs', 'price' => 300],
];

$allCategories = array_unique(array_column($products, 'category'));
sort($allCategories);

$search = $_GET['recherche'] ?? '';
$categories = $_GET['category'] ?? [];
$priceMin = $_GET['price_min'] ?? 0;
$priceMax = (!empty($_GET['price_max'])) ? $_GET['price_max'] : 10000;
$sort = $_GET['sort'] ?? 'name_asc';
$page = (int)($_GET['page'] ?? 1);
if ($page < 1) {
    $page = 1;
}


$results = array_filter($products, function ($product) use ($search, $categories, $priceMin, $priceMax) {
    if ($search && stripos($product['name'], $search) === false) {     // sert a faire de recherche par filtre dans les 3 IF
        return false;
    }
    if (!empty($categories) && !in_array($product['category'], $categories)) {
        return false;
    }

    if ($product['price'] < $priceMin || $product['price'] > $priceMax) {
        return false;
    }
    return true;
});

usort($results, function ($a, $b) use ($sort) { // permet de faire du tri
    switch ($sort) {
        case 'price_asc':
            return $a['price'] <=> $b['price'];
        case 'price_desc':
            return $b['price'] <=> $a['price'];
        case 'name_desc':
            return strcasecmp($b['name'], $a['name']);
        case 'name_asc':
        default:
            return strcasecmp($a['name'], $b['name']);
    }
});

$perPage = 10;
$total = count($results);
$pages = ceil($total / $perPage);
$paginatedResults = array_slice($results, ($page - 1) * $perPage, $perPage);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Boutique Simple</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            margin: 0;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            padding: 20px;
            background: #f4f4f4;
            border-right: 1px solid #ccc;
        }

        .main {
            flex: 1;
            padding: 20px;
        }

        .filter-group {
            margin-bottom: 15px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .filter-group input[type="text"],
        .filter-group select {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }

        .price-inputs {
            display: flex;
            gap: 5px;
        }

        .price-inputs input {
            width: 50%;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .card img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .price {
            color: green;
            font-weight: bold;
            font-size: 1.2em;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            padding: 5px 10px;
            border: 1px solid #ddd;
            text-decoration: none;
            margin: 0 2px;
        }

        .pagination a.active {
            background: #333;
            color: white;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <form method="GET">
            <div class="filter-group">
                <label>Recherche</label>
                <input type="text" name="recherche" value="<?= htmlspecialchars($search) ?>" placeholder="Produit...">
            </div>

            <div class="filter-group">
                <label>Catégories</label>
                <?php foreach ($allCategories as $cat): ?>
                    <div>
                        <label style="font-weight: normal;">
                            <input type="checkbox" name="category[]" value="<?= $cat ?>"
                                <?= in_array($cat, $categories) ? 'checked' : '' ?>>
                            <?= $cat ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="filter-group">
                <label>Prix (€)</label>
                <div class="price-inputs">
                    <input type="number" name="price_min" placeholder="Min" value="<?= htmlspecialchars($priceMin) ?>">
                    <input type="number" name="price_max" placeholder="Max" value="<?= htmlspecialchars($_GET['price_max'] ?? '') ?>">
                </div>
            </div>

            <div class="filter-group">
                <label>Trier par</label>
                <select name="sort">
                    <option value="name_asc" <?= $sort == 'name_asc' ? 'selected' : '' ?>>Nom (A-Z)</option>
                    <option value="name_desc" <?= $sort == 'name_desc' ? 'selected' : '' ?>>Nom (Z-A)</option>
                    <option value="price_asc" <?= $sort == 'price_asc' ? 'selected' : '' ?>>Prix croissant</option>
                    <option value="price_desc" <?= $sort == 'price_desc' ? 'selected' : '' ?>>Prix décroissant</option>
                </select>
            </div>

            <button type="submit" style="width: 100%; padding: 10px;">Filtrer</button>
        </form>
    </div>

    <div class="main">
        <h2><?= $total ?> produits trouvés</h2>

        <div class="grid">
            <?php foreach ($paginatedResults as $product): ?>
                <div class="card">
                    <img src="https://placehold.co/200x150?text=<?= urlencode($product['name']) ?>" alt="<?= $product['name'] ?>">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p><?= htmlspecialchars($product['category']) ?></p>
                    <div class="price"><?= $product['price'] ?> €</div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($pages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $pages; $i++):
                    $params = $_GET;
                    $params['page'] = $i;
                    $url = '?' . http_build_query($params);
                ?>
                    <a href="<?= $url ?>" class="<?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>