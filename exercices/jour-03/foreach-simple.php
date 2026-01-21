<?php
$firstnames = ['Romain', 'Roman', 'Romane', 'Roumane', 'Ronin'];
$i = 1;
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Catalogue</title>
</head>

<body>

    <ul>
        <?php foreach ($firstnames as $firstname): ?>
            <li><?= $i . '. ' . htmlspecialchars($firstname) ?></li>
            <?php $i++; ?>
        <?php endforeach; ?>
    </ul>

</body>

</html>