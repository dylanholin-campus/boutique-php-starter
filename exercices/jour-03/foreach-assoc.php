<?php
$people = [
    ['nom' => 'Tom', 'age' => 31, 'city' => 'Valence', 'job' => 'Eboueur'],
    ['nom' => 'Jean', 'age' => 25, 'city' => 'Lyon', 'job' => 'Eboueur'],
    ['nom' => 'Tierry', 'age' => 19, 'city' => 'Valence', 'job' => 'Formateur']
];

?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Catalogue</title>
</head>

<body>

    <ul>
        <?php foreach ($people as $person): ?>
            <li>
                <?php foreach ($person as $key => $value): ?>
                    <strong><?= htmlspecialchars($key) ?></strong> : <?= htmlspecialchars((string)$value) ?><br>
                <?php endforeach; ?>
            </li>
            <br>
        <?php endforeach; ?>
    </ul>

</body>

</html>