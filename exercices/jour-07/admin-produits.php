<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=boutique;charset=utf8mb4',
        'dev',
        'dev',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // 1. CREATE - Ajouter un produit (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
        $stmt = $pdo->prepare('INSERT INTO products (name, description, price, stock, category) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $_POST['name'],
            $_POST['description'],
            $_POST['price'],
            $_POST['stock'],
            $_POST['category']
        ]);
        header('Location: admin-produits.php');
        exit;
    }

    // 2. DELETE - Supprimer un produit (GET)
    if (isset($_GET['delete'])) {
        $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$_GET['delete']]);
        header('Location: admin-produits.php');
        exit;
    }

    // 3. Récupérer tous les produits
    $stmt = $pdo->query('SELECT * FROM products ORDER BY created_at DESC');
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Produits</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 6px 12px; text-decoration: none; margin: 2px; border-radius: 4px; }
        .btn-edit { background: #4CAF50; color: white; }
        .btn-delete { background: #f44336; color: white; }
        form { background: #f9f9f9; padding: 20px; margin: 20px 0; border-radius: 8px; }
        input, select { padding: 8px; margin: 5px; border: 1px solid #ddd; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Administration des Produits</h1>

    <!-- Liste des produits -->
    <h2>Produits existants (<?= count($products) ?>)</h2>
    <?php if (empty($products)): ?>
        <p>Aucun produit.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Catégorie</th>
                    <th>Créé le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= $product['price'] ?> €</td>
                        <td><?= $product['stock'] ?></td>
                        <td><?= htmlspecialchars($product['category']) ?></td>
                        <td><?= $product['created_at'] ?></td>
                        <td>
                            <!-- Bouton Modifier (UPDATE - prochain exercice) -->
                            <a href="#" class="btn btn-edit" onclick="alert('UPDATE à implémenter')">Modifier</a>
                            <!-- Bouton Supprimer avec confirmation JS -->
                            <a href="?delete=<?= $product['id'] ?>" 
                               class="btn btn-delete"
                               onclick="return confirm('Supprimer <?= htmlspecialchars($product['name']) ?> ?')">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <hr>

    <!-- Formulaire d'ajout (CREATE) -->
    <h2>Ajouter un nouveau produit</h2>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        
        <div>
            <label>Nom :</label>
            <input type="text" name="name" required maxlength="255">
        </div>
        
        <div>
            <label>Description :</label>
            <textarea name="description" rows="3"></textarea>
        </div>
        
        <div>
            <label>Prix :</label>
            <input type="number" name="price" step="0.01" min="0" required>
        </div>
        
        <div>
            <label>Stock :</label>
            <input type="number" name="stock" min="0" value="0">
        </div>
        
        <div>
            <label>Catégorie :</label>
            <select name="category">
                <option value="">Aucune</option>
                <option value="Vêtements">Vêtements</option>
                <option value="Chaussures">Chaussures</option>
                <option value="Accessoires">Accessoires</option>
            </select>
        </div>
        
        <button type="submit">Ajouter le produit</button>
    </form>

</body>
</html>
