<?php

$groceries = ['Pomme', 'Banane', 'Chocolat', 'cerise', 'RTX 5080'];
array_push($groceries, 'Raptor', 'Tourte');
$groceries = array_values($groceries);
unset($groceries[2]);
$groceries = array_values($groceries);
echo ' Premier article : ' . $groceries[0];
echo ' Dernier article : ' . $groceries[count($groceries) - 1];
echo " Nombre total d'articles : " . count($groceries);
var_dump($groceries);
