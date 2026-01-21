<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title ?? 'Boutique') ?></title>
</head>
<body>

  <?php if ($msg = flash('success')): ?>
    <p style="color:green;"><?= htmlspecialchars($msg) ?></p>
  <?php endif; ?>

  <?php if ($msg = flash('error')): ?>
    <p style="color:red;"><?= htmlspecialchars($msg) ?></p>
  <?php endif; ?>

  <?= $content ?>

</body>
</html>
