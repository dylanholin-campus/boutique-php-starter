<?php

$i = 1;
while ($i <= 10) {
    echo "Numéro impair $i<br>";
    $i = $i + 1;
}

echo '<br>';

$o = 2;
while ($o <= 20) {
    echo "Numéro pair $o<br>";
    $o = $o + 2;
}

echo '<br>';

$z = 10;
while ($z >= 0) {
    echo "compte a rebour $z<br>";
    $z = $z - 1;
}

echo '<br>';

$f = 1;
while ($f <= 10) {
    $result = 7 * $f;
    echo "7 x $f = $result<br>";
    $f++;
}
