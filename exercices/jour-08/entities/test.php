<?php

require_once 'Product.php';
require_once 'Category.php';
require_once 'User.php';

// Créer les catégories
$cat1 = new Category(1, 'Électronique Grand Public', 'Produits électroniques');
$cat2 = new Category(2, 'Accessoires Informatiques', 'Souris, claviers, câbles');

// Créer les produits
$products = [
    new Product(1, 'Laptop Dell', 'Ordinateur portable 15 pouces', 899.99, 5, $cat1->nom),
    new Product(2, 'Souris Logitech', 'Souris sans fil précise', 35.50, 20, $cat2->nom),
    new Product(3, 'Clavier Mécanique', 'Clavier RGB rétroéclairé', 129.99, 8, $cat2->nom)
];

// Créer les utilisateurs
$users = [
    new User('Jean Dupont', 'jean@example.com', 'password123'),
    new User('Marie Martin', 'marie@example.com', 'secure456', '2025-12-15 10:30:00'),
    new User('Pierre Durand', 'pierre@example.com', 'azerty789', '2024-01-20 14:45:00')
];

// Tableau de mots de passe pour tester la vérification
$passwordsToTest = [
    'password123',
    'secure456',
    'y789'
];

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Classes PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0066cc;
            --secondary-color: #f8f9fa;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1400px;
        }

        .header {
            background: white;
            border-radius: 12px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header p {
            color: #666;
            font-size: 16px;
            margin: 0;
        }

        .card-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 25px;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--primary-color);
        }

        .table {
            margin-bottom: 0;
            font-size: 14px;
        }

        .table thead {
            background: var(--primary-color);
            color: white;
        }

        .table thead th {
            border: none;
            font-weight: 600;
            padding: 15px 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 12px;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 14px 12px;
            border-bottom: 1px solid #e9ecef;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .badge-new {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-old {
            background: #6c757d;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-in-stock {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-out-of-stock {
            background: linear-gradient(135deg, #dc3545, #fd7e14);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-valid {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-invalid {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 11px;
        }

        .price-ht {
            color: var(--primary-color);
            font-weight: 600;
        }

        .price-ttc {
            color: #28a745;
            font-weight: 700;
        }

        .hash-code {
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 11px;
            color: #666;
            word-break: break-all;
        }

        .slug {
            background: #e3f2fd;
            padding: 6px 10px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            color: var(--primary-color);
            font-weight: 600;
        }

        .stock-count {
            background: #f0f0f0;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            color: #333;
            display: inline-block;
            min-width: 35px;
            text-align: center;
        }

        .icon-badge {
            font-size: 18px;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header text-center">
            <h1><i class="fas fa-chart-bar icon-badge"></i>Test des Classes PHP</h1>
            <p>Gestion des Produits, Utilisateurs et Catégories</p>
        </div>

        <!-- Produits -->
        <div class="card-section">
            <h2 class="section-title"><i class="fas fa-box"></i> Produits</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix HT</th>
                            <th>Prix TTC</th>
                            <th>Stock</th>
                            <th>Disponibilité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td><strong>#<?= $p->id ?></strong></td>
                                <td><?= $p->nom ?></td>
                                <td><?= $p->categorie ?></td>
                                <td><span class="price-ht"><?= number_format($p->prix, 2, ',', ' ') ?>€</span></td>
                                <td><span class="price-ttc"><?= number_format($p->getPriceIncludingTax(), 2, ',', ' ') ?>€</span></td>
                                <td><span class="stock-count"><?= $p->stock ?></span></td>
                                <td>
                                    <?php if ($p->isInStock()): ?>
                                        <span class="badge-in-stock"><i class="fas fa-check"></i> En stock</span>
                                    <?php else: ?>
                                        <span class="badge-out-of-stock"><i class="fas fa-times"></i> Rupture</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Utilisateurs -->
        <div class="card-section">
            <h2 class="section-title"><i class="fas fa-users"></i> Utilisateurs</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Date Inscription</th>
                            <th>Statut</th>
                            <th>Password Hashé</th>
                            <th>Vérification</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0;
                        foreach ($users as $u): $correctPassword = $passwordsToTest[$index]; ?>
                            <tr>
                                <td><strong><?= $u->nom ?></strong></td>
                                <td><i class="fas fa-envelope"></i> <?= $u->email ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($u->dateInscription)) ?></td>
                                <td>
                                    <?php if ($u->isNewMember()): ?>
                                        <span class="badge-new"><i class="fas fa-star"></i> Nouveau</span>
                                    <?php else: ?>
                                        <span class="badge-old"><i class="fas fa-user-check"></i> Ancien</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="hash-code"><?= substr($u->password, 0, 30) ?>...</div>
                                </td>
                                <td>
                                    <?php if ($u->verifyPassword($correctPassword)): ?>
                                        <span class="badge-valid"><i class="fas fa-lock-open"></i> Valide</span>
                                    <?php else: ?>
                                        <span class="badge-invalid"><i class="fas fa-lock"></i> Invalide</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php $index++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Catégories -->
        <div class="card-section">
            <h2 class="section-title"><i class="fas fa-tag"></i> Catégories</h2>
            <div class="table-responsive">
                <table class="table">
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
                            <td><strong>#<?= $cat1->id ?></strong></td>
                            <td><?= $cat1->nom ?></td>
                            <td><span class="slug"><?= $cat1->getSlug() ?></span></td>
                            <td><?= $cat1->description ?></td>
                        </tr>
                        <tr>
                            <td><strong>#<?= $cat2->id ?></strong></td>
                            <td><?= $cat2->nom ?></td>
                            <td><span class="slug"><?= $cat2->getSlug() ?></span></td>
                            <td><?= $cat2->description ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>