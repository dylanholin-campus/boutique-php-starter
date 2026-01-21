<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=boutique;charset=utf8mb4',
        'dev',
        'dev',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

$search = $_GET['q'] ?? '';

$products = []; // tableau vide pour les résultats

if ($search !== '') {

    // On utilise prepare() au lieu de query() car on va utiliser une variable utilisateur ($search)
    // Le '?' sert de place réservée (placeholder)
    $stmt = $pdo->prepare('SELECT * FROM products WHERE name LIKE ?');

    // On exécute la requête en "injectant" la vraie valeur à la place du '?'
    // Les % sont pour dire "qui contient ce mot" (avant ou après)
    $stmt->execute(['%' . $search . '%']);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);      // On récupère tous les résultats
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche Produit</title>
</head>
<body>

    <h1>Rechercher un produit</h1>

    <!-- Le formulaire envoie les données dans l'URL (méthode GET) -->
    <form action="" method="GET">
        <label for="search">Nom du produit :</label>
        <!-- On remet la valeur cherchée dans l'input pour que l'utilisateur voie ce qu'il a tapé -->
        <input type="text" id="search" name="q" placeholder="Ex: T-shirt" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
    </form>

    <hr>

    <!-- Affichage des résultats -->
    <?php if ($search === ''): ?>
        <p>Veuillez entrer un mot-clé pour commencer la recherche.</p>
        
    <?php elseif (empty($products)): ?>
        <p style="color: red;">Aucun produit trouvé pour "<?= htmlspecialchars($search) ?>".</p>
        
    <?php else: ?>
        <h2>Résultats de la recherche :</h2>
        <table border="1" cellpadding="10" cellspacing="0">
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
            </tbody>
        </table>
    <?php endif; ?>

    <br><br>
    
    <!--EXPLICATION -->
    <div style="background-color: #f4f4f4; padding: 20px; border: 1px solid #ccc;">
        <h3>🔒 Sécurité : Pourquoi utiliser prepare() + execute() ?</h3>
        
        <p><strong>Le problème de la concaténation (À NE PAS FAIRE) :</strong></p>
        <code style="background: #ffdddd; display: block; padding: 5px;">
            $sql = "SELECT * FROM products WHERE name LIKE '%" . $_GET["q"] . "%'";<br>
            $stmt = $pdo->query($sql);
        </code>
        <p>Si je fais ça, je laisse l'utilisateur écrire directement dans mon code SQL. S'il tape <code>%' OR 1=1 --</code>, il peut voler toutes mes données. C'est ce qu'on appelle une <strong>Injection SQL</strong>.</p>

        <p><strong>La solution sécurisée (Ce qu'on a fait) :</strong></p>
        <code style="background: #ddffdd; display: block; padding: 5px;">
            $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?");<br>
            $stmt->execute(['%' . $search . '%']);
        </code>
        <p><strong>Avantages :</strong></p>
        <ul>
            <li>Le <code>?</code> est une case vide protégée.</li>
            <li>Les données (le mot cherché) et le code SQL sont envoyés séparément.</li>
            <li>PDO "désactive" automatiquement tout code malveillant qui serait dans la variable.</li>
        </ul>
        <p><strong>En résumé :</strong> Concaténer = Danger. Préparer = Sécurité.</p>
    </div>

</body>
</html>
