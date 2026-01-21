<?php

$age = 26;

if ($age < 18) {
    $statut = 'Mineur';
} elseif ($age <= 25) {
    $statut = 'Young adult';
} elseif ($age <= 64) {
    $statut = 'Adult';
} else {
    $statut = 'Senior';
}

echo $statut;
