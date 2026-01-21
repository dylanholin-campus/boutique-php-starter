<?php

$clothes = ['T-shirt', 'Jean', 'Pull'];
$accessories = ['Ceinture', 'Montre', 'Lunettes'];

$tableaufusionner = array_merge($clothes, $accessories);
array_unshift($tableaufusionner, 'Veste');

echo '<pre>';
print_r($tableaufusionner);
echo '</pre>';
echo " Nombre total d'articles : " . count($tableaufusionner);
