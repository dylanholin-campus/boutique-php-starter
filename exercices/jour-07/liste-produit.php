<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=boutique;charset=utf8mb4',
        'dev',
        'dev',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] // "Si quelque chose se passe mal, lève une exception (erreur attrapable) au lieu de te taire."
    );

    $stmt = $pdo->query('SELECT * FROM products');  // "Donne‑moi toutes les colonnes de toutes les lignes de la table products
    //  Préparer et exécuter la requête  "Hé MySQL, exécute cette requête, et renvoie-moi un objet pour lire le résultat."

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);     // Récupérer TOUTES les lignes en tableau associatif
} catch (PDOException $e) {
    die('❌ Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
</head>

<body>
    <h1>Produits</h1>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?> €</td>
                    <td><?= htmlspecialchars($product['stock']) ?></td>
                </tr>
            <?php endforeach; ?>
            <p>fetch() : Récupère une seule ligne à la fois, la "prochaine" du résultat</p>
            <p>fetchAll() : Récupère toutes les lignes d’un coup dans un grand tableau (tableau de tableaux)</p>
            <br>
            <p> Que signifie PDO::FETCH_ASSOC ?</p>
            <p> "PDO::FETCH_ASSOC" dit à PDO :</p>
            <p> "Retourne chaque ligne sous forme de tableau associatif avec les noms de colonnes comme clés."</p>
            <br>
        </tbody>
    </table>
</body>

</html>