<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? '404') ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($title ?? 'Page non trouvée') ?></h1>
    <p>Ressource introuvable.</p>
    <p><a href="/produits">Retour au catalogue</a></p>
</body>
</html>
