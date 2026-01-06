<?php
$groceries = ["Pomme", "Banane", "Chocolat", "cerise", "RTX 5080"];
array_push($groceries, "Raptor", "Tourte");
unset($groceries[2]);
echo " Premier article : " . $groceries[0];
echo " Dernier article : " . $groceries[count($groceries) - 1];
echo " Nombre total d'articles : " . count($groceries);
$groceries = array_values($groceries);
var_dump($groceries);
