<?php

$categories = ['Vêtements', 'Chaussures', 'Accessoires', 'Sport'];

echo in_array('Chaussures', $categories) ? 'Trouvé !' : 'Non trouvé';
echo '<br>';

echo in_array('Électronique', $categories) ? 'Trouvé !' : 'Non trouvé';
echo '<br>';

$indexSport = array_search('Sport', $categories);
echo ($indexSport !== false) ? 'Index de Sport : ' . $indexSport : 'Sport non trouvé';
