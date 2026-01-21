<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
  <h1><?= htmlspecialchars($title) ?></h1>

  <?php if (empty($items)): ?>
    <p>Panier vide.</p>
  <?php else: ?>
    <form method="POST" action="/panier/modifier">
      <table border="1" cellpadding="8" cellspacing="0">
        <thead>
          <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total ligne</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $it): ?>
            <?php $p = $it['product']; ?>
            <tr>
              <td><?= htmlspecialchars($p['name'] ?? '') ?></td>
              <td><?= htmlspecialchars((string)($p['price'] ?? '')) ?> €</td>
              <td>
                <input
                  type="number"
                  name="quantities[<?= (int)$p['id'] ?>]"
                  value="<?= (int)$it['qty'] ?>"
                  min="0"
                >
              </td>
              <td><?= htmlspecialchars((string)$it['lineTotal']) ?> €</td>
              <td>
                <form method="POST" action="/panier/supprimer" style="display:inline;">
                  <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                  <button type="submit">Supprimer</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <p><strong>Total :</strong> <?= htmlspecialchars((string)$total) ?> €</p>

      <button type="submit">Mettre à jour</button>
    </form>
  <?php endif; ?>

  <p><a href="/produits">Retour aux produits</a></p>
</body>
</html>
