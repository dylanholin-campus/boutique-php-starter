<?php

$a = 0;
$b = '';
$c = null;
$d = false;
$e = '0';

if ($a == $a) {
    $statut = "$a == $a est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a == $a est faux <br>";
    echo "<br>$statut";
}

if ($a == $b) {
    $statut = "$a == '' est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a == '' est faux <br>";
    echo "<br>$statut";
}

if ($a == $c) {
    $statut = "$a == null est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a == null est faux <br>";
    echo "<br>$statut";
}

if ($a == $d) {
    $statut = "$a == false est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a == false est faux <br>";
    echo "<br>$statut";
}

if ($a == $e) {
    $statut = "$a == '0' est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a == '0' est faux <br>";
    echo "<br>$statut";
}

//-------------------------------

if ($a === $a) {
    $statut = "$a === $a est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a === $a est faux <br>";
    echo "<br>$statut";
}

if ($a === $b) {
    $statut = "$a === '' est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a === '' est faux <br>";
    echo "<br>$statut";
}

if ($a === $c) {
    $statut = "$a === null est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a === null est faux <br>";
    echo "<br>$statut";
}

if ($a === $d) {
    $statut = "$a === false est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a === false est faux <br>";
    echo "<br>$statut";
}

if ($a === $e) {
    $statut = "$a === '0' est vrai <br>";
    echo "<br>$statut";
} else {
    $statut = "$a === '0' est faux <br>";
    echo "<br>$statut";
}
