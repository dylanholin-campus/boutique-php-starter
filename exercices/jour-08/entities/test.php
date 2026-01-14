<?php

require_once 'Product.php';
require_once 'Category.php';
require_once 'User.php';

// Créer les catégories
$cat1 = new Category(1, "Électronique Grand Public", "Produits électroniques");
$cat2 = new Category(2, "Accessoires Informatiques", "Souris, claviers, câbles");

// Créer les produits
$products = [
    new Product(1, "Laptop Dell", "Ordinateur portable 15 pouces", 899.99, 5, $cat1->nom),
    new Product(2, "Souris Logitech", "Souris sans fil précise", 35.50, 20, $cat2->nom),
    new Product(3, "Clavier Mécanique", "Clavier RGB rétroéclairé", 129.99, 8, $cat2->nom)
];

// Créer les utilisateurs
$users = [
    new User("Jean Dupont", "jean@example.com", "password123"),
    new User("Marie Martin", "marie@example.com", "secure456", "2025-12-15 10:30:00"),
    new User("Pierre Durand", "pierre@example.com", "azerty789", "2024-01-20 14:45:00")
];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Classes PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { color: #333; border-bottom: 3px solid #0066cc; padding-bottom: 10px; }
        h2 { color: #0066cc; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; background: white; margin: 15px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th { background: #0066cc; color: white; padding: 12px; text-align: left; }
        td { padding: 10px 12px; border-bottom: 1px solid #ddd; }
        tr:hover { background: #f9f9f9; }
        .status-in-stock { color: green; font-weight: bold; }
        .status-out-of-stock { color: red; font-weight: bold; }
        .status-new { color: orange; font-weight: bold; }
        .status-old { color: gray; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Test des Classes PHP</h1>

        <h2>📦 Produits</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Prix HT</th>
                    <th>Prix TTC (20%)</th>
                    <th>Stock</th>
                    <th>Disponible</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= $p->id ?></td>
                    <td><?= $p->nom ?></td>
                    <td><?= $p->categorie ?></td>
                    <td><?= number_format($p->prix, 2, ',', ' ') ?>€</td>
                    <td><?= number_format($p->getPriceIncludingTax(), 2, ',', ' ') ?>€</td>
                    <td><?= $p->stock ?></td>
                    <td>
                        <?php if ($p->isInStock()): ?>
                            <span class="status-in-stock">✓ En stock</span>
                        <?php else: ?>
                            <span class="status-out-of-stock">✗ Rupture</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>👥 Utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date Inscription</th>
                    <th>Nouveau Membre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u->nom ?></td>
                    <td><?= $u->email ?></td>
                    <td><?= $u->dateInscription ?></td>
                    <td>
                        <?php if ($u->isNewMember()): ?>
                            <span class="status-new">✓ Nouveau</span>
                        <?php else: ?>
                            <span class="status-old">- Ancien</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>🏷️ Catégories</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $cat1->id ?></td>
                    <td><?= $cat1->nom ?></td>
                    <td><code><?= $cat1->getSlug() ?></code></td>
                    <td><?= $cat1->description ?></td>
                </tr>
                <tr>
                    <td><?= $cat2->id ?></td>
                    <td><?= $cat2->nom ?></td>
                    <td><code><?= $cat2->getSlug() ?></code></td>
                    <td><?= $cat2->description ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>